<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WithdrawMethod;
use App\Models\WithdrawRequest;
use Illuminate\Http\Request;

class WithdrawRequestController extends Controller
{
    public function maanWithdrawRequest()
    {
        $requests = WithdrawRequest::with('user:id,name', 'methodName:id,name', 'convert.currency:id,symbol')
                    ->when(request('search'), function($q) {
                        $q->where('account', 'like', '%'.request('search').'%')
                        ->orWhere('amount', 'like', '%'.request('search').'%')
                        ->orWhere('coins', 'like', '%'.request('search').'%');
                    })
                    ->orWhereHas('user', function($query) {
                        $query->where('name', 'like', '%'.request('search').'%');
                    })
                    ->orWhereHas('methodName', function($method) {
                        $method->where('name', 'like', '%'.request('search').'%');
                    })
                    ->latest()
                    ->paginate(10);

        return view('back-end.pages.withdraw-request.withdraw_request', compact('requests'));
    }

    public function maanNewWithdrawRequest(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'amount' => 'required',
            'points' => 'required',
            'account' => 'required',
            'method_id' => 'required',
        ]);
        WithdrawRequest::addRequest($request);
        return redirect()->back()->with('message', 'Data added Successfully.');
    }

    public function maanDeleteWithdrawRequest($id)
    {
        $this->request = WithdrawRequest::find($id);
        $this->request->delete();
        return redirect()->back()->with('error', 'Data Deleted');
    }

    public function maanEditWithdrawRequest($id)
    {
        return view('back-end.pages.withdraw-request.edit_withdraw_request', [
            'info' => WithdrawRequest::find($id),
            'requests' => WithdrawRequest::where('status', 1)->get(),
            'methods' => WithdrawMethod::where('status', 1)->get(),
        ]);
    }

    public function maanUpdateWithdrawRequest(Request $request, $id)
    {
        WithdrawRequest::updateRequest($request, $id);
        return redirect('/withdraw-request')->with('message', 'Data updated successfully.');
    }
}
