<?php

namespace App\Http\Controllers\Api;

use App\Helper\CustomHelper;
use App\Helpers\HasUploader;
use App\Http\Controllers\Controller;
use App\Models\Api\WithdrawRequest;
use App\Models\Wallet;
use App\Models\Api\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use HasUploader;

    public function maanRegistration(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
            'email' => 'required|email|unique:users',
            'refer' => 'required|string'
        ]);

        $data = User::find($request->email);

        if(!$data) {
            if($request->refer === 'RF5869') {
                $createdata = $request->only('name', 'email', 'password', 'refer');
                $createdata['image'] = $request->image ? $this->upload($request, 'image') : NULL;
                $createdata['password'] = bcrypt($request->password);
                $createdata['refer_code'] = 'RF5869';
                $users = User::create($createdata);
                \App\Models\User::balanceAdd($users->id);

                if ($request->refer != '') {
                    \App\Models\User::referBalanceAdd($users->id, $request->refer);
                }
                $data = [
                    'user_id' => $users->id,
                    'token' => $users->createToken('maanRocketApp')->plainTextToken,
                    'token_type' => 'Bearer',
                ];

                return $this->respondWithSuccess('Success.', $data);
            }  else {
                return response()->json([
                    'success'   => false,
                    'message'   => __('Invalid refer code!'),
                ], 401);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => __('Email is already registered!'),
            ]);
        }
    }

    public function maanSignIn(Request $request)
    {
        $request->validate(
            [
                'email' => 'required|email',
                'password' => 'required'
            ]
        );
        $credentials = $request->only('email', 'password');

        if (Auth::guard('app_user')->attempt($credentials)) {
            $userInfo = Auth::guard('app_user')->user();
            if ($userInfo->status !== 0) {
                $data['user_id']    = $userInfo->id;
                $data['token']      = $userInfo->createToken('maanRocketApp')->plainTextToken;
                $data['name']       = $userInfo->name;
                $data['email']      = $userInfo->email;
                $data['refer']      = $userInfo->refer;

                User::updateAccessDate($userInfo->id);

                return $this->respondWithSuccess('User login successfully!', $data);
            } else {
                return response()->json([
                    'success'   => false,
                    'message'   => __('Sorry, your account is not active.'),
                ], 401);
            }
        } else {
            //If is invalid email or password
            return $this->respondWithError('Invalid Email or Password!', $request->all());
        }

    }
    public function maanSignOut(): JsonResponse
    {

        if (auth()->user()->currentAccessToken()->exists()) {
            \auth()->user()->currentAccessToken()->delete();
            return $this->respondWithSuccess('SignOut Successfully  !');
        } else {
            return $this->respondWithSuccess('SignOut Failed !');
        }
    }
    public function userRefreshToken(): JsonResponse
    {

        if (auth()->user()->currentAccessToken()->exists()) {
            \auth()->user()->currentAccessToken()->delete();
            $data['token'] = \auth()->user()->createToken('maanRocketApp')->plainTextToken;


            return $this->respondWithSuccess('Token Refresh Successfully  !', $data);
        } else {
            return $this->respondWithSuccess('SignOut Failed !');
        }
    }

    public function userInfo(): JsonResponse
    {
        if (\auth()->user()) {
            $data['user'] = User::with('wallet')->findOrFail(auth()->user()->id)->makeHidden(['password']);

            $data['withdraw_request_count'] = WithdrawRequest::witdrawRequestCountByUser(auth()->user()->id);
            $data['refer_user_count'] = User::userCountByRefer($data['user']->refer_code);

            return $this->respondWithSuccess('Get Data Successfully  !', $data);
        } else {
            return $this->respondWithSuccess('Sorry Unauthenticated  User !');
        }
    }

    public function profileUpdate(Request $request): JsonResponse
    {
        $request->validate([
            'name'             => 'required',
            'email'            => 'required|email|unique:users,email,' . auth()->user()->id,
            'phone'            => 'required|unique:users,phone,' . auth()->user()->id,

        ]);
        if (\auth()->user()) {
            $user = User::findOrFail(auth()->user()->id);
            //return $this->respondWithSuccess('Profile Update successfully!',$user->image);
            $data =  $request->only('name', 'email', 'phone');
            $data['image'] = CustomHelper::imageUploadApi($request->file('image'), 'back-end/img/users_image/', $user->image);
            $user->update($data);
            return $this->respondWithSuccess('Profile Update successfully!', $data);
        } else {
            return $this->respondWithErrorNotFound('User Info Not Found!');
        }
    }

    public function balanceInfo(): JsonResponse
    {
        if (\auth()->user()) {
            $data['balance_info'] = Wallet::where('user_id', auth()->user()->id)->get();
            return $this->respondWithSuccess('Get Data Successfully  !', $data);
        } else {
            return $this->respondWithSuccess('Sorry Unauthenticated  User !');
        }
    }

    public function passwordUpdate(Request $request): JsonResponse
    {
        $request->validate([
            'password' => 'required',
        ]);

        $data['password']  = bcrypt($request->password);
        if (Auth::user()) {
            User::where('id', auth()->user()->id)->update($data);

            return $this->respondWithSuccess('Password Update successfully!');
        } else {
            return $this->respondWithErrorNotFound('User Info Not Found!');
        }
    }
}
