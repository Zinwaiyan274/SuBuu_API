<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reward;
use Illuminate\Http\Request;

class RewardController extends Controller
{
    public function maanIndex()
    {
        $rewards = Reward::when(request('search'), function($q) {
                        $q->where('name', 'like', '%'.request('search').'%')
                        ->orWhere('reward_point', 'like', '%'.request('search').'%');
                    })
                    ->latest()
                    ->paginate(10);

        return view('back-end.pages.rewards.index',compact('rewards'));
    }

    public function maanStore(Request $request)
    {
        $request->validate([
            'name'          => 'required|max:100|unique:rewards',
            'reward_point'  => 'required|max:90000000'
        ]);

        $data = $request->only('name','reward_point', 'status');
        Reward::create($data);

        return response()->json([
            'message' => __('Reward created successfully!'),
            'redirect' => route('reward.index'),
        ]);
    }

    public function maanUpdate(Request $request, Reward $reward)
    {
        $request->validate([
            'name' =>  'required|unique:rewards,name,'.$reward->id,
            'reward_point' =>  'required'
        ]);
        $reward->update($request->only('name','reward_point', 'status'));

        return response()->json([
            'message' => __('Reward updated successfully!'),
            'redirect' => route('reward.index'),
        ]);
    }

    public function maanDestroy(Reward $reward)
    {
        $reward->delete();
        return response()->json([
            'message' => __('Reward delete successfully!'),
            'redirect' => route('reward.index'),
        ]);
    }
}
