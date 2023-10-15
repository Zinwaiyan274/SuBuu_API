<?php

namespace App\Http\Controllers\Admin;

use App\Models\Artist;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ArtistController extends Controller
{
    public function maanArtist()
    {
        $artists = Artist::latest()->paginate(10);

        return view('back-end.pages.artist.artist', compact('artists'));
    }

    public function maanNewArtist(Request $request)
    {
        if($request){
            $file = $request->file('image');
            $fileName = uniqid().'_'.$file->getClientOriginalName();
            Storage::disk('public')->put('artist_image/'.$fileName, File::get($file));

            Artist::create([
                'image' => $fileName,
                'artist_name' => $request->name,
                'status' => $request->status
            ]);
        }

        return response()->json([
            'message' => __('Artist created successfully.'),
            'redirect' => route('artist'),
        ]);
    }

    public function maanViewArtist($id)
    {
        $artist = Artist::find($id);

        return view('back-end.pages.artist.artist-view', compact('artist'));
    }

    public function maanEditArtist($id)
    {
        $artist = Artist::find($id);

        return view('back-end.pages.artist.artist-edit', compact('artist'));
    }

    public function maanUpdateArtist(Request $request, $id)
    {
        $artist = Artist::find($id);

        if($request){
            if(File::exists(public_path().'/artist_image/'.$artist->image)){
                File::delete(public_path().'/artist_image/'.$artist->image);
            }

            $file = $request->file('image');
            $fileName = uniqid().'_'.$file->getClientOriginalName();
            Storage::disk('public')->put('artist_image/'.$fileName, File::get($file));

            Artist::where('id', $id)->update([
                'image' => $fileName,
                'artist_name' => $request->name,
                'status' => $request->status
            ]);
        }

        return response()->json([
            'message' => __('Artist updated successfully.'),
            'redirect' => route('artist'),
        ]);
    }

    public function maanDeleteArtist($id)
    {
        $artist = Artist::find($id);

        if($artist) {
            if(File::exists(public_path().'/artist_image/'.$artist->image)){
                File::delete(public_path().'/artist_image/'.$artist->image);
            }

            $artist->delete();
        }

        return response()->json([
            'message' => __('Artist Deleted Successfully'),
            'redirect' => route('artist'),
        ]);
    }
}
