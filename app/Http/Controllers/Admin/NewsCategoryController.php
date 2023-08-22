<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsCategory;
use Illuminate\Http\Request;

class NewsCategoryController extends Controller
{
    public function maanNewsCategory()
    {
        $newscategory = NewsCategory::latest()->paginate(10);
        return view('admin.pages.news-category.news_category',compact('newscategory'),[
            'categories' => NewsCategory::latest()->get()]);
    }

    public function maanNewNewsCategory(Request $request)
    {
        $request->validate([
            'name'          => 'required|string',
        ]);
        NewsCategory ::addCategory($request);
        return redirect()->back()->with('message', 'Data added Successfully.');
    }

    public function maanDeleteNewsCategory($id)
    {
        $this->category = NewsCategory::find($id);
        $this->category->delete();
        return redirect()->back()->with('error', 'Data Deleted');
    }


    public function maanNewsCategoryStatus($id)
    {
        $this->statusCategory = NewsCategory::findOrFail($id);
        $this->statusCategory->status = $this->statusCategory->status == 1 ? 0 : 1;
        $this->statusCategory->save();
        return redirect()->back()->with('message','Status changed successfully');
    }
    public function maanEditNewsCategory ($id)

    {
        return view('admin.pages.news-category.edit_news_category', [
            'info'          => NewsCategory::find($id),
            'categories'    => NewsCategory::where('status', 1)->get(),
        ]);
    }
    public function maanUpdateNewsCategory (Request $request, $id)
    {
        $request->validate([
            'name'          => 'required|string',
        ]);
        NewsCategory::updateCategory($request, $id);
        return redirect('/news-category')->with('message', 'Data updated successfully.');
    }
}
