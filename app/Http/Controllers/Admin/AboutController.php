<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function maanAbout()
    {
        $abouts = About::latest()->paginate(10);
        return view('admin.pages.about.about', compact('abouts'));
    }

    public function maanNewAbout(Request $request)
    {
        $request->validate([
            'title'          => 'required|string',
            'description'    => 'required|string',
            'years'          => 'required|numeric',
            'experience'     => 'required|string',
            'image'          => 'required|mimes:jpeg,png,jpg,gif,svg|dimensions:1200/800',
        ]);
        About ::addAbout($request);
        return redirect()->back()->with('message', 'Data added Successfully.');
    }

    public function maanDeleteAbout($id)
    {
        $this->about = About::find($id);
        $this->about->delete();
        if (file_exists($this->about->image))
        {
            unlink($this->about->image);
        }
        return redirect()->back()->with('error', 'Data Deleted');
    }


    public function maanAboutStatus($id)
    {
        $this->statusAbout = About::findOrFail($id);
        $this->statusAbout->status = $this->statusAbout->status == 1 ? 0 : 1;
        $this->statusAbout->save();
        return redirect()->back()->with('message','Status changed successfully');
    }
    public function maanEditAbout ($id)

    {
        return view('admin.pages.about.edit_about', [
            'info'      => About::find($id),
            'abouts'    => About::where('status', 1)->get(),
        ]);
    }
    public function maanUpdateAbout (Request $request, $id)
    {
        $request->validate([
            'title'          => 'required|string',
            'description'    => 'required|string',
            'years'          => 'required|numeric',
            'experience'     => 'required|string',
        ]);
        if ($request->image) {
            $request->validate([
                'image'          => 'required|mimes:jpeg,png,jpg,gif,svg|dimensions:1200/800',
            ]);
        }
        About::updateAbout($request, $id);
        return redirect('/about')->with('message', 'Data updated successfully.');
    }
}
