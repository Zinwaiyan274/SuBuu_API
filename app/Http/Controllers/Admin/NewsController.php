<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use App\Models\News;
use App\Models\NewsCategory;
use App\Models\UserType;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function maanNews()
    {
        $blogs = News::with('newsCategory', 'userTypeBlog')->latest()->paginate(10);
        return view('admin.pages.news.news',compact('blogs'),[
            'categories' => NewsCategory::where('status', 1)->get(),
            'types'      => AdminUser::where('status', 1)->get()
        ]);
    }

    public function maanNewNews(Request $request)
    {
        $request->validate([
            'category_id'       => 'required|integer',
            'user_id'           => 'required|integer',
            'title'             => 'required|string',
            'description'       => 'required|string',
            'image'             => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:1200/800',
            'date'              => 'required|date',
            'tag'               => 'required|string',
        ]);
        News::addNews($request);
        return redirect()->back()->with('message', 'Data added Successfully.');
    }
    public function maanDeleteNews($id)
    {
        $this->news = News::find($id);
        $this->news->delete();
        return redirect()->back()->with('error', 'Data Deleted');
    }


    public function maanNewsStatus($id)
    {
        $this->statusNews = News::findOrFail($id);
        $this->statusNews->status = $this->statusNews->status == 1 ? 0 : 1;
        $this->statusNews->save();
        return redirect()->back()->with('message', 'Status changed successfully');
    }
    public function maanEditNews ($id)

    {
        return view('admin.pages.news.edit_news', [
            'info'       => News::find($id),
            'news'       => News::where('status', 1)->get(),
            'types'      => AdminUser::where('status', 1)->get(),
            'categories' => NewsCategory::where('status', 1)->get(),
        ]);
    }
    public function maanUpdateNews (Request $request, $id)
    {
        $request->validate([
            'category_id'       => 'required',
            'user_id'           => 'required',
            'title'             => 'required',
            'description'       => 'required',
            'date'              => 'required',
            'tag'               => 'required',
        ]);
        if ($request->image) {
            $request->validate([
                'image'             => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:1200/800',
            ]);
        }
        News::updateNews($request, $id);
        return redirect('/news')->with('message', 'Data updated successfully.');
    }
}
