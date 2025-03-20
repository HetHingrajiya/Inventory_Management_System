@extends('layouts.admin_master')

@section('content')
<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header bg-primary text-white text-center">
                        <h3><i class="fas fa-user-plus me-2"></i> Add New Employee</h3>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('employees.store') }}" enctype="multipart/form-data">
                        @csrf
                            <div class="row">
                                <!-- Name -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="fw-bold"><i class="fas fa-user"></i> Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Employee Name" required>
                                    </div>
                                </div>

                                <!-- Position -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="fw-bold"><i class="fas fa-briefcase"></i> Position</label>
                                        <input type="text" class="form-control" name="position" placeholder="Job Position" required>
                                    </div>
                                </div>

                                <!-- Office -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="fw-bold"><i class="fas fa-building"></i> Office</label>
                                        <input type="text" class="form-control" name="office" placeholder="Office Location" required>
                                    </div>
                                </div>

                                <!-- Age -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="fw-bold"><i class="fas fa-birthday-cake"></i> Age</label>
                                        <input type="number" class="form-control" name="age" placeholder="Age" required>
                                    </div>
                                </div>

                                <!-- Start Date -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="fw-bold"><i class="fas fa-calendar-alt"></i> Start Date</label>
                                        <input type="date" class="form-control" name="start_date" required>
                                    </div>
                                </div>

                                <!-- Salary -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="fw-bold"><i class="fas fa-dollar-sign"></i> Salary</label>
                                        <input type="number" class="form-control" name="salary" placeholder="Salary Amount" required>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="form-group mt-4 mb-0">
                                <button type="submit" class="btn btn-success btn-block">
                                    <i class="fas fa-save"></i> Save Employee
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
