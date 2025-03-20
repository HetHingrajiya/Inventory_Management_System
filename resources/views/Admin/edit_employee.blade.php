@extends('layouts.admin_master')

@section('content')

<main>
    <div class="container-fluid mt-5">
        <h1 class="mt-4">Edit Employee</h1>

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

        <!-- Form to edit employee -->
        <form action="{{ route('employees.update', $employee->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Name input -->
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $employee->name) }}" required>
            </div>

            <!-- Position input -->
            <div class="form-group">
                <label for="position">Position</label>
                <input type="text" name="position" id="position" class="form-control" value="{{ old('position', $employee->position) }}" required>
            </div>

            <!-- Office input -->
            <div class="form-group">
                <label for="office">Office</label>
                <input type="text" name="office" id="office" class="form-control" value="{{ old('office', $employee->office) }}" required>
            </div>

            <!-- Age input -->
            <div class="form-group">
                <label for="age">Age</label>
                <input type="number" name="age" id="age" class="form-control" value="{{ old('age', $employee->age) }}" required>
            </div>

            <!-- Start Date input -->
            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" name="start_date" id="start_date" class="form-control" value="{{ old('start_date', $employee->start_date) }}" required>
            </div>

            <!-- Salary input -->
            <div class="form-group">
                <label for="salary">Salary</label>
                <input type="number" name="salary" id="salary" class="form-control" value="{{ old('salary', $employee->salary) }}" required>
            </div>

            <!-- Submit button -->
            <button type="submit" class="btn btn-success">Update Employee</button>
        </form>
    </div>
</main>

@endsection
