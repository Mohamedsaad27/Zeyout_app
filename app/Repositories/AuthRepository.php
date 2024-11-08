<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Trader;
use Illuminate\Http\Request;
use App\Traits\HandleApiResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use App\Services\ResetPasswordService;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Services\EmailVerificationService;
use App\Interfaces\AuthRepositoryInterface;
use App\Http\Requests\Auth\ChangePersonalInfo;
use App\Http\Requests\Auth\VerifyEmailRequest;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\SendResetPasswordCodeRequest;
use App\Traits\HandleImages;


class AuthRepository implements AuthRepositoryInterface
{
    use HandleApiResponse,HandleImages;
    public function __construct(private EmailVerificationService $emailVerificationService, private ResetPasswordService $resetPasswordService){
    }
    public function register(RegistrationRequest $registrationRequest)
    {
        try {
            $validatedData = $registrationRequest->validated();
            if (User::where('email', $validatedData['email'])->exists()) {
                return $this->errorResponse(trans('messages.email_already_exists'), 422);
            }
            $user = User::create($validatedData);
            if($user->type == 'trader'){
                Trader::create([
                    'user_id' => $user->id,
                ]);
            }
            if($user){
                $verificationCode = $this->emailVerificationService->generateVerificationCode($user->email);
                if($verificationCode){
                    $this->emailVerificationService->sendVerificationEmail($user);
                }
                $token = $user->createToken($registrationRequest->userAgent())->plainTextToken;
                $user['token'] = $token;
                return $this->successResponse(['user' => new UserResource($user)], trans('messages.user_created_successfully'), 201);
            }
            return $this->errorResponse([], trans('messages.failed_create_code'), 500);
        }catch (\Exception $exception) {
            DB::rollBack();
            return $this->errorResponse($exception->getMessage(), 500);
        }
    }

