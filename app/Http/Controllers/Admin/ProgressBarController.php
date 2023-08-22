<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProgressBar;
use Illuminate\Http\Request;

class ProgressBarController extends Controller
{
    public function maanProgress()
    {
        $progress = ProgressBar::latest()->paginate(10);
        return view('admin.pages.progress-bar.progress_bar', compact('progress'));
    }

    public function maanNewProgress(Request $request)
    {
        $request->validate([
            'name'          => 'required|string',
            'color'         => 'required|string',
            'percent'       => 'required|integer',
        ]);
        ProgressBar ::addProgress($request);
        return redirect()->back()->with('message', 'Data added Successfully.');
    }

    public function maanDeleteProgress($id)
    {
        $this->progress = ProgressBar::find($id);
        $this->progress->delete();
        return redirect()->back()->with('error', 'Data Deleted');
    }


    public function maanProgressStatus($id)
    {
        $this->statusProgress = ProgressBar::findOrFail($id);
        $this->statusProgress->status = $this->statusProgress->status == 1 ? 0 : 1;
        $this->statusProgress->save();
        return redirect()->back()->with('message','Status changed successfully');
    }
    public function maanEditProgress ($id)

    {
        return view('admin.pages.progress-bar.edit_progress_bar', [
            'info'      => ProgressBar::find($id),
            'progress'    => ProgressBar::where('status', 1)->get(),
        ]);
    }
    public function maanUpdateProgress (Request $request, $id)
    {
        $request->validate([
            'name'          => 'required|string',
            'color'         => 'required|string',
            'percent'       => 'required|integer',
        ]);
        ProgressBar::updateProgress($request, $id);
        return redirect('/progress')->with('message', 'Data updated successfully.');
    }
}
