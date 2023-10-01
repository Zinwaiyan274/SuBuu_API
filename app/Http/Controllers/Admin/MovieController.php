<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Helper\CustomHelper;
use App\Models\MovieCategory;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $movies =  Movie::latest()->paginate(10);

        $categories = MovieCategory::all();

        return view('back-end.pages.movie.movie', compact('movies' , 'categories'));
    }
    public function getAllMovies()
    {
        $movies =  Movie::latest()->paginate(10);

        return response()->json([
            'movies' => $movies
        ]);
    }

    public function getMovieById($id)
    {
        $movie = Movie::find($id)->get();

        return response()->json($movie);
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required|max:200|min:2',
            'url' => 'required',
            'description' => 'required|string',
            'category_id' => 'required|string',
            'thumbnail' => 'required|mimes:png,jpg,svg,jpeg,gif|max:2028',
        ]);

        $imageUrl = CustomHelper::imageUpload($request->file('thumbnail'),'back-end/img/thumbnails/');

            Movie::create([
                'title' => $request->title,            
                'description'=> $request->description,
                'url' => $request->url,
                'category_id' => $request->category_id,
                'thumbnail' => $imageUrl,
            ]);

            return response()->json([
                'message' => 'Movies Created Successfully!',
                'redirect' => route('movies'),
            ]);
    }

    public function edit($id)
    {
        $movie_info = Movie::find($id);
        $categories = MovieCategory::all();

        return view('back-end.pages.movie.edit-movie', [
            'info' => $movie_info,
            'categories'=> $categories,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:200|min:2',
            'url' => 'required|string',
            'description' => 'required|string',
            'category_id' => 'required',
            'thumbnail' => 'mimes:png,jpg,svg,jpeg,gif|max:2028',
        ]);
        
        $oldRecord = Movie::find($id);

        Movie::find($id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'url' => $request->url,
            'thumbnail'=> CustomHelper::imageUpload($request->thumbnail  , 'backend/img/thumbnails/' , $oldRecord->thumbnail),
        ]);

        return redirect('/movies')->with('message', 'Movie updated successfully.');
    }

    public function delete($id)
    {
        Movie::find($id)->delete();

        return response()->json([
            'message' => 'Deleted Successfully!',
            'redirect' => route('movies'),
        ]);
    }
}
