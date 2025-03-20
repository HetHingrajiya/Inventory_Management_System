@extends('layouts.admin_master')

@section('content')

<main>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <!-- Card Header -->
                    <div class="card-header bg-primary text-white text-center">
                        <h3><i class="fas fa-shopping-cart"></i> Purchase Existing Product</h3>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('/insert-purchase-products') }}" enctype="multipart/form-data">
                        @csrf
                            <div class="row">
                                <!-- Product Code -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1 fw-bold">
                                            <i class="fas fa-barcode"></i> Product Code
                                        </label>
                                        <input class="form-control" name="code" type="text" value="{{ $product->product_code }}" readonly />
                                    </div>
                                </div>

                                <!-- Product Name -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1 fw-bold">
                                            <i class="fas fa-box"></i> Product Name
                                        </label>
                                        <input class="form-control" name="name" type="text" value="{{ $product->name }}" readonly />
                                    </div>
                                </div>

                                <!-- Category -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1 fw-bold">
                                            <i class="fas fa-tags"></i> Category
                                        </label>
                                        <input class="form-control" name="category" type="text" value="{{ $product->category }}" readonly />
                                    </div>
                                </div>

                                <!-- Products in Stock -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1 fw-bold">
                                            <i class="fas fa-warehouse"></i> Products in Stock
                                        </label>
                                        <input class="form-control" name="stock" type="text" value="{{ $product->stock }}" readonly />
                                    </div>
                                </div>

                                <!-- Add More Products -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1 fw-bold">
                                            <i class="fas fa-plus-circle"></i> Add More Stock
                                        </label>
                                        <input class="form-control" name="purchase" type="number" min="1" placeholder="Enter quantity" required />
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="form-group mt-4 mb-0 text-center">
                                <button class="btn btn-success btn-block">
                                    <i class="fas fa-check-circle"></i> Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
