<?php

namespace App\Http\Controllers\Api;

use App\Models\Blog;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    // blog list
    public function blogList() {
        $postList = Blog::latest()->get();

        foreach ($postList as $post) {
            $post->added_date = $post->created_at->diffForHumans();
        }

        return response()->json([
            'success' => true,
            'data' => $postList
        ]);
    }

    // details
    public function blogDetail($id) {
        $post = Blog::find($id);

        return response()->json([
            'success' => true,
            'data' => $post
        ]);
    }
}
