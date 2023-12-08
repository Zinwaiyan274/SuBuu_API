<?php

namespace App\Http\Controllers\Admin;

use App\Models\Audio;
use App\Models\Artist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class MusicController extends Controller
{
    public function maanMusic()
    {
        $audios = Audio::select('audio.*', 'artists.id as artist_id', 'artists.artist_name')
                ->join('artists', 'audio.artist_id', 'artists.id')
                ->latest()
                ->paginate(10);
        $artists = Artist::get();
        // $artist_name = Artist::where($audios->artist_id, $artists->id)->frist();

        return view('back-end.pages.audio.audio', compact('audios', 'artists'));
    }

    public function maanNewAudio(Request $request)
    {
        if($request){
            $file = $request->file('image');
            $fileName = uniqid().'_'.$file->getClientOriginalName();
            Storage::disk('public')->put('audio_cover/'.$fileName, File::get($file));

            $audioFile = $request->file('audio');
            $audioName = uniqid().'_'.$audioFile->getClientOriginalName();
            Storage::disk('public')->put('audio_file/'.$audioName, File::get($audioFile));

            Audio::create([
                'image' => $fileName,
                'audio' => $audioName,
                'audio_title' => $request->title,
                'artist_id' => $request->artist,
                'status' => $request->status
            ]);

            $artist = Artist::where('id', $request->artist)->first();
            $artist->update([
                'audio_count' => $artist->audio_count + 1
            ]);
        }

        return response()->json([
            'message' => __('Audio created successfully.'),
            'redirect' => route('audio'),
        ]);
    }

    public function maanViewAudio($id)
    {
        $audio = Audio::find($id);
        $artist = Artist::where('id', $audio->artist_id)->first();

        return view('back-end.pages.audio.audio-view', compact('audio', 'artist'));
    }

    public function maanEditAudio($id)
    {
        $audio = Audio::find($id);
        $artist = Artist::where('id', $audio->artist_id)->first();
        $artists = Artist::get();

        return view('back-end.pages.audio.audio-edit', compact('audio', 'artist', 'artists'));
    }

    public function maanUpdateAudio(Request $request, $id)
    {
        $audio = Audio::find($id);

        if($request){
            if(File::exists(public_path().'/audio_cover/'.$audio->image)){
                File::delete(public_path().'/audio_cover/'.$audio->image);
            }

            if(File::exists(public_path().'/audio_file/'.$audio->audio)){
                File::delete(public_path().'/audio_file/'.$audio->audio);
            }

            $file = $request->file('image');
            $fileName = uniqid().'_'.$file->getClientOriginalName();
            Storage::disk('public')->put('audio_cover/'.$fileName, File::get($file));

            $audioFile = $request->file('audio');
            $audioName = uniqid().'_'.$audioFile->getClientOriginalName();
            Storage::disk('public')->put('audio_file/'.$audioName, File::get($audioFile));

            Audio::where('id', $id)->update([
                'image' => $fileName,
                'audio' => $audioName,
                'audio_title' => $request->title,
                'artist_id' => $request->artist,
                'status' => $request->status
            ]);
        }

        return response()->json([
            'message' => __('Audio updated successfully.'),
            'redirect' => route('audio'),
        ]);
    }

    public function maanDeleteAudio($id)
    {
        $audio = Audio::find($id);

        if($audio) {
            if(File::exists(public_path().'/audio_cover/'.$audio->image)){
                File::delete(public_path().'/audio_cover/'.$audio->image);
            }

            $audio->delete();

            $artist = Artist::where('id', $audio->artist_id)->first();
            $artist->update([
                'audio_count' => $artist->audio_count - 1
            ]);
        }

        return response()->json([
            'message' => __('Audio Deleted Successfully'),
            'redirect' => route('audio'),
        ]);
    }
}
