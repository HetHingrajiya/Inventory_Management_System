@extends('layouts.admin_master')

@section('content')

<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header bg-primary text-white text-center">
                        <h4><i class="fas fa-file-invoice-dollar me-2"></i> Create New Invoice</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('/insert-invoice') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <!-- Customer Details -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1"><i class="fas fa-user"></i> Customer Name</label>
                                        <input class="form-control" name="customer" type="text" value="{{ $customer->name }}" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1"><i class="fas fa-envelope"></i> Customer Email</label>
                                        <input class="form-control" name="email" type="text" value="{{ $customer->email }}" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1"><i class="fas fa-building"></i> Company</label>
                                        <input class="form-control" name="company" type="text" value="{{ $customer->company }}" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1"><i class="fas fa-map-marker-alt"></i> Address</label>
                                        <input class="form-control" name="address" type="text" value="{{ $customer->address }}" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1"><i class="fas fa-phone"></i> Phone No.</label>
                                        <input class="form-control" name="phone" type="text" value="{{ $customer->phone }}" />
                                    </div>
                                </div>

                                <!-- Product Details -->
                                <div class="col-12"><hr class="my-3"></div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1"><i class="fas fa-tags"></i> Product Category</label>
                                        <input class="form-control" name="item" type="text" value="{{ $product->category }}" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1"><i class="fas fa-box"></i> Product Name</label>
                                        <input class="form-control" name="name" type="text" value="{{ $product->name }}" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1"><i class="fas fa-dollar-sign"></i> Price (per Unit)</label>
                                        <input class="form-control" name="unit_price" type="text" value="{{ $product->unit_price }}" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1"><i class="fas fa-sort-numeric-up"></i> Quantity</label>
                                        <input class="form-control" name="quantity" type="text" value="{{ $order->quantity ?? '' }}" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1"><i class="fas fa-calculator"></i> Total Price</label>
                                        <input class="form-control" name="total" type="text" value="{{ isset($product, $order) ? $product->unit_price * $order->quantity : '' }}" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1"><i class="fas fa-wallet"></i> Payment</label>
                                        <input class="form-control" name="payment" type="text" placeholder="Enter payment amount" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-4 mb-0">
                                <button type="submit" class="btn btn-success btn-block">
                                    <i class="fas fa-save"></i> Submit Invoice
                                </button>
                            </div>
                        </form>
                    </div>
                </div> <!-- Card End -->
            </div> <!-- Col End -->
        </div> <!-- Row End -->
    </div> <!-- Container End -->
</main>

@endsection
