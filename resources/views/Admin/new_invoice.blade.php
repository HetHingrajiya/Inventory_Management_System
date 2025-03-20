@extends('layouts.admin_master')

@section('content')

<main>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header bg-primary text-white text-center">
                        <h3 class="mb-0"><i class="fas fa-file-invoice-dollar"></i> Create New Invoice</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('/insert-invoice') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <!-- Customer Name -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold"><i class="fas fa-user"></i> Customer Name</label>
                                <select id="name" name="customer_name" class="form-control select2" required>
                                    <option value="" disabled selected>Choose...</option>
                                    @foreach($customers as $c)
                                        <option value="{{$c->name}}">{{ $c->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Customer Email -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold"><i class="fas fa-envelope"></i> Email</label>
                                <input class="form-control" name="email" type="text" placeholder="Customer Email" readonly/>
                            </div>

                            <!-- Company Name -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold"><i class="fas fa-building"></i> Company</label>
                                <input class="form-control" name="company" type="text" placeholder="Company Name" readonly/>
                            </div>

                            <!-- Address -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold"><i class="fas fa-map-marker-alt"></i> Address</label>
                                <input class="form-control" name="address" type="text" placeholder="Customer Address" readonly/>
                            </div>

                            <!-- Phone -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold"><i class="fas fa-phone"></i> Phone</label>
                                <input class="form-control" name="phone" type="text" placeholder="Phone Number" readonly/>
                            </div>

                            <!-- Product Category -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold"><i class="fas fa-tags"></i> Product Category</label>
                                <input class="form-control" name="category" type="text" placeholder="Product Category"/>
                            </div>

                            <!-- Product Name -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold"><i class="fas fa-box"></i> Product Name</label>
                                <input class="form-control" name="name" type="text" placeholder="Product Name"/>
                            </div>

                            <!-- Price per Unit (₹ instead of $) -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold"><i class="fas fa-rupee-sign"></i> Price (per Unit)</label>
                                <input class="form-control" name="unit_price" type="text" placeholder="Unit Price"/>
                            </div>

                            <!-- Quantity -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold"><i class="fas fa-sort-numeric-up"></i> Quantity</label>
                                <input class="form-control" name="quantity" type="text" placeholder="Quantity"/>
                            </div>

                            <!-- Total Price (₹ instead of $) -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold"><i class="fas fa-coins"></i> Total Price</label>
                                <input class="form-control" name="total" type="text" placeholder="Total Price"/>
                            </div>

                            <!-- Payment Method -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold"><i class="fas fa-credit-card"></i> Payment</label>
                                <input class="form-control" name="payment" type="text" placeholder="Payment Method"/>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-4 d-grid">
                            <button class="btn btn-success btn-lg"><i class="fas fa-check-circle"></i> Submit Invoice</button>
                        </div>
                        </form>
                    </div>
                </div>

                <!-- Back to Dashboard Button -->
                <div class="text-center mt-3">
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Dashboard
                    </a>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- jQuery & AJAX Script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("#name").change(function() {
        var c_name = $("#name").val();
        $.ajax({
            type: 'POST',
            url: "{{ url('/api/get-customer') }}",
            dataType: 'json',
            data: { "id" : c_name },
            success: function(data) {
                $("input[name='email']").val(data.customer.email);
                $("input[name='company']").val(data.customer.company);
                $("input[name='phone']").val(data.customer.phone);
                $("input[name='address']").val(data.customer.address);
            }
        });
    });
});
</script>

@endsection
