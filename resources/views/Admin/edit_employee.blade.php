@extends('layouts.admin_master')

@section('content')

<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="card shadow-lg border-0 rounded-lg mt-5">
                    <div class="card-header bg-primary text-white text-center">
                        <h3 class="font-weight-light"><i class="fas fa-user-edit"></i> Edit Employee</h3>
                    </div>
                    <div class="card-body">

                        <!-- Display validation errors -->
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('employees.update', $employee->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <!-- Name input -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name"><i class="fas fa-user"></i> Name</label>
                                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $employee->name) }}" required>
                                    </div>
                                </div>

                                <!-- Position input -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="position"><i class="fas fa-briefcase"></i> Position</label>
                                        <input type="text" name="position" id="position" class="form-control" value="{{ old('position', $employee->position) }}" required>
                                    </div>
                                </div>

                                <!-- Office input -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="office"><i class="fas fa-building"></i> Office</label>
                                        <input type="text" name="office" id="office" class="form-control" value="{{ old('office', $employee->office) }}" required>
                                    </div>
                                </div>

                                <!-- Age input -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="age"><i class="fas fa-calendar"></i> Age</label>
                                        <input type="number" name="age" id="age" class="form-control" value="{{ old('age', $employee->age) }}" required>
                                    </div>
                                </div>

                                <!-- Start Date input -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="start_date"><i class="fas fa-calendar-alt"></i> Start Date</label>
                                        <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date', $employee->start_date) }}" required>
                                    </div>
                                </div>

                                <!-- Salary input -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="salary"><i class="fas fa-dollar-sign"></i> Salary</label>
                                        <input type="number" name="salary" id="salary" class="form-control" value="{{ old('salary', $employee->salary) }}" required>
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
                        <a href="{{ route('employees.store') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Employees
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

@endsection
