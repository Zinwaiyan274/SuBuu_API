<?php

namespace App\Http\Controllers\Admin;

use DOMDocument;
use App\Models\Blog;
use Illuminate\Support\Str;
use App\Helper\CustomHelper;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BlogCategoryController extends Controller
{
    // List
    public function maanCategory() {
        $categories = BlogCategory::when(request('search'), function ($q) {
            $q->where('name', 'like', '%' . request('search') . '%');
        })->latest()
        ->paginate(10);

        return view('back-end.pages.blog-category.blog-category', compact('categories'));
    }

    // Create
    public function maanNewCategory(Request $request) {
        $request->validate([
            'name' => 'required|max:100|min:2',
            'description' => 'nullable|max:1000',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:200/200|max:1024',
        ]);

        $imageUrl = CustomHelper::imageUpload($request->file('image'),'back-end/img/blog_category_image/');
        BlogCategory::create([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
            'image' => $imageUrl,
        ]);

        return response()->json([
            'message' => __('Category created successfully.'),
            'redirect' => route('blog-category'),
        ]);
    }

    // Edit
    public function maanEditCategory($id)
    {
        return view('back-end.pages.blog-category.edit-blog-category', [
            'info'          => BlogCategory::find($id),
            'categories'    => BlogCategory::where('status', 1)->get(),
        ]);
    }

    // Update
    public function maanUpdateCategory($id, Request $request) {
        $request->validate([
            'name' => 'required|max:100|min:2',
            'description' => 'nullable|max:1000',
        ]);

        $category = BlogCategory::find($id);
        if($category) {
            $category->image = CustomHelper::imageUpload($request->file('image'),'back-end/img/blog_category_image/', $category->image);
            $category->name = $request->name;
            $category->description = $request->description;
            $category->status = $request->status;
            $category->save();
        }

        return response()->json([
            'message' => __('Category updated successfully.'),
            'redirect' => route('blog-category'),
        ]);
    }

    // Delete
    public function maanDeleteCategory($id) {
        $this->DeleteBlogs($id);

        $category = BlogCategory::find($id);
        // delete image
        $imagePath = Str::after($category->image, url('/'));
        if(Storage::exists($imagePath)) {
            Storage::delete($imagePath);
        }
        $category->delete();

        return response()->json([
            'message' => __('Category deleted successfully.'),
            'redirect' => route('blog-category'),
        ]);
    }

    private function DeleteBlogs($categoryId) {
        $blogs = Blog::where('category_id', $categoryId)->get();
        foreach ($blogs as $key => $blog) {
            $dom = new DOMDocument();
            $dom->loadHtml($blog->content, 9);
            $images = $dom->getElementsByTagName('img');
            foreach($images as $key => $img) {
                $src = $img->getAttribute('src');
                $imagePath = Str::after($src, url('/'));
                if (Storage::exists($imagePath)) {
                    Storage::delete($imagePath);
                }
            }
        }
        Blog::where('category_id', $categoryId)->delete();
    }
}
