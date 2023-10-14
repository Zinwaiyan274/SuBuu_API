<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Movie;

class MovieController extends Controller
{
    public function movieList()
    {
        $movies =  Movie::with('categories')->paginate(10);

        return response()->json([
            'movies' => $movies
        ]);
    }

    public function movieDetail($id)
    {
        $movie = Movie::with('categories')->find($id);

        return response()->json([
            'movie' => $movie
        ]);
    }
}
