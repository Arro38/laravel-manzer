<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
     public function forgotPassword(Request $request) {
        $request->validate(['email' => 'required|email']);


        $status = Password::sendResetLink(
            $request->only('email')
        );

        return response(['status' => $status , 'sent' => Password::RESET_LINK_SENT === $status]);
        }

     public function resetPassword(Request $request)
     {
         $request->validate([
             'token' => 'required',
             'email' => 'required|email',
             'password' => 'required|min:8|confirmed',
             'password_confirmation' => 'required|min:8|same:password',
         ]);

         $status = Password::reset(
             $request->only('email', 'password', 'password_confirmation', 'token'),
             function (User $user, string $password) {
                 $user->forceFill([
                     'password' => Hash::make($password)
                 ])->setRememberToken(Str::random(60));

                 $user->save();

                 event(new PasswordReset($user));
             }
         );

         return response(['status' => $status , 'reset' => Password::PASSWORD_RESET === $status]);
     }
}
