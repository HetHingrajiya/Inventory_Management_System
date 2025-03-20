@extends('layouts.admin_master')

@section('content')

<main>
<div class="container ">
    <div class="row justify-content-center">
        <div class="col-lg-7">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header text-center bg-primary text-white">
                    <h4 class="font-weight-light my-2"><i class="fas fa-plus-circle"></i> New Order</h4>
                </div>
                <div class="card-body bg-light">
                    <form method="POST" action="{{ url('/insert-new-order') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <!-- Customer Name -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small font-weight-bold"><i class="fas fa-user"></i> Customer Name</label>
                                    <select id="name" name="name" class="form-control rounded">
                                        <option selected disabled>Choose...</option>
                                        @foreach($customers as $c)
                                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Dynamic Fields -->
                            <div class="col-md-6" id="email"></div>
                            <div class="col-md-6" id="company"></div>
                            <div class="col-md-6" id="address"></div>
                            <div class="col-md-6" id="phone"></div>

                            <!-- Product Code -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small font-weight-bold"><i class="fas fa-barcode"></i> Product Code</label>
                                    <select name="code" class="form-control rounded">
                                        <option selected disabled>Choose...</option>
                                        @foreach($products as $row)
                                            @if($row->stock > 1)
                                                <option>{{ $row->product_code }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Product Name -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small font-weight-bold"><i class="fas fa-box"></i> Product Name</label>
                                    <select name="name" class="form-control rounded">
                                        <option selected disabled>Choose...</option>
                                        @foreach($products as $row)
                                            @if($row->stock > 1)
                                                <option value="{{ $row->name }}">{{ $row->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <!-- Quantity -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="small font-weight-bold"><i class="fas fa-sort-numeric-up"></i> Quantity</label>
                                    <input class="form-control rounded" name="quantity" type="text" />
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-group text-center mt-4">
                            <button class="btn btn-primary btn-lg px-4 rounded-pill shadow-sm">
                                <i class="fas fa-save"></i> Submit Order
                            </button>
                        </div>
                    </form>
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
        var c_name = $("#name").val();
        $.ajax({
            type: 'POST',
            url: "{{ url('/api/get-customer') }}",
            dataType: 'json',
            data: { "id": c_name },
            success: function(data) {
                $("#email").html('<label class="small font-weight-bold"><i class="fas fa-envelope"></i> Email</label>' +
                    '<input class="form-control rounded" name="email" value="'+data.customer.email+'" type="text"/>');

                $("#company").html('<label class="small font-weight-bold"><i class="fas fa-building"></i> Company</label>' +
                    '<input class="form-control rounded" name="company" value="'+data.customer.company+'" type="text"/>');

                $("#phone").html('<label class="small font-weight-bold"><i class="fas fa-phone"></i> Phone</label>' +
                    '<input class="form-control rounded" name="phone" value="'+data.customer.phone+'" type="text"/>');

                $("#address").html('<label class="small font-weight-bold"><i class="fas fa-map-marker-alt"></i> Address</label>' +
                    '<input class="form-control rounded" name="address" value="'+data.customer.address+'" type="text"/>');
            }
        });
    });
});
</script>

@endsection
