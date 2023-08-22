<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function maanGallery()
    {
        $galleries = Gallery::latest()->paginate(10);
        return view('admin.pages.gallery.gallery',compact('galleries'));
    }

    public function maanNewGallery(Request $request)
    {
        $request->validate([
            'image'          => 'required|mimes:jpeg,png,jpg,gif,svg|dimensions:1200/800',
        ]);
        Gallery ::addGallery($request);
        return redirect()->back()->with('message', 'Data added Successfully.');
    }

    public function maanDeleteGallery($id)
    {
        $this->gallery = Gallery::find($id);
        $this->gallery->delete();
        return redirect()->back()->with('error', 'Data Deleted');
    }


    public function maanGalleryStatus($id)
    {
        $this->statusgallery = Gallery::findOrFail($id);
        $this->statusgallery->status = $this->statusgallery->status == 1 ? 0 : 1;
        $this->statusgallery->save();
        return redirect()->back()->with('message','Status changed successfully');
    }
    public function maanEditGallery ($id)

    {
        return view('admin.pages.gallery.edit_gallery', [
            'info'      => Gallery::find($id),
            'galleries'    => Gallery::where('status', 1)->get(),
        ]);
    }
    public function maanUpdateGallery (Request $request, $id)
    {
        if ($request->image) {
            $request->validate([
                'image'          => 'required|mimes:jpeg,png,jpg,gif,svg|dimensions:1200/800',
            ]);
        }
        Gallery::updateGallery($request, $id);
        return redirect('/gallery')->with('message', 'Data updated successfully.');
    }
}
