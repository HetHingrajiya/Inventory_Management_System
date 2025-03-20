@extends('layouts.admin_master')

@section('content')

<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header bg-primary text-white">
                        <h4 class="text-center fw-bold my-2">🛍️ Add a New Product</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('/insert-product') }}" enctype="multipart/form-data">
                        @csrf
                            <div class="row gx-3 gy-3">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1 fw-bold">🆔 Product Code</label>
                                        <input class="form-control py-2 px-3 border-1 border-secondary" name="code" type="text" placeholder="E.g., PRD123" required />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1 fw-bold">🏷️ Product Name</label>
                                        <input class="form-control py-2 px-3 border-1 border-secondary" name="name" type="text" placeholder="Enter product name" required />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1 fw-bold">📂 Category</label>
                                        <input type="text" class="form-control py-2 px-3 border-1 border-secondary" name="category" placeholder="Enter category" required />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1 fw-bold">📊 Stock</label>
                                        <input class="form-control py-2 px-3 border-1 border-secondary" name="stock" type="number" placeholder="Enter stock quantity" required />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1 fw-bold">🏷️ Buy Price (per Unit)</label>
                                        <input class="form-control py-2 px-3 border-1 border-secondary" name="unit_price" type="number" placeholder="E.g., 10.99" step="0.01" required />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1 fw-bold">💵 Sale Price (per Unit)</label>
                                        <input class="form-control py-2 px-3 border-1 border-secondary" name="sale_price" type="number" placeholder="E.g., 15.99" step="0.01" required />
                                    </div>
                                </div>

                            </div>

                            <div class="form-group mt-4 mb-0 d-flex justify-content-center">
                                <button class="btn btn-success w-50 px-4 py-2 rounded-pill fw-bold shadow">✅ Add Product</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
