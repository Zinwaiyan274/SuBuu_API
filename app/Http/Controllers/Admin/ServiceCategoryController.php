<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class ServiceCategoryController extends Controller
{
    public function maanCategory()
    {
        $servicecategory= ServiceCategory::latest()->paginate(10);
        return view('admin.pages.service-category.category',compact('servicecategory'),[
            'categories' => ServiceCategory::latest()->get()]);
    }

    public function maanNewCategory(Request $request)
    {
        $request->validate([
            'name'          => 'required|unique:service_categories',
        ]);
        ServiceCategory ::addCategory($request);
        return redirect()->back()->with('message', 'Data added Successfully.');
    }

    public function maanDeleteCategory($id)
    {
        $this->category = ServiceCategory::find($id);
        $this->category->delete();
        return redirect()->back()->with('error', 'Data Deleted');
    }


    public function maanCategoryStatus($id)
    {
        $this->statusCategory = ServiceCategory::findOrFail($id);
        $this->statusCategory->status = $this->statusCategory->status == 1 ? 0 : 1;
        $this->statusCategory->save();
        return redirect()->back()->with('message','Status changed successfully');
    }
    public function maanEditCategory ($id)

    {
        return view('admin.pages.service-category.edit_category', [
            'info'          => ServiceCategory::find($id),
            'categories'    => ServiceCategory::where('status', 1)->get(),
        ]);
    }
    public function maanUpdateCategory (Request $request, $id)
    {
        $request->validate([
            'name'          => 'required|unique:service_categories,name,'.$id,
        ]);
        ServiceCategory::updateCategory($request, $id);
        return redirect('/category')->with('message', 'Data updated successfully.');
    }
}
