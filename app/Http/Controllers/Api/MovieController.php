<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Movie;

class MovieController extends Controller
{
    public function movieList()
    {
        $movies =  Movie::with('movieCategory')->latest()->paginate(10);

        return response()->json([
            'movies' => $movies
        ]);
    }

    public function movieDetail($id)
    {
        $movie = Movie::with('movieCategory')->find($id);

        return response()->json([
            'movie' => $movie
        ]);
    }
}
