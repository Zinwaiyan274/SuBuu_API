<?php

namespace App\Http\Controllers\Api;

use App\Models\Game;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GameController extends Controller
{
    public function gameList() {
        $games = Game::latest()->get();

        return response()->json([
            'status' => 'success',
            'data' => $games
        ]);
    }

    public function gameDetail($id) {
        $gameDetail = Game::find($id);

        return response()->json([
            'status' => 'success',
            'data' => $gameDetail
        ]);
    }
}
