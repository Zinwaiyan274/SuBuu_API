<?php

namespace App\Http\Controllers\Api;

use App\Models\Audio;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MusicController extends Controller
{
    public function musicList()
    {
        $musics = Audio::select('audio.*', 'artists.id as artist_id', 'artists.artist_name')
                    ->join('artists', 'audio.artist_id', 'artists.id')
                    ->where('audio.status', 1)
                    ->latest()
                    ->get();

        return response()->json([
            'status' => true,
            'musics' => $musics
        ]);
    }

    public function singleMuisc($id)
    {
        $currentMusic = Audio::find($id);

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
}
