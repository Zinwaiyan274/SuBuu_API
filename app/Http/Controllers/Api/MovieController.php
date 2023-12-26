<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Movie;

class MovieController extends Controller
{
    public function movieList($page)
    {
        $per_page = 5;
        $skip = ($page - 1) * $per_page;

        // $movies =  Movie::with('categories')->paginate(10);
        $movies = Movie::skip($skip)->take($perPage)->with('categories')->get(); // Adjust the model

        return response()->json([
            'movies' => $movies
        ]);
    }

    public function movieDetail($id)
    {
        $movie = Movie::with('categories')->find($id);

        if($movie) {
            return response()->json([
                'movie' => $movie
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Invalid movie id'
            ]);
        }
    }
}
