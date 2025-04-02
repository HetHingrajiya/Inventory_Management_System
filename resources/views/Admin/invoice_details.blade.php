@extends('layouts.admin_master')

@section('content')
<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $data->id }}</title>
    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            font-family: Arial, sans-serif;
            color: #555;
        }
        .invoice-box table {
            width: 100%;
            text-align: left;
        }
        .invoice-box table td {
            padding: 5px;
        }
        .heading {
            background: #eee;
            font-weight: bold;
        }
    </style>
</head>

<main>
<body>
    <div class="invoice-box">
        <h2>Easy Stock Tracker</h2>
        <p>Invoice #: {{ $data->id }}<br> Created: {{ $data->created_at }}</p>
        <a href="{{ route('invoice.pdf', $data->id) }}" class="btn btn-primary">Download PDF</a>

        <table>
            <tr class="heading">
                <td>Description</td><td>Details</td>
            </tr>
            <tr><td>Product Name</td><td>{{ $data->product_name }}</td></tr>
            <tr><td>Product Quantity</td><td>{{ $data->quantity }}</td></tr>
            <tr><td>Unit Price</td><td>{{ $data->price }}</td></tr>
            <tr><td>Total Price</td><td>{{ $data->total }}</td></tr>
            <tr><td>Payment</td><td>{{ $data->payment }}</td></tr>
            <tr><td>Due</td><td>{{ $data->due }}</td></tr>
            <tr><td>Status</td><td>Product on Delivery</td></tr>
        </table>

        <div class="card-footer text-center bg-white">
                <a href="{{ route('all.orders') }}" class="btn btn-secondary rounded-pill px-4">
                    <i class="fas fa-arrow-left"></i> Back to Order
                </a>
            </div>
    </div>
</body>
</main>
@endsection
