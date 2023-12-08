<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Audio;
use App\Models\Artist;
use App\Models\AudioLike;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MusicController extends Controller
{
    public function musicList()
    {
        $musics = Audio::where('status', '>', 0)->with('artist')->latest()->get();

        $total = count($musics);

        return response()->json([
            'status' => true,
            'total' => $total,
            'musics' => $musics
        ]);
    }

    public function singleMuisc($id)
    {
        $currentMusic = Audio::with('artist')->find($id);

        $previousMusic = Audio::where('id', '<', $id)
                                ->first();

        $nextMusic = Audio::where('id', '>', $id)
                                ->first();

        if($currentMusic)
        {
            return response()->json([
                'status' => true,
                'previous_music' => $previousMusic,
                'current_music' => $currentMusic,
                'next_music' => $nextMusic
            ]);
        }
    }

    public function artistsList()
    {
        $artists = Artist::where('status', 1)->where('audio_count', ">", 0)->latest()->get();

        $total = count($artists);

        return response()->json([
            'status' => true,
            'total' => $total,
            'data' => $artists
        ]);
    }

    public function musicByArtist($id)
    {
        $musics = Artist::where('id', $id)->where('status', 1)->with('audio')->get();

        return response()->json([
            'status' => true,
            'data' => $musics
        ]);
    }

    public function giveLike(Request $request)
    {
        $user_id = Auth::user()->id;
        $audio_id = $request->audio_id;
        $like = $request->like;

        if($like == 0) {
            AudioLike::create([
                'user_id' => $user_id,
                'audio_id' => $audio_id,
                'like' => $like,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);

            return response()->json([
                'status' => true,
                'message' => "Added to favorite"
            ]);
        } else {
            $audio_like = AudioLike::where('user_id', $user_id)->where('audio_id', $audio_id)->first();

            $audio_like->delete();

            return response()->json([
                'status' => true,
                'message' => "Removed from favorite"
            ]);
        }
    }

    public function favoriteMusic()
    {
        $user_id = Auth::user()->id;

        $favorite_music = AudioLike::where('user_id', $user_id)->with('audio')->get()->groupBy('user_id');

        $total = AudioLike::where('user_id', $user_id)->count();

        return response()->json([
            'status' => true,
            'total' => $total,
            'data' => $favorite_music,
        ]);
    }
}
