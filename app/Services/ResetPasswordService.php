<?php
namespace App\Services;

use Carbon\Carbon;
use App\Models\User;
use App\Traits\HandleApiResponse;
use App\Mail\ResetPasswordCodeMail;
use Illuminate\Support\Facades\Mail;
use App\Interfaces\ResetPasswordInterface;

class ResetPasswordService 
{
    public function sendResetPasswordCode($email){
        $code = $this->generateResetPasswordCode($email);
        Mail::to($email)->send(new ResetPasswordCodeMail($code));
    }
   
  public function generateResetPasswordCode($email){
    $user = User::where('email', $email)->first();
    if($user){
        $user->update([
            'verification_code' => null
        ]);
        $code = rand(10000, 99999);
        $user->update(['verification_code' => $code,'verification_code_expiration' => Carbon::now()->addMinutes(30)]);
        return $code;
    }
    return null;
  }
}
