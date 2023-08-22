<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FAQ;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function maanFAQ()
    {
        $faqs = FAQ::latest()->paginate(5);
        return view('admin.pages.faq.add',compact('faqs'));
    }

    public function maanNewFAQ(Request $request)
    {
        $request->validate([
            'question'          => 'required',
            'answer'            => 'required',
        ]);
        FAQ::addFAQ($request);
        return redirect()->back()->with('message','Data added Successfully.');
    }
    public function maanDeleteFAQ($id)
    {
        $this->faq = FAQ::find($id);
        $this->faq->delete();
        return redirect()->back()->with('error', 'Data Deleted');
    }


    public function maanFAQStatus($id)
    {
        $this->statusFAQ = FAQ::findOrFail($id);
        $this->statusFAQ->status = $this->statusFAQ->status == 1 ? 0 : 1;
        $this->statusFAQ->save();
        return redirect()->back()->with('message', 'Status changed successfully');
    }
    public function maanEditFAQ ($id)
    {
        return view('admin.pages.faq.edit', [
            'info'        => FAQ::find($id),
            'faq'    => FAQ::where('status', 1)->get(),
        ]);
    }
    public function maanUpdateFAQ (Request $request, $id)
    {
        $request->validate([
            'question'          => 'required',
            'answer'            => 'required',
        ]);
        FAQ::updateFAQ($request, $id);
        return redirect('/faq')->with('message', 'Data updated successfully.');
    }
}
