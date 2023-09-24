<?php

namespace App\Http\Controllers\Admin;

use App\Models\Movie;
use Illuminate\Support\Str;
use App\Helper\CustomHelper;
use Illuminate\Http\Request;
use App\Models\MovieCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class MovieCategoryController extends Controller
{
    // List
    public function maanCategory() {
        $categories = MovieCategory::when(request('search'), function ($q) {
            $q->where('name', 'like', '%' . request('search') . '%');
        })->latest()
        ->paginate(10);

        return view('back-end.pages.movie-category.movie-category', compact('categories'));
    }

    // Create
    public function maanNewCategory(Request $request) {
        $request->validate([
            'name' => 'required|max:100|min:2',
            'description' => 'nullable|max:1000',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:200/200|max:1024',
        ]);

        $imageUrl = CustomHelper::imageUpload($request->file('image'),'back-end/img/movie_category_image/');
        MovieCategory::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'image' => $imageUrl,
        ]);

        return response()->json([
            'message' => __('Category created successfully.'),
            'redirect' => route('movie-category'),
        ]);
    }

    // Edit
    public function maanEditCategory($id)
    {
        return view('back-end.pages.movie-category.edit-movie-category', [
            'info'          => MovieCategory::find($id),
            'categories'    => MovieCategory::where('status', 1)->get(),
        ]);
    }

    // Update
    public function maanUpdateCategory($id, Request $request) {
        $request->validate([
            'name' => 'required|max:100|min:2',
            'description' => 'nullable|max:1000',
        ]);

        $category = MovieCategory::find($id);
        if($category) {
            $category->image = CustomHelper::imageUpload($request->file('image'),'back-end/img/movie_category_image/', $category->image);
            $category->name = $request->name;
            $category->description = $request->description;
            $category->status = $request->status;
            $category->save();
        }

        return response()->json([
            'message' => __('Category updated successfully.'),
            'redirect' => route('movie-category'),
        ]);
    }

    // Delete
    public function maanDeleteCategory($id) {
        $category = MovieCategory::find($id);
        // delete image
        $imagePath = Str::after($category->image, url('/'));
        if(Storage::exists($imagePath)) {
            Storage::delete($imagePath);
        }
        $category->delete();

        return response()->json([
            'message' => __('Category deleted successfully.'),
            'redirect' => route('movie-category'),
        ]);
    }
}
