<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function search(Request $request){
        $search = $request->input('search');

        $posts = News::where('title', 'LIKE', "%{$search}%")
            ->orWhere('description', 'LIKE', "%{$search}%")
            ->get();

        return view('search', compact('posts'));
    }
}
