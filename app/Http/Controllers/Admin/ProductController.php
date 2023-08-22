<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HelperController;
use App\Models\Partner;
use App\Models\Project;
use App\Models\ProductType;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public $products;
    public function maanProduct()
    {
        $categories = ProductType::where('status',1)->latest()->get();
        $products = Product::with('productCategory')->latest()->paginate(10);
        return view('admin.pages.products.add',compact('products','categories'));
    }
    public function maanNewProduct(Request $request)
    {
        $request->validate([
            'category_id'     => 'required|integer',
            'name'            => 'required|string',
            'description'     => 'required|string',
            'image'           => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:200/200',
        ]);
        $product = new Product();
        $product->category_id  = $request->category_id;
        $product->name  = $request->name;
        $product->description  = $request->description;
        $product->image  = (new HelperController())->imageUpload($request->file('image'),'back-end/img/subCategory_image/');
        $product->status  = $request->status;
        $product->save();
        return redirect()->back()->with('message', 'Data added Successfully.');
    }
    public function maanDeleteProduct($id)
    {
        $this->product = Product::find($id);
        $this->product->delete();
        if (file_exists($this->product->image))
        {
            unlink($this->product->image);
        }
        return redirect()->back()->with('error', 'Data Deleted');
    }

    public function maanProductStatus($id)
    {
        $this->status = Product::findOrFail($id);
        $this->status->status = $this->status->status == 1 ? 0 : 1;
        $this->status->save();
        return redirect()->back()->with('message', 'Status changed successfully');
    }
    public function maanEditProduct($id)
    {
        return view('admin.pages.products.edit', [
            'info'  => Product::find($id),
            'categories' => ProductType::where('status',1)->latest()->get()
        ]);
    }
    public function maanUpdateProduct(Request $request, $id)
    {
        $request->validate([
            'category_id'     => 'required|integer',
            'name'            => 'required|string',
            'description'     => 'required|string'
        ]);
        if ($request->image) {
            $request->validate([
                'image'           => 'required|image|mimes:jpeg,png,jpg,gif,svg|dimensions:200/200'
            ]);
        }
        $product = Product::find($id);
        $product->category_id  = $request->category_id;
        $product->name         = $request->name;
        $product->description  = $request->description;
        $product->image        = (new HelperController())->imageUpload($request->file('image'),'back-end/img/partner_image/',$product->image);
        $product->status       = $request->status;
        $product->save();
        return redirect('/products')->with('message', 'Data updated successfully.');
    }
}
