<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\WithdrawMethod;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class WithdrawMethodController extends Controller
{
    public function maanWithdrawMethod()
    {
        $methods = WithdrawMethod::latest()
                    ->when(request('search'), function($q) {
                        $q->where('name', 'like', '%'.request('search').'%')
                        ->orWhere('minimum_amount', 'like', '%'.request('search').'%');
                    })
                    ->paginate(10);
        return view('back-end.pages.withdraw-method.withdraw_method', compact('methods'));
    }

    public function maanNewWithdrawMethod(Request $request)
    {
        $request->validate([
            'status' => 'required|integer|max:1',
            'name' => 'required|string|max:100|min:2',
            'minimum_amount' => 'required|integer|max:1000000',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:200/200|max:1024',
        ]);

        WithdrawMethod::addMethod($request);
        return response()->json([
            'message' => __('Withdraw method created successfully.'),
            'redirect' => route('withdraw-method'),
        ]);
    }
    /**
     * Destroy  of the  requested data.
     *
     */
    public function maanDeleteWithdrawMethod($id)
    {
        $method = WithdrawMethod::find($id);
        if (file_exists($method->image)) {
            Storage::delete($method->image);
        }
        $method->delete();
        return response()->json([
            'message' => __('Withdraw method deleted successfully.'),
            'redirect' => route('withdraw-method'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     */
    public function maanEditWithdrawMethod($id)
    {
        $info = WithdrawMethod::findOrFail($id);
        return view('back-end.pages.withdraw-method.edit_withdraw_method', compact('info'));
    }
    /**
     * Updated a listing of the  requested data.
     *
     */
    public function maanUpdateWithdrawMethod(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|integer|max:1',
            'name' => 'required|string|max:100|min:2',
            'minimum_amount' => 'required|integer|max:1000000',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:200/200|max:1024',
        ]);

        WithdrawMethod::updateMethod($request, $id);
        return response()->json([
            'message' => __('Withdraw method updated successfully.'),
            'redirect' => route('withdraw-method'),
        ]);
    }
}
