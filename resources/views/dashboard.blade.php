@extends('layouts.admin_master')

@section('content')

<main>
    <div class="container-fluid">


        <nav aria-label="breadcrumb" class="d-flex justify-content-center">
            <ol class="breadcrumb bg-light p-3 rounded shadow-sm d-flex flex-column align-items-center w-100">
                <h1 class="mt-4 text-primary fw-bold text-center">Dashboard</h1>
            </ol>
        </nav>


        <div class="row g-4">
            @php
                $cards = [
                    ['color' => 'primary', 'icon' => 'fa-box-open', 'text' => 'Stock', 'route' => 'all.product'],
                    ['color' => 'warning', 'icon' => 'fa-shopping-cart', 'text' => 'Sold Products', 'route' => 'sold.products'],
                    ['color' => 'success', 'icon' => 'fa-check-circle', 'text' => 'Available Products', 'route' => 'available.products'],
                    ['color' => 'danger', 'icon' => 'fa-exclamation-triangle', 'text' => 'Pending Orders', 'route' => 'pending.orders'],
                ];
            @endphp
            @foreach ($cards as $card)
            <div class="col-md-6 col-lg-3">
                <div class="card text-white bg-{{ $card['color'] }} shadow-sm">
                    <div class="card-body d-flex align-items-center">
                        <i class="fas {{ $card['icon'] }} fa-2x me-3"></i>
                        <span class="fs-5">{{ $card['text'] }}</span>
                    </div>
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <a class="small text-white stretched-link fw-bold" href="{{ route($card['route']) }}">View Details</a>
                        <i class="fas fa-angle-right"></i>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="row mt-4">
            <div class="col-xl-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white fw-bold">
                        <i class="fas fa-chart-area me-2"></i> Sales Overview
                    </div>
                    <div class="card-body">
                        <canvas id="myAreaChart" width="100%" height="40"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-warning text-white fw-bold">
                        <i class="fas fa-chart-bar me-2"></i> Revenue Growth
                    </div>
                    <div class="card-body">
                        <canvas id="myBarChart" width="100%" height="40"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-4 shadow-sm">
            <div class="card-header bg-secondary text-white fw-bold">
                <i class="fas fa-table me-2"></i> Employee Data
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover table-bordered text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Office</th>
                                <th>Age</th>
                                <th>Start Date</th>
                                <th>Salary</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $employee)
                            <tr>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->position }}</td>
                                <td>{{ $employee->office }}</td>
                                <td>{{ $employee->age }}</td>
                                <td>{{ $employee->start_date }}</td>
                                <td>{{ number_format($employee->salary) }}</td>
                                <td>
                                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('employees.delete', $employee->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                <!-- Pagination Links -->
                <div class="d-flex justify-content-center mt-3">
                    {{ $employees->links() }}
                </div>

                </div>
            </div>
        </div>

    </div>
</main>

@endsection
