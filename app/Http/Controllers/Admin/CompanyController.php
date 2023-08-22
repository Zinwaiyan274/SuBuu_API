<?php

namespace App\Http\Controllers\Admin;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class CompanyController extends Controller
{
    public function maanCompany()
    {
        $companies = Company::latest()->paginate(10);
        return view('admin.pages.company.company',compact('companies'));
    }

    public function maanNewCompany(Request $request)
    {
        $request->validate([
            'name'          => 'required',
            'address'       => 'required',
            'phone'         => 'required|numeric|unique:companies',
            'email'         => 'required|email|unique:companies',
            'location'      => 'required',
            'open'          => 'required|date',
            'close'         => 'required|date',
            'image'         => 'mimes:pdf|max:2048'
        ]);
        Company::addCompany($request);
        Cache::forget('company');
        return redirect()->back()->with('message', 'Data added Successfully');
    }

    public function maanDeleteCompany($id)
    {
        $this->company = Company::find($id);
        $this->company->delete();
        if (file_exists($this->company->image))
        {
            unlink($this->company->image);
        }
        Cache::forget('company');
        return redirect()->back()->with('error', 'Data Deleted');
    }


    public function maanCompanyStatus($id)
    {
        $this->statusCompany = Company::findOrFail($id);
        $this->statusCompany->status = $this->statusCompany->status == 1 ? 0 : 1;
        $this->statusCompany->save();
        Cache::forget('company');
        return redirect()->back()->with('message', 'Status changed successfully');
    }
    public function maanEditCompany ($id)
    {
        return view('admin.pages.company.edit_company', [
            'info'         => Company::find($id),
            'companies'    => Company::where('status', 1)->get(),
        ]);
    }
    public function maanUpdateCompany (Request $request, $id)
    {
        $request->validate([
            'name'          => 'required',
            'address'       => 'required',
            'phone'         => 'required|numeric|unique:companies,phone,'.$id,
            'email'         => 'required|email|unique:companies,email,'.$id,
            'location'      => 'required',
            'open'          => 'required|date',
            'close'         => 'required|date',
        ]);
        if ($request->image) {
            $request->validate([
                'image'         => 'required|mimes:pdf|max:2048'
            ]);
        }
        Company::updateCompany($request, $id);
        Cache::forget('company');
        return redirect('/company')->with('message', 'Data updated successfully.');
    }
}
