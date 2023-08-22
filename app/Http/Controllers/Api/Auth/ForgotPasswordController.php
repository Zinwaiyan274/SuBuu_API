<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Mail\PasswordReset;
use App\Models\Api\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    /*
        |--------------------------------------------------------------------------
        | Password Reset Controller
        |--------------------------------------------------------------------------
        |
        | This controller is responsible for handling password reset emails and
        | includes a trait which assists in sending these notifications from
        | your application to your users. Feel free to explore this trait.
        |
        */
    //use SendsPasswordResetEmails;

    public function sendResetCode(Request $request) :JsonResponse
    {
        $request->validate([
            'email'=>'required|email|exists:users,email'
        ]);
//return $this->respondWithSuccess('check',$request->email);
        // Generate password reset verification code and expire date for
        // the verification code. The code and the expiry date will store in
        // database. The verification code won't work after the expiry date.
        $code = random_int(100000,999999);
        $expire = now()->addHour();
        $user = User::where('email',$request->email)->first();
        //return $user;
        $user->update(['remember_token'=>$code,'email_verified_at'=>$expire]);
        //$url = url('password/reset');

        $data = [
            'code' => $code
        ];
//return $this->respondWithSuccess('check',$data);
        try{
            Mail::to($request->email)->send(new PasswordReset($data));
            /* Mail::send('mail.password-reset',  ['user' => $user,'data'=>$data], function ($message) {
                 $message->from('play@bet.maantechnology.com', 'Laravel');
                 $message->to('towhiduzzaman.22@gmail.com')->subject('Your Reminder!');
             });*/
            return response()->json([
                'success' => true,
                'message' => 'password reset code has been sent to your email',
            ], 200);
        }catch (\Exception $exception){
            return response()->json([
                'success' => 'false',
                'message' => $exception->getMessage(),
            ], 422);
        }
        /*if(Mail::failures() != 0) {
            return response()->json([
                'success' => true,
                'message' => 'password reset code has been sent to your email',
            ], 200);
        }*/
        return response()->json([
            'success' => 'false',
            'message' => 'Failed',
        ], 422);
    }
}
