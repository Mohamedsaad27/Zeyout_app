<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Interfaces\AuthRepositoryInterface;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\SendResetPasswordCodeRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\VerifyEmailRequest;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\Auth\VerifyResetPasswordCodeRequest;

class AuthController extends Controller
{
    protected $authRepository;
    public function __construct(AuthRepositoryInterface $authRepository){
        $this->authRepository = $authRepository;
    }
    public function register(RegistrationRequest $request){
        return $this->authRepository->register($request);
    }
    public function login(LoginRequest $request){
        return $this->authRepository->login($request);
    }
    public function logout(Request $request){
        return $this->authRepository->logout($request);
    }
    public function sendResetPasswordCode(Request $request){
        return $this->authRepository->sendResetPasswordCode($request);
    }
    public function resetPassword(ResetPasswordRequest $request){
        return $this->authRepository->resetPassword($request);
    }
    public function verifyEmail(VerifyEmailRequest $request){
        return $this->authRepository->verifyEmail($request);
    }
    public function refreshToken(Request $request){
        return $this->authRepository->refreshToken($request);
    }
    public function profile(Request $request){
        return $this->authRepository->profile($request);
    }
    public function changePassword(ChangePasswordRequest $request){
        return $this->authRepository->changePassword($request);
    }
    public function verifyResetPasswordCode(Request $request){
        return $this->authRepository->verifyResetPasswordCode($request);
    }
    public function resendRegistrationCode(Request $request){
        return $this->authRepository->resendRegistrationCode($request);
    }

}
