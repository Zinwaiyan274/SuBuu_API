<?php

namespace App\Http\Controllers\Admin;

use App\helper\CustomHelper;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperController;
use App\Models\Partner;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    public $partner;
    public function maanPartner()
    {
        $partners = Partner::latest()->paginate(10);
        return view('admin.pages.partner.add',compact('partners'));

    }

    public function maanNewPartner(Request $request)
    {
        $request->validate([
            'name'            => 'required',
            'image'           => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:200/200',
        ]);

        $partner = new Partner();
        $partner->name  = $request->name;
        $partner->image  = (new HelperController())->imageUpload($request->file('image'),'back-end/img/partner_image/');
        $partner->status  = $request->status;
        $partner->save();
        return redirect()->back()->with('message', 'Data added Successfully.');
    }
    public function maanDeletePartner($id)
    {
        $this->partner = Partner::find($id);
        $this->partner->delete();
        return redirect()->back()->with('error', 'Data Deleted');
    }

    public function maanPartnerStatus($id)
    {
        $this->status = Partner::findOrFail($id);
        $this->status->status = $this->status->status == 1 ? 0 : 1;
        $this->status->save();
        return redirect()->back()->with('message', 'Status changed successfully');
    }
    public function maanEditPartner ($id)

    {
        return view('admin.pages.partner.edit', [
            'info'  => Partner::find($id)
        ]);
    }
    public function maanUpdatePartner (Request $request, $id)
    {
        $request->validate([
            'name'            => 'required',
        ]);
        if ($request->image) {
            $request->validate([
                'image'           => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:200/200',
            ]);
        }
        $partner = Partner::find($id);
        $partner->name                   = $request->name;
        $partner->image                  = (new HelperController())->imageUpload($request->file('image'),'back-end/img/partner_image/',$partner->image);
        $partner->status                 = $request->status;
        $partner->save();
        return redirect('/partner')->with('message', 'Data updated successfully.');
    }
}