    public function login(LoginRequest $loginRequest){
        try {
            $validatedData = $loginRequest->validated();
            $credentials = $loginRequest->only(['email', 'password']);
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                if($user->type == 'trader'){
                    $trader = Trader::where('user_id', $user->id)->first();
                    if(!$trader->is_active){
                        return $this->errorResponse(trans('messages.trader_is_not_active'), 401);
                    }
                }
                $token = $user->createToken($loginRequest->userAgent())->plainTextToken;
                $user['token'] = $token;
                return $this->successResponse(
                    ['user' => new UserResource($user)], trans('messages.login_successful'), 200);
            } else {
                return $this->errorResponse(trans('messages.invalid_credentials'), 401);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            return $this->errorResponse(trans('validation.validation_errors'), 422, $e->errors());
        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage(), 500);
        }
    }

    public function logout(Request $request){
        try {
            $user = Auth::user();
            $user->tokens()->delete();
            return $this->successResponse([],trans('messages.logout_successful'),200);
        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage(),500);
        }
    }
    public function profile(Request $request){
        try {
            $user = Auth::user();
            if (!$user) {
                return $this->errorResponse(trans('messages.profile_not_retrieved'),404);
            }
            return $this->successResponse(['user' => new UserResource($user)],trans('messages.profile_retrieved_successfully'),200);
        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage(),500);
        }
    }
    public function resetPassword(ResetPasswordRequest $resetPasswordRequest){
        try {
            $validatedData = $resetPasswordRequest->validated();
            $user = User::where('email', $validatedData['email'])->first();
            if (!$user) {
                return $this->errorResponse(trans('messages.user_not_found'), 404);
            }

            $user->update(['password' => Hash::make($validatedData['password'])]);
            return $this->successResponse([], trans('messages.password_reset_successfully'), 200);
        }catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage(), 500);
        }
    }



    public function sendResetPasswordCode(Request $request){
        try {
            $validatedData = $request->validate([
                'email' => 'required|email|exists:users,email',
            ]);
            $user = User::where('email', $validatedData['email'])->first();
        if (!$user) {
            return $this->errorResponse(trans('messages.user_not_found'), 404);
        }

        $this->resetPasswordService->sendResetPasswordCode($user->email);
        return $this->successResponse([], trans('messages.reset_password_code_sent_successfully'), 200);
       } catch (\Exception $exception) {
        return $this->errorResponse($exception->getMessage(), 500);
       }
    }



    public function refreshToken(Request $request){
        try {
            $user = Auth::user();
            $user->tokens()->delete();
            $token = $user->createToken($request->userAgent())->plainTextToken;
            $user['token'] = $token;
            return $this->successResponse(['user' => new UserResource($user)], trans('messages.token_refreshed_successfully'), 200);
        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage(), 500);
        }
    }

    public function verifyEmail(VerifyEmailRequest $verifyEmailRequest){
        try {
            $validatedData = $verifyEmailRequest->validated();
            $user = User::where('email', $validatedData['email'])->first();
            if ($user->verification_code_expiration && Carbon::now()->diffInMinutes($user->verification_code_expiration) > 30) {
                return $this->errorResponse(trans('messages.reset_password_code_expired'), 404);
            }
            if (!$user) {
                return $this->errorResponse(trans('messages.user_not_found'), 404);
            }
            if ($user->is_verified) {
                return $this->errorResponse(trans('messages.email_already_verified'), 404);
            }
            $user->update(['verification_code' => null,'is_verified' => true,'verification_code_expiration' => null]);
            return $this->successResponse([], trans('messages.email_verified_successfully'), 200);
        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage(), 500);
        }
    }


    public function changePassword(ChangePasswordRequest $changePasswordRequest){
        try {
            $validatedData = $changePasswordRequest->validated();
            $user = Auth::user();
            if (!Hash::check($validatedData['current_password'], $user->password)) {
                return $this->errorResponse(trans('messages.current_password_not_correct'), 404);
            }
            $user->update(['password' => Hash::make($validatedData['new_password'])]);
            return $this->successResponse([], trans('messages.password_changed_successfully'), 200);
        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage(), 500);
        }
    }


    public function verifyResetPasswordCode(Request $request){
        try {
            $validatedData = $request->validate([
                'code' => 'required|string|min:5|max:5|exists:users,verification_code',
            ]);
            $user = User::where('verification_code', $validatedData['code'])->first();
            // Check if the code is expired
            if ($user->verification_code_expiration && Carbon::now()->diffInMinutes($user->verification_code_expiration) > 30) {
                return $this->errorResponse(trans('messages.reset_password_code_expired'), 404);
            }
            if (!$user) {
                return $this->errorResponse(trans('messages.user_not_found'), 404);
            }
            return $this->successResponse([], trans('messages.reset_password_code_verified_successfully'), 200);
        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage(), 500);
        }
    }
    public function resendRegistrationCode(Request $request){
        try {
            $validatedData = $request->validate([
                'email' => 'required|email|exists:users,email',
            ]);
            $user = User::where('email', $validatedData['email'])->first();
            if (!$user) {
                return $this->errorResponse(trans('messages.user_not_found'), 404);
            }
            $this->emailVerificationService->sendVerificationEmail($user);
            return $this->successResponse([], trans('messages.resend_registration_code_successfully'), 200);
        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage(), 500);
        }
    }
    public function changePersonalInfo(ChangePersonalInfo $changePersonalInfoRequest)
    {
        try {
            $validatedData = $changePersonalInfoRequest->validated();
            $user = Auth::user();

            if ($changePersonalInfoRequest->hasFile('profile_image')) {
                $image = $changePersonalInfoRequest->file('profile_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $imagePath = 'uploads/images/users/' . $user->id;

                // Ensure the directory exists
                if (!File::isDirectory(public_path($imagePath))) {
                    File::makeDirectory(public_path($imagePath), 0755, true, true);
                }

                // Move the file to the public directory
                $image->move(public_path($imagePath), $imageName);

                // Store the path without 'public/storage'
                $validatedData['profile_image'] = $imagePath . '/' . $imageName;
            }

            $user->fill($validatedData);
            $user->save();

            return $this->successResponse(new UserResource($user), trans('messages.profile_updated_successfully'), 200);
        } catch (\Exception $exception) {
            return $this->errorResponse($exception->getMessage(), 500);
        }
    }


}
