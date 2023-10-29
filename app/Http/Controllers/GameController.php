<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Support\Str;
use App\Helper\CustomHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GameController extends Controller
{
    public function maanGame() {
        $games = Game::when(request('search'), function ($q) {
            $q->where('title', 'like', '%' . request('search') . '%');
        })->latest()
        ->paginate(10);

        return view('back-end.pages.game.index', compact('games'));
    }

    public function maanNewGame(Request $request) {
        $fields = $this->MakeValidation($request);

        $heroImageUrl = CustomHelper::imageUpload($request->file('hero_image'),'back-end/img/hero_image/');
        $coverImageUrl = CustomHelper::imageUpload($request->file('cover_image'),'back-end/img/cover_image/');
        $fields['hero_image'] = $heroImageUrl;
        $fields['cover_image'] = $coverImageUrl;
        $game = Game::create($fields);

        return response()->json([
            'message' => __('Game created successfully.'),
            'redirect' => route('game'),
        ]);
    }

    // Edit
    public function maanEditGame($id)
    {
        return view('back-end.pages.game.edit-game', [
            'info'  => Game::find($id),
        ]);
    }

    public function maanUpdateGame($id, Request $request) {
        $fields = $this->MakeValidation($request);

        $game = Game::find($id);
        if($game) {
            $game->title = $request->title;
            $game->hero_image = CustomHelper::imageUpload($request->file('hero_image'),'back-end/img/hero_image/', $game->hero_image);
            $game->cover_image = CustomHelper::imageUpload($request->file('cover_image'),'back-end/img/cover_image/', $game->cover_image);
            $game->status = $request->status;
            $game->save();
        }

        return response()->json([
            'message' => __('Game updated successfully.'),
            'redirect' => route('game'),
        ]);
    }

    public function maanDeleteGame($id) {
        $game = Game::find($id);
        // delete image
        $heroImage = Str::after($game->hero_image, url('/'));
        $coverImage = Str::after($game->cover_image, url('/'));
        if(Storage::exists($heroImage)) {
            Storage::delete($heroImage);
        }
        if(Storage::exists($coverImage)) {
            Storage::delete($coverImage);
        }
        $game->delete();

        return response()->json([
            'message' => __('Game deleted successfully.'),
            'redirect' => route('game'),
        ]);
    }

    private function MakeValidation($request) {
        $validator = $request->validate([
            'title' => 'required|string|max:255',
            'hero_image' => 'required|image|mimes:png,jpg,jpeg,svg,webp,gif|max:2048',
            'cover_image' => 'required|image|mimes:png,jpg,jpeg,svg,webp,gif|max:2048',
            'game_link' => 'required|string',
            'status' => 'required|integer'
        ]);

        return $validator;
    }
}
