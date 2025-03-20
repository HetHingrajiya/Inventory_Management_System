@extends('layouts.admin_master')

@section('content')

<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header bg-primary text-white text-center">
                        <h3 class="font-weight-light"><i class="fas fa-user-edit"></i> Edit Customer</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('customers.update', $customer->id) }}" enctype="multipart/form-data">
                            @csrf
                            <!-- @method('PUT') -->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name"><i class="fas fa-user"></i> Customer Name</label>
                                        <input class="form-control" name="name" value="{{ $customer->name }}" type="text" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email"><i class="fas fa-envelope"></i> Customer Email</label>
                                        <input class="form-control" name="email" value="{{ $customer->email }}" type="email" required />
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="company"><i class="fas fa-building"></i> Company</label>
                                        <input class="form-control" name="company" value="{{ $customer->company }}" type="text" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="address"><i class="fas fa-map-marker-alt"></i> Address</label>
                                        <input class="form-control" name="address" value="{{ $customer->address }}" type="text" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone"><i class="fas fa-phone"></i> Phone</label>
                                        <input class="form-control" name="phone" value="{{ $customer->phone }}" type="text" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-4">
                                <button type="submit" class="btn btn-success btn-block">
                                    <i class="fas fa-save"></i> Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('all.customers') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Customers
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
