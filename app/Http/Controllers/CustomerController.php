<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    // List all customers
    public function index()
    {
        $customers = Customer::all();
        return view('dashbord.dashbord', [
            'customer' => $customers
        ]);
    }

    // Show all customers in admin view
    public function customersData()
    {
        $customers = Customer::all();
        return view('Admin.all_customers', compact('customers'));
    }

    // Show the form to create a new customer
    public function create()
    {
        return view('customer.create');
    }

    // Store a new customer in database
    public function store(Request $request)
    {
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->company = $request->company;
        $customer->address = $request->address;
        $customer->phone = $request->phone;
        $customer->save();

        return redirect()->route('add.customer');
    }

    // Show the form to edit a customer
    public function edit($id)
    {
        $customer = Customer::find($id);
        return view('Admin.edit_customer', compact('customer'));
    }

    // Update customer info
    public function update($id, Request $request)
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return redirect()->back()->with(['msg' => 2]); // Not found
        }

        $customer->name = $request->name;
        $customer->email = $request->email;
        $customer->company = $request->company;
        $customer->address = $request->address;
        $customer->phone = $request->phone;

        if ($request->has('is_active')) {
            $customer->is_active = 1;
        }

        if ($customer->save()) {
            return redirect()->back()->with(['msg' => 1]); // Success
        } else {
            return redirect()->back()->with(['msg' => 2]); // Failure
        }
    }

    // Delete customer (this is the missing 'destroy' method!)
    public function destroy($id)
    {
        $customer = Customer::find($id);

        if ($customer && $customer->delete()) {
            return redirect()->back()->with(['msg' => 1]); // Deleted
        } else {
            return redirect()->back()->with(['msg' => 2]); // Failed
        }
    }
}
