<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\User;
use App\Mail\EmailVerification;
use Illuminate\Support\Facades\Mail;

class EmailVerificationService
{
    public function sendVerificationEmail($user)
    {
        Mail::to($user->email)->send(new EmailVerification($user));
    }
    public function generateVerificationCode($email)
    {
        $user = User::where('email', $email)->first();
        if($user){
            $user->update([
                'verification_code' => null
            ]);
            $code = rand(10000, 99999);
            $user->update([
                'verification_code' => $code,
                'verification_code_expiration' => Carbon::now()->addMinutes(30),
                'is_verified' => false
            ]);
            return $code;
        }
        return false;
    }
}

