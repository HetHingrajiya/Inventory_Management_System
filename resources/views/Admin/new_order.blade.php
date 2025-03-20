@extends('layouts.admin_master')

@section('content')

<main>
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-lg border-0 rounded-lg">
                <div class="card-header text-center bg-primary text-white">
                    <h3 class="fw-bold my-2"><i class="fas fa-plus-circle"></i> New Order</h3>
                </div>
                <div class="card-body bg-light">
                    <form method="POST" action="{{ url('/insert-new-order') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <!-- Customer Name -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold"><i class="fas fa-user"></i> Customer Name</label>
                                <select id="name" name="name" class="form-control select2 rounded" required>
                                    <option selected disabled>Choose...</option>
                                    @foreach($customers as $c)
                                        <option value="{{ $c->id }}">{{ $c->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Dynamic Customer Info Fields -->
                            <div class="col-md-6" id="email"></div>
                            <div class="col-md-6" id="company"></div>
                            <div class="col-md-6" id="address"></div>
                            <div class="col-md-6" id="phone"></div>

                            <!-- Product Code -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold"><i class="fas fa-barcode"></i> Product Code</label>
                                <select name="code" class="form-control select2 rounded" required>
                                    <option selected disabled>Choose...</option>
                                    @foreach($products as $row)
                                        @if($row->stock > 1)
                                            <option>{{ $row->product_code }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <!-- Product Name -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold"><i class="fas fa-box"></i> Product Name</label>
                                <select name="product_name" class="form-control select2 rounded" required>
                                    <option selected disabled>Choose...</option>
                                    @foreach($products as $row)
                                        @if($row->stock > 1)
                                            <option value="{{ $row->name }}">{{ $row->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <!-- Quantity -->
                            <div class="col-md-6">
                                <label class="form-label fw-bold"><i class="fas fa-sort-numeric-up"></i> Quantity</label>
                                <input class="form-control rounded" name="quantity" type="number" min="1" placeholder="Enter Quantity" required/>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-4 text-center">
                            <button class="btn btn-primary btn-lg px-4 rounded-pill shadow-sm">
                                <i class="fas fa-save"></i> Submit Order
                            </button>
                        </div>
                    </form>
                     <!-- Back to Dashboard Button -->
                    <div class="text-center mt-3">
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Dashboard
                        </a>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
</main>

<!-- Font Awesome for Icons -->
<script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

<!-- jQuery & AJAX -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
    $("#name").change(function() {
        var customerId = $(this).val();
        $.ajax({
            type: 'POST',
            url: "{{ url('/api/get-customer') }}",
            dataType: 'json',
            data: { "id": customerId },
            success: function(data) {
                $("#email").html('<label class="form-label fw-bold"><i class="fas fa-envelope"></i> Email</label>' +
                    '<input class="form-control rounded" name="email" value="'+data.customer.email+'" type="text" readonly/>');

                $("#company").html('<label class="form-label fw-bold"><i class="fas fa-building"></i> Company</label>' +
                    '<input class="form-control rounded" name="company" value="'+data.customer.company+'" type="text" readonly/>');

                $("#phone").html('<label class="form-label fw-bold"><i class="fas fa-phone"></i> Phone</label>' +
                    '<input class="form-control rounded" name="phone" value="'+data.customer.phone+'" type="text" readonly/>');

                $("#address").html('<label class="form-label fw-bold"><i class="fas fa-map-marker-alt"></i> Address</label>' +
                    '<input class="form-control rounded" name="address" value="'+data.customer.address+'" type="text" readonly/>');
            }
        });
    });
});
</script>

@endsection
