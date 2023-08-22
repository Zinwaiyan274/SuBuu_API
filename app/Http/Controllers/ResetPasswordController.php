<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request)
    {
        return view('auth.reset-password');
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => ['required', 'confirmed'],
        ]);

        $token = DB::table('password_resets')->where('email', $request->email)->first();
        $user = User::query()
            ->where('email', $request->email)
            ->first();

        if (!$user || !$token) {
            return redirect(route('password.request'))->with('error', 'User not found');
        }

        if(Carbon::parse($token->created_at)->addMinutes(60) < now()) {
            return redirect()->back()->withErrors('Verification code expired!');
        }

        $user->update(['password'=>bcrypt($request->password)]);

        return redirect(route('login'));
    }
}
