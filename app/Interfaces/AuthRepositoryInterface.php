<?php

namespace App\Interfaces;

use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\ChangePersonalInfo;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\Auth\ForgotPasswordRequest;

interface AuthRepositoryInterface
{
    public function login(LoginRequest $loginRequest);
    public function register(RegistrationRequest $registrationRequest);
    public function logout();
    public function profile(Request $request);
    public function resetPassword(ResetPasswordRequest $resetPasswordRequest);
    public function sendResetPasswordCode(Request $request);
    public function refreshToken();
    public function forgotPassword(ForgotPasswordRequest $forgotPasswordRequest);
    public function verifyEmail(Request $request);
    public function changePassword(ChangePasswordRequest $changePasswordRequest);
    public function verifyResetPasswordCode(Request $request);
    public function resendRegistrationCode(Request $request);
    public function changePersonalInfo(ChangePersonalInfo $changePersonalInfoRequest); 
}
