<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductTypeController extends Controller
{
    public function maanProductType()
    {
        $productType = ProductType::latest()->paginate(10);
        return view('admin.pages.product-type.product_type',compact('productType'));
    }

    public function maanNewProductType(Request $request)
    {
        $request->validate([
            'name'          => 'required|string',
            'image'          => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:500/400',
        ]);
        ProductType ::addType($request);
        return redirect()->back()->with('message', 'Data added Successfully.');
    }

    public function maanDeleteProductType($id)
    {
        $this->type = ProductType::find($id);
        $this->type->delete();
        return redirect()->back()->with('error', 'Data Deleted');
    }


    public function maanEditProductType ($id)

    {
        return view('admin.pages.product-type.edit_product_type', [
            'info'          => ProductType::find($id),
            'types'         => ProductType::where('status', 1)->get(),
        ]);
    }
    public function maanUpdateProductType (Request $request, $id)
    {
        $request->validate([
            'name'          => 'required|string',
        ]);
        if ($request->image) {
            $request->validate([
                'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:500/400',
            ]);
        }
        ProductType::updateType($request, $id);
        return redirect('/product-type')->with('message', 'Data updated successfully.');
    }
}
