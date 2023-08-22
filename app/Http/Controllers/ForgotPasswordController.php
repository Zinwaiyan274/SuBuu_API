<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Mail\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email|exists:users,email'
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->where('email', $request->email)->delete();

        DB::table('password_resets')->insert(
            ['email' => $request->email, 'token' => $token, 'created_at' => Carbon::now()]
        );

        $url = url('password/reset/'. $token);

        $data = [
            'code' => $token,
            'url' => $url
        ];

        try {
            Mail::to($request->email)->send(new PasswordReset($data));
            return back()->with('success', 'Success! password reset link has been sent to your email');
        } catch (\Exception $exception){
            return back()->withErrors(['error' => $exception->getMessage()]);
        }
    }
}
