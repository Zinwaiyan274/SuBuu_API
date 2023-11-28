<?php

namespace App\Http\Controllers\Admin;

use App\Models\Movie;
use App\Helper\CustomHelper;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\MovieCategory;
use App\Models\NotificationType;
use App\Http\Controllers\Controller;

class MovieController extends Controller
{
    public function index()
    {
        $movies =  Movie::with('categories')->paginate(10);

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
            'category_id' => 'required',
            'thumbnail' => 'required|mimes:png,jpg,svg,jpeg,gif|max:2028',
        ]);

        $imageUrl = CustomHelper::imageUpload($request->file('thumbnail'),'back-end/img/thumbnails/');

            $movie = Movie::create([
                'title' => $request->title,
                'description'=> $request->description,
                'url' => $request->url,
                'thumbnail' => $imageUrl,
            ]);

            $movie->categories()->attach($request->category_id);

            $notification_type = NotificationType::where("name", "Other")->get();

            $type_id =  $notification_type->first()->id;

            $notification = Notification::create([
                "type_id" => $type_id,
                "data" => [
                    "message" => "New Movie Added",
                ],
            ]);

            return response()->json([
                'message' => 'Movies Created Successfully!',
                'redirect' => route('movies'),
            ]);
    }

    public function edit($id)
    {
        $movie_info = Movie::find($id);

        $movie_categories = $movie_info->categories->pluck('id')->all();

        $categories = MovieCategory::all();

        return view('back-end.pages.movie.edit-movie', [
            'movie_info' => $movie_info,
            'movie_categories'=> $movie_categories,
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

        $movie = Movie::find($id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'url' => $request->url,
            'thumbnail'=> CustomHelper::imageUpload($request->thumbnail  , 'backend/img/thumbnails/' , $oldRecord->thumbnail),
        ]);

        $oldRecord->categories()->sync($request->category_id);

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
