<?php

namespace App\Http\Controllers\Admin;

use App\Models\Album;
use App\Models\Audio;
use App\Models\Artist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class AlbumController extends Controller
{
    public function maanAlbum()
    {
        $audios = Audio::get();
        $albums = Album::paginate(10);

        return view('back-end.pages.album.album', compact('audios', 'albums'));
    }

    public function maanNewAlbum(Request $request)
    {
        if($request){
            $audioList = implode(',', $request->audio);

            $file = $request->file('image');
            $fileName = uniqid().'_'.$file->getClientOriginalName();
            Storage::disk('public')->put('album_cover/'.$fileName, File::get($file));

            Album::insert([
                'image' => $fileName,
                'album_name' => $request->name,
                'status' => $request->status,
                'song_list' => $audioList
            ]);
        }

        return response()->json([
            'message' => __('Album created successfully.'),
            'redirect' => route('album'),
        ]);
    }

    public function maanViewAlbum($id)
    {
        $album = Album::find($id);
        $songs = explode(',', $album->song_list);

        $songLists = [];

        for($i = 0; $i < count($songs); $i++)
        {
            $songData = Audio::where('id', $songs[$i])->first();
            array_push($songLists, $songData);
        }

        return view('back-end.pages.album.album-view', compact('album', 'songLists'));
    }

    public function maanEditAlbum($id)
    {
        $album = Album::find($id);
        $songs = explode(',', $album->song_list);
        $allSongs = Audio::get();

        $songLists = [];

        for($i = 0; $i < count($songs); $i++)
        {
            $songData = Audio::where('id', $songs[$i])->first();
            array_push($songLists, $songData);
        }

        return view('back-end.pages.album.album-edit', compact('album', 'songLists', 'allSongs'));
    }

    public function maanUpdateAlbum(Request $request, $id)
    {
        $album = Album::find($id);

        if($request){
            $audioList = implode(',', $request->audio);

            if(File::exists(public_path().'/album_cover/'.$album->image)){
                File::delete(public_path().'/album_cover/'.$album->image);
            }

            $file = $request->file('image');
            $fileName = uniqid().'_'.$file->getClientOriginalName();
            Storage::disk('public')->put('album_cover/'.$fileName, File::get($file));

            Album::where('id', $id)->update([
                'image' => $fileName,
                'album_name' => $request->name,
                'status' => $request->status,
                'song_list' => $audioList
            ]);
        }

        return response()->json([
            'message' => __('Album updated successfully.'),
            'redirect' => route('album'),
        ]);
    }

    public function maanDeleteAlbum($id)
    {
        $album = Album::where('id', $id)->first();

        if(File::exists(public_path().'/album_cover/'.$album->image)){
            File::delete(public_path().'/album_cover/'.$album->image);
        }

        $album->delete();

        return response()->json([
            'message' => __('Album deleted successfully.'),
            'redirect' => route('album'),
        ]);
    }
}
