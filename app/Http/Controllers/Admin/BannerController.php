<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function maanBanner()
    {
        $banners = Banner::latest()->paginate(10);
        return view('admin.pages.banner.banner', compact('banners'));
    }

    public function maanNewBanner(Request $request)
    {
        $request->validate([
            'sub_title'      => 'required',
            'title'          => 'required',
            'description'    => 'required',
            'image'          => 'required|mimes:jpeg,png,jpg,gif,svg|dimensions:1200/800',
            'video'          => 'required',
        ]);
        Banner ::addBanner($request);
        return redirect()->back()->with('message', 'Data added successfully.');
    }

    public function maanDeleteBanner($id)
    {
        $this->banner = Banner::find($id);
        $this->banner->delete();
        if (file_exists($this->banner->image))
        {
            unlink($this->banner->image);
        }
        return redirect()->back()->with('error', 'Data Deleted');
    }


    public function maanBannerStatus($id)
    {
        $this->statusBanner = Banner::findOrFail($id);
        $this->statusBanner->status = $this->statusBanner->status == 1 ? 0 : 1;
        $this->statusBanner->save();
        return redirect()->back()->with('message','Status changed successfully.');
    }
    public function maanEditBanner ($id)

    {
        return view('admin.pages.banner.edit_banner', [
            'info'      => Banner::find($id),
            'banners'    => Banner::where('status', 1)->get(),
        ]);
    }
    public function maanUpdateBanner (Request $request, $id)
    {
        $request->validate([
            'sub_title'      => 'required',
            'title'          => 'required',
            'description'    => 'required',
            'video'          => 'required',
        ]);
        if ($request->image) {
            $request->validate([
                'image'          => 'required|mimes:jpeg,png,jpg,gif,svg|dimensions:1200/800',
            ]);
        }
        if ($request->image) {
            $request->validate([
                'video'          => 'required',
            ]);
        }
        Banner::updateBanner($request, $id);
        return redirect('/banner')->with('message', 'Data updated successfully.');
    }
}
