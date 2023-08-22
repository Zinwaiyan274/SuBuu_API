<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\HasUploader;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use HasUploader;

    public function maanUser()
    {
        $users = User::with('wallet')
            ->when(request('search'), function ($q) {
                $q->where('name', 'like', '%' . request('search') . '%')
                    ->orWhere('email', 'like', '%' . request('search') . '%')
                    ->orWhere('phone', 'like', '%' . request('search') . '%')
                    ->orWhere('refer', 'like', '%' . request('search') . '%')
                    ->orWhere('user_type', 'like', '%' . request('search') . '%')
                    ->orWhere('refer_code', 'like', '%' . request('search') . '%');
            })
            ->latest()
            ->paginate(10);
        return view('back-end.pages.user.user', compact('users'));
    }

    /**
     * Store a listing of the requested data.
     *
     */
    public function maanNewUser(Request $request)
    {
        $request->validate([
            'name' => 'required|min:2|max:100',
            'email' => 'required|email|unique:users|max:100',
            'password' => 'required|min:4|max:20',
            'balance' => 'nullable|max:1000000',
            'phone' => 'required|unique:users',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:300/300',
            'refer' => 'nullable|exists:users,refer_code',
            'user_type' => 'required',
        ]);

        User::addUsers($request);
        return response()->json([
            'message' => __('User created successfully.'),
            'redirect' => route('user'),
        ]);
    }

    /**
     * Destroy  of the  requested data.
     *
     */
    public function maanDeleteUser($id)
    {
        $user = User::find($id);
        if (file_exists($user->image)) {
            unlink($user->image);
        }
        $user->delete();
        return response()->json([
            'message' => __('User deleted successfully.'),
            'redirect' => route('user'),
        ]);
    }

    public function maanEditUser($id)
    {
        return view('back-end.pages.user.edit_user', [
            'info'      => User::find($id),
        ]);
    }

    public function maanUpdateUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:100|min:2',
            'email' => 'required|email|max:100|unique:users,email,' . $id,
            'phone' => 'required|string|max:20|min:5|unique:users,phone,' . $id,
            'user_type' => 'required|string|max:15|min:2',
            'balance' => 'nullable|max:1000000|integer',
            'password' => 'nullable|string|max:20|min:4',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|dimensions:300/300',
            'refer' => 'nullable|exists:users,refer_code',
        ]);

        $user = User::findOrFail($id);

        if ($request->old_password || $request->new_password) {
            $request->validate([
                'old_password' => 'required|min:4|max:20',
                'password' => 'required|min:4|max:20|confirmed',
            ]);

            if (!Hash::check($request->old_password, $user->password)) {
                return response()->json([
                    'message' => __('Old password is wrong.')
                ], 402);
            }
        }

        $user->wallet()->update([
            'balance' => $request->balance
        ]);

        $user->update($request->except('password', 'image') + [
            'image' => $request->image ? $this->upload($request, 'image', $user->image) : $user->image,
            'password' => $request->old_password ? Hash::make($request->password) : $user->password,
        ]);

        return response()->json([
            'message' => __('User updated successfully.'),
            'redirect' => route('user'),
        ]);
    }
}
