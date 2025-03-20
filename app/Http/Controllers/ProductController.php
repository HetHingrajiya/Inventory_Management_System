<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    // public function __construct(){
    // 	$this->middleware('auth');
    // }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
        $order = Order::with('product')->find($id);
        $product = $order ? $order->product : null;

    }
    public function store(Request $request){

    	$data=new Product;
        $data->product_code=$request->code;
    	$data->name= $request->name;
        $data->category = $request->category;
    	$data->stock = $request->stock;
    	$data->unit_price = $request->unit_price;
    	// $data->total_price = $request->stock * $request->unit_price;
        $data->sales_unit_price = $request->sale_price;
        // $data->sales_stock_price =$request->stock * $request->sale_price;


        $data->save();
        return Redirect()->route('all.product');
    }

    public function allProduct(){
    	$products = Product::all();
    	return view('Admin.all_product',compact('products'));
    }

    public function availableProducts(){
        $products = Product::where('stock','>','0')->get();
        return view('Admin.available_products',compact('products'));
    }

    public function formData($id){
        $product = Product::find($id);

        return view('Admin.add_order',compact('product'));
        // return view('Admin.add_order',['product'=>$product]);
    }

    public function purchaseData($id){
        $product = Product::find($id);

        return view('Admin.purchase_products',compact('product'));
    }

    public function storePurchase(Request $request){

        Product::where('name',$request->name)->update(['stock' => $request->stock + $request->purchase]);

        return Redirect()->route('all.product');
    }

    public function destroy($id)
    {
        // Find the product by ID
        $product = Product::findOrFail($id);

        // Delete the product
        $product->delete();

        // Redirect to a specific page, like the products list, with a success message
        return redirect()->route('all.product')->with('success', 'Product deleted successfully.');
    }

    public function edit($id)
    {
        // Fetch the product using the provided $id
        $products = Product::findOrFail($id);

        // Return a view with the product data
        return view('Admin.all_product', compact('products'));
    }


}
