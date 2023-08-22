<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function maanHistory()
    {
        $histories = History::with('user')
                        ->when(request('search'), function($q) {
                            $q->where('description', 'like', '%'.request('search').'%')
                            ->orWhere('amount', 'like', '%'.request('search').'%')
                            ->orWhere('status', 'like', '%'.request('search').'%')
                            ->orWhere('note', 'like', '%'.request('search').'%');
                        })
                        ->orWhereHas('user', function($query) {
                            $query->where('name', 'like', '%'.request('search').'%');
                        })
                        ->latest()
                        ->paginate(10);

        return view('back-end.pages.history.history', compact('histories'));
    }

    public function maanNewHistory(Request $request)
    {
        $request->validate([
            'user_name'     => 'required',
            'point_earned'  => 'required',
            'date'          => 'required',
        ]);
        History::addHistory($request);
        return redirect()->back()->with('message', 'Message sent successfully.');
    }
    public function maanDeleteHistory($id)
    {
        $this->history = History::find($id);
        $this->history->delete();
        return redirect()->back()->with('error', 'Data Deleted');
    }
    public function maanHistoryStatus($id)
    {
        $this->statusHistory = History::findOrFail($id);
        $this->statusHistory->status = $this->statusHistory->status == 1 ? 0 : 1;
        $this->statusHistory->save();
        return redirect()->back()->with('message', 'Status changed successfully');
    }
}
