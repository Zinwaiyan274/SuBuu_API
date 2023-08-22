<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserType;
use Illuminate\Http\Request;

class UserTypeController extends Controller
{
    public function maanUserType()
    {
        $usertype = UserType::latest()->paginate(10);
        return view('admin.pages.user-type.user_type',compact('usertype'),[
            'types' => UserType::latest()->get()]);
    }

    public function maanNewUserType(Request $request)
    {
        $request->validate([
            'name'    => 'required',
        ]);
        UserType ::addUserType($request);
        return redirect()->back()->with('message', 'Data added Successfully.');
    }

    public function maanDeleteUserType($id)
    {
        $this->userType = UserType::find($id);
        $this->userType->delete();
        return redirect()->back()->with('error', 'Data Deleted');
    }


    public function maanUserTypeStatus($id)
    {
        $this->statususerType= UserType::findOrFail($id);
        $this->statususerType->status = $this->statususerType->status == 1 ? 0 : 1;
        $this->statususerType->save();
        return redirect()->back()->with('message', 'Status changed successfully');
    }
    public function maanEditUserType ($id)

    {
        return view('admin.pages.user-type.edit_user_type', [
            'info'          => UserType::find($id),
            'categories'    => UserType::where('status', 1)->get(),
        ]);
    }
    public function maanUpdateUserType (Request $request, $id)
    {
        $request->validate([
            'name'    => 'required',
        ]);
        UserType::updateUserType($request, $id);
        return redirect('/user-type')->with('message', 'Data updated successfully.');
    }
}
