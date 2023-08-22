<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function maanServices()
    {
        $services = Service::with('serviceCategory')->latest()->paginate(10);
        return view('admin.pages.services.services',compact('services'), [
            'categories' => ServiceCategory::where('status', 1)->latest()->get(),
        ]);
    }

    public function maanNewServices(Request $request)
    {
        $request->validate([
            'service_category_id'    => 'required|integer',
            'title'                  => 'required|string',
            'description'            => 'required|string',
            'image'                  => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:1200/800',
        ]);
        Service::addServices($request);
        return redirect()->back()->with('message', 'Data added Successfully.');
    }

    public function maanDeleteServices($id)
    {
        $this->services = Service::find($id);
        $this->services->delete();
        return redirect()->back()->with('error', 'Data Deleted');
    }

    public function maanServicesStatus($id)
    {
        $this->statusServices = Service::findOrFail($id);
        $this->statusServices->status = $this->statusServices->status == 1 ? 0 : 1;
        $this->statusServices->save();
        return redirect()->back()->with('message', 'Status changed successfully');
    }

    public function maanEditServices ($id)
    {
        return view('admin.pages.services.edit_services', [
            'info'        => Service::find($id),
            'services'    => Service::where('status', 1)->get(),
            'categories' => ServiceCategory::where('status', 1)->get(),
        ]);
    }

    public function maanUpdateServices (Request $request, $id)
    {
        $request->validate([
            'service_category_id'    => 'required|integer',
            'title'                  => 'required|string',
            'description'            => 'required|string',
        ]);
        if ($request->image) {
            $request->validate([
                'image'                  => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:1200/800',
            ]);
        }
        Service::updateServices($request, $id);
        return redirect('/services')->with('message', 'Data updated successfully.');
    }
}
