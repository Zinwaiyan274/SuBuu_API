<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\Api\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{

    public function verifyCode(Request $request) : JsonResponse
    {
        $request->validate([
            'code'=>'required'
        ]);

        $user  = User::where('remember_token',$request->code)->first();
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry! Verification code is Wrong!'
            ], 200);
        }
        if ($user && $user->email_verified_at > now()) {
            return response()->json([
                'success' => true,
                'message' => 'Code Verification Successful!'
            ], 200);
        }

        return response()->json([
            'success' => true,
            'message' => 'Your password has been changed!',
        ], 200);
    }

    public function userResetPassword(Request $request) : JsonResponse
    {
        $request->validate([
            'code'=>'required',
            'password'=>['required', 'confirmed', 'min:6'],
        ]);

        $user  = User::where('remember_token',$request->code)->first();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry! Verification code is Wrong!'
            ], 404);
        }

        if ($user->email_verified_at < now()) {
            return response()->json([
                'success' => true,
                'message' => 'Verification code expired!'
            ], 200);
        }

        $data['password'] = bcrypt($request->password);
        $data['remember_token'] = null;
        $data['email_verified_at'] = null;

        $user->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Your password has been changed!',
        ], 200);

    }
}
