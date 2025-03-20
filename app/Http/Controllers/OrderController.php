<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;

class OrderController extends Controller
{
    public function store(Request $request) {
        // Check if an order with the same email and product already exists
        $existingOrder = Order::where('email', $request->email)
                              ->where('product_code', $request->code)
                              ->where('order_status', 0) // Pending orders only
                              ->first();

        if ($existingOrder) {
            return redirect()->route('all.orders')->with('error', 'Order already exists!');
        }

        // Create new order if no duplicate is found
        $data = new Order;
        $data->email = $request->email;
        $data->product_code = $request->code;
        $data->product_name = $request->name;
        $data->quantity = $request->quantity;
        $data->order_status = 0;
        $data->save();

        return redirect()->route('all.orders')->with('success', 'Order added successfully!');
    }

    public function newStore(Request $request) {
        // Check if order already exists
        $existingOrder = Order::where('email', $request->email)
                              ->where('product_code', $request->code)
                              ->where('order_status', 0) // Pending orders only
                              ->first();

        if ($existingOrder) {
            return redirect()->route('all.orders')->with('error', 'Order already exists!');
        }

        // Create new order
        $data = new Order;
        $data->email = $request->email;
        $data->product_code = $request->code;
        $data->product_name = $request->name;
        $data->quantity = $request->quantity;
        $data->order_status = 0;
        $data->save();

        // Check if customer exists, else create a new one
        $customer = Customer::where('email', $request->email)->first();
        if (!$customer) {
            $data3 = new Customer;
            $data3->name = $request->name;
            $data3->email = $request->email;
            $data3->company = $request->company;
            $data3->address = $request->address;
            $data3->phone = $request->phone;
            $data3->save();
        }

        return redirect()->route('all.orders')->with('success', 'Order added successfully!');
    }


    public function newformData(){
        $products = Product::all();
        $customers = Customer::get();
        return view('Admin.new_order',compact('products','customers'));
    }

    public function ordersData(){
        $orders = Order::all();
        return view('Admin.all_orders',compact('orders'));
    }

    public function pendingOrders(){
        $orders = Order::where('order_status','=','0')->get();
        return view('Admin.pending_orders',compact('orders'));
    }

    public function deliveredOrders(){
        $orders = Order::where('order_status','!=','0')->get();
        return view('Admin.delivered_orders',compact('orders'));
    }
}
