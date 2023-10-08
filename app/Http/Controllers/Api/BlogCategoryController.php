<?php

namespace App\Http\Controllers\Api;

use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogCategoryController extends Controller
{
    public function categoryList() {
        $categories = BlogCategory::all();

        return response()->json([
            'status' => 'success',
            'data' => $categories
        ]);
    }
}
