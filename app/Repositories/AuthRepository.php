<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use App\Traits\HandleApiResponse;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\EmailVerificationService;
use App\Interfaces\AuthRepositoryInterface;
use App\Http\Requests\Auth\ChangePersonalInfo;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\Auth\ForgotPasswordRequest;

class AuthRepository implements AuthRepositoryInterface
{
    use HandleApiResponse;
    protected $emailVerificationService;
    public function __construct(EmailVerificationService $emailVerificationService){
        $this->emailVerificationService = $emailVerificationService;
    }
    public function login(LoginRequest $loginRequest){

    }
    public function register(RegistrationRequest $registrationRequest){

    }
    public function logout(){

    }
    public function profile(Request $request){

    }
    public function resetPassword(ResetPasswordRequest $resetPasswordRequest){

    }
    public function sendResetPasswordCode(Request $request){

    }
    public function refreshToken(){

    }
    public function forgotPassword(ForgotPasswordRequest $forgotPasswordRequest){

    }
    public function verifyEmail(Request $request){

    }
    public function changePassword(ChangePasswordRequest $changePasswordRequest){

    }
    public function verifyResetPasswordCode(Request $request){

    }
    public function resendRegistrationCode(Request $request){

    }
    public function changePersonalInfo(ChangePersonalInfo $changePersonalInfoRequest){

    }

}
