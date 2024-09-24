<?php

namespace App\Interfaces;

use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\ChangePersonalInfo;
use App\Http\Requests\Auth\VerifyEmailRequest;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Http\Requests\Auth\ResetPasswordRequest;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\SendResetPasswordCodeRequest;

interface AuthRepositoryInterface
{
    public function login(LoginRequest $loginRequest);
    public function register(Request $registrationRequest);
    public function logout(Request $request);
    public function profile(Request $request);
    public function resetPassword(ResetPasswordRequest $resetPasswordRequest);
    public function sendResetPasswordCode(Request $request);
    public function refreshToken(Request $request);
    public function verifyEmail(VerifyEmailRequest $verifyEmailRequest);
    public function changePassword(ChangePasswordRequest $changePasswordRequest);
    public function verifyResetPasswordCode(Request $request);
    public function resendRegistrationCode(Request $request);
    public function changePersonalInfo(ChangePersonalInfo $changePersonalInfoRequest);
}
