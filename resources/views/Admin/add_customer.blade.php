@extends('layouts.admin_master')

@section('content')

<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header bg-primary text-white text-center">
                        <h3><i class="fas fa-user-plus"></i> Add New Customer</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ url('/insert-customer') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1"><i class="fas fa-user"></i> Customer Name</label>
                                        <input class="form-control py-3" name="name" type="text" placeholder="Enter full name" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1"><i class="fas fa-envelope"></i> Customer Email</label>
                                        <input class="form-control py-3" name="email" type="email" placeholder="Enter email address" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1"><i class="fas fa-building"></i> Company</label>
                                        <input class="form-control py-3" name="company" type="text" placeholder="Enter company name" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1"><i class="fas fa-map-marker-alt"></i> Address</label>
                                        <input class="form-control py-3" name="address" type="text" placeholder="Enter address" />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="small mb-1"><i class="fas fa-phone"></i> Phone</label>
                                        <input class="form-control py-3" name="phone" type="tel" placeholder="Enter phone number" required />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-4 mb-0">
                                <button class="btn btn-success btn-block"><i class="fas fa-save"></i> Save Customer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
