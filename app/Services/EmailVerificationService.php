<?php

namespace App\Services;

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
            $code = rand(10000, 99999);
            $user->update([
                'verification_code' => $code
            ]);
            return $code;
        }
        return false;
    }
}

