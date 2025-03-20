<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;


class InvoiceController extends Controller
{
    public function store(Request $request) {
        $data = new Invoice;
        $data->customer_name = $request->customer;
        $data->customer_mail = $request->email;
        $data->company = $request->company;
        $data->address = $request->address;
        $data->item = $request->item;
        $data->product_name = $request->name;
        $data->price = $request->unit_price;
        $data->quantity = $request->quantity;
        $data->total = $request->total;
        $data->payment = $request->payment;
        $data->due = $request->total - $request->payment;
        $data->save();

        // **Check if the order already exists**
        $existingOrder = Order::where('email', $request->email)
                              ->where('product_code', Product::where('name', $request->name)->value('product_code'))
                              ->where('order_status', 0)
                              ->first();

        if (!$existingOrder) {
            // **Create a new order only if it doesn't exist**
            $productCode = Product::where('name', $request->name)->first();
            $data2 = new Order;
            $data2->email = $request->email;
            $data2->product_code = $productCode->product_code;
            $data2->product_name = $request->name;
            $data2->quantity = $request->quantity;
            $data2->order_status = 1;
            $data2->save();
        } else {
            // **Update existing order instead of creating a duplicate**
            $existingOrder->update(['order_status' => 1, 'quantity' => $request->quantity]);
        }

        // **Customer Tracking**
        $customer = Customer::where('email', $request->email)->first();
        if ($customer === null) {
            $data3 = new Customer;
            $data3->name = $request->customer;
            $data3->email = $request->email;
            $data3->company = $request->company;
            $data3->address = $request->address;
            $data3->phone = $request->phone;
            $data3->save();
        }

        // **Stock Update**
        $products = Product::where('name', $request->name)->first();
        if (!$products) {
            return back()->with('error', 'Product not found.');
        }

        $mainqty = $products->stock;
        $nowqty = $mainqty - $request->quantity;
        $products->update(['stock' => $nowqty]);

        Order::where('email', $request->email)->update(['order_status' => '1']);

        return view('Admin.invoice_details', compact('data'));
    }

    public function downloadPDF($id)
    {
        $data = Invoice::findOrFail($id);

        // Directly create the HTML content instead of using a Blade view
        $html = '
        <h2 style="text-align: center;">Esay Stock Tracker</h2>
        <p>Invoice #: ' . $data->id . '<br> Created: ' . $data->created_at . '</p>
        <table border="1" cellspacing="0" cellpadding="5" width="100%">
            <tr style="background: #eee; font-weight: bold;">
                <td>Description</td><td>Details</td>
            </tr>
            <tr><td>Product Name</td><td>' . $data->product_name . '</td></tr>
            <tr><td>Product Quantity</td><td>' . $data->quantity . '</td></tr>
            <tr><td>Unit Price</td><td>' . $data->price . '</td></tr>
            <tr><td>Total Price</td><td>' . $data->total . '</td></tr>
            <tr><td>Payment</td><td>' . $data->payment . '</td></tr>
            <tr><td>Due</td><td>' . $data->due . '</td></tr>
            <tr><td>Status</td><td>Product on Delivery</td></tr>
        </table>';

        // Generate the PDF from the HTML content
        $pdf = Pdf::loadHTML($html);

        // Force download
        return $pdf->download('invoice_' . $data->id . '.pdf');
    }

    public function formData($id){
        $order = Order::where('id',$id)->first();
        $product = Product::where('product_code',$order->product_code)->first();
        $customer = Customer::where('email',$order->email)->first();
        return view('Admin.add_invoice',compact('order','product','customer'));
    }

    public function newformData(){
        $products = Product::all();
        $customers = Customer::all();
        return view('Admin.new_invoice',compact('products','customers'));
    }


    public function allInvoices(){
        $invoices = Invoice::all();
        return view('Admin.all_invoices',compact('invoices'));
    }

    public function soldProducts(){
        $products = Invoice::select('product_name', Invoice::raw("SUM(quantity) as count"))
        ->groupBy(Invoice::raw("product_name"))->get();
       // ?print_r($products);
        return view('Admin.sold_products',compact('products'));
    }

    public function delete(){
        Invoice::truncate();
    }

    public function show($id) {
        // Find the invoice by ID
        $data = Invoice::findOrFail($id);

        // Remove session after viewing invoice to allow new orders
        session()->forget(['invoice_generated', 'invoice_id']);

        return view('Admin.invoice_details', compact('data'));
    }

}
