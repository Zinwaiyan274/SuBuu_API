<?php

namespace App\Http\Controllers\Admin;

use DOMDocument;
use App\Models\Blog;
use Illuminate\Support\Str;
use App\Helper\CustomHelper;
// use Illuminate\Support\Facades\File;
use App\Models\BlogCategory;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\NotificationType;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function maanBlog()
    {
        $categories = BlogCategory::where('status', 1)->get();
        $posts = Blog::when(request('search'), function ($q) {
                    $q->where('title', 'like', '%' . request('search') . '%');
                })->latest()
                ->paginate(10);

        return view('back-end.pages.blog.blog', compact('categories', 'posts'));
    }

    public function maanViewBlog($id) {
        Log::info($id);
        $post = Blog::where('id', $id)->get()->first();
        return view(
            'back-end.pages.blog.blog-view',
            ['title' => $post->title, 'content' => $post->content, 'cover_image' => $post->cover_image]
        );
    }

    // create
    public function maanNewBlog(Request $request) {
        $this->BlogValidation($request);

        $content = $this->StoreImage($request);
        $coverImageUrl = CustomHelper::imageUpload($request->file('cover_image'),'back-end/img/blog_cover_image/');
        Blog::create([
            'title' => $request->title,
            'cover_image' => $coverImageUrl,
            'content' => $content,
            'category_id' => $request->category_id,
        ]);

        $notification_type = NotificationType::where("name", "Other")->get();

        $type_id =  $notification_type->first()->id;

        $notification = Notification::create([
            "type_id" => $type_id,
            "data" => [
                "message" => "New Blog Added",
            ],
        ]);

        return response()->json([
            'message' => __('blog created successfully.'),
            'redirect' => route('blog'),
        ]);
    }

    // delete
    public function maanDeleteBlog($id) {
        $blog = Blog::find($id);

        if($blog) {
            if($blog->cover_image) {
                Storage::delete($blog->cover_image);
            }
            $this->DeleteImage($blog->content);
            $blog->delete();
        }

        return response()->json([
            'message' => __('Blog Deleted Successfully'),
            'redirect' => route('blog'),
        ]);
    }

    // edit
    public function maanEditBlog($id) {
        return view('back-end.pages.blog.blog-edit', [
            'info' => Blog::find($id),
            'categories' => BlogCategory::where('status', 1)->get(),
            ]
        );
    }

    // update
    public function maanUpdateBlog($id, Request $request) {
        $this->BlogValidation($request);

        $blog = Blog::find($id);
        if($blog->cover_image) {
            Storage::delete($blog->cover_image);
        }
        if($blog) {
            $content = $this->StoreImage($request);
            $coverImageUrl = CustomHelper::imageUpload($request->file('cover_image'),'back-end/img/blog_cover_image/', $blog->cover_image);
            Blog::where('id', $id)->update([
                'title' => $request->title,
                'cover_image' => $coverImageUrl,
                'content' => $content,
                'category_id' => $request->category_id,
            ]);
        }

        return response()->json([
            'message' => __('Blog deleted successfully.'),
            'redirect' => route('blog'),
        ]);
    }


    // validation
    private function BlogValidation($request) {
        $request->validate([
            'title' => 'required|string|max:225',
            'content' => 'required',
            'category_id' => 'required|integer|max:20'
        ]);
    }

    // Store images
    private function StoreImage($request) {
        $dom = new DOMDocument();
        $dom->loadHtml($request->content, 9);
        $images = $dom->getElementsByTagName('img');
        foreach($images as $key => $img) {
            if(strpos($img->getAttribute('src'), 'data:image/') === 0) {
                $data = base64_decode(explode(',', explode(';', $img->getAttribute('src'))[1])[1]);
                $dir = '/back-end/img/blog_image/';
                $imagePath = $dir . time() . $key . '.png';
                if (!Storage::exists($dir)) {
                    Storage::makeDirectory($dir);
                }
                Storage::put($imagePath, $data);
                $img->removeAttribute('src');
                $img->setAttribute('src', url('/').$imagePath);
            }
        }
        $content = $dom->saveHtml();
        return $content;
    }

    // Delete images
    private function DeleteImage($content) {
        $dom = new DOMDocument();
        $dom->loadHtml($content, 9);
        $images = $dom->getElementsByTagName('img');
        foreach($images as $key => $img) {
            $src = $img->getAttribute('src');
            $imagePath = Str::after($src, url('/'));
            if (Storage::exists($imagePath)) {
                Storage::delete($imagePath);
            }
        }
    }
}
