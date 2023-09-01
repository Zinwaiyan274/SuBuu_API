<?php

namespace App\Http\Controllers\Api;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    // blog list
    public function blogList() {
        $postList = Blog::latest()->get();

        return response()->json([
            'status' => 'success',
            'data' => $postList
        ]);
    }

    // details
    public function blogDetail($id) {
        $post = Blog::find($id);

        return response()->json([
            'status' => 'success',
            'data' => $post
        ]);
    }
}
