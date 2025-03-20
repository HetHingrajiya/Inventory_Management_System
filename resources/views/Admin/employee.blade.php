@extends('layouts.admin_master')

@section('content')
<main>
    <div class="container mt-5">
        <div class="card shadow-lg border-0 rounded-lg mt-4">
            <div class="card-header bg-primary text-white text-center">
                <h4><i class="fas fa-users me-2"></i> Employee List</h4>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="dataTable" width="100%" cellspacing="0">
                        <thead class="bg-light">
                            <tr>
                                <th><i class="fas fa-user"></i> Name</th>
                                <th><i class="fas fa-briefcase"></i> Position</th>
                                <th><i class="fas fa-building"></i> Office</th>
                                <th><i class="fas fa-birthday-cake"></i> Age</th>
                                <th><i class="fas fa-calendar-alt"></i> Start Date</th>
                                <th><i class="fas fa-rupee-sign"></i> Salary</th>
                                <th class="text-center"><i class="fas fa-cogs"></i> Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employees as $employee)
                            <tr>
                                <td>{{ $employee->name }}</td>
                                <td>{{ $employee->position }}</td>
                                <td>{{ $employee->office }}</td>
                                <td>{{ $employee->age }}</td>
                                <td>{{ \Carbon\Carbon::parse($employee->start_date)->format('d M, Y') }}</td>
                                <td>{{ number_format($employee->salary, 2) }}</td>
                                <td class="text-center">
                                    <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('employees.delete', $employee->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection

@section('script')
<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" />

<script>
$(document).ready(function() {
    $('#dataTable').DataTable({
        columnDefs: [{ orderable: false, targets: [6] }],
        dom: 'Bfrtip',
        buttons: [
            { extend: 'copyHtml5', text: '<i class="fas fa-copy"></i> Copy', className: 'btn btn-sm btn-secondary' },
            { extend: 'excelHtml5', text: '<i class="fas fa-file-excel"></i> Excel', className: 'btn btn-sm btn-success' },
            { extend: 'pdfHtml5', text: '<i class="fas fa-file-pdf"></i> PDF', className: 'btn btn-sm btn-danger' },
            { extend: 'colvis', text: '<i class="fas fa-columns"></i> Column Visibility', className: 'btn btn-sm btn-info' }
        ]
    });
});
</script>

@endsection
