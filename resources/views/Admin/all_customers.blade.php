@extends('layouts.admin_master')

@section('content')
<main>
<div class="container mt-5">

<div class="card mb-4 shadow-lg rounded">
    <div class="card-header bg-primary text-white text-center">
        <h4><i class="fas fa-users me-2"></i> Customers List</h4>

    </div>

    <div class="card-body">
        <div class="table-responsive">

        <table class="table table-striped table-hover" id="dataTable" width="100%">
                <thead class="bg-light">
                    <tr>
                        <th><i class="fas fa-user"></i> Name</th>
                        <th><i class="fas fa-envelope"></i> Email</th>
                        <th><i class="fas fa-building"></i> Company</th>
                        <th><i class="fas fa-map-marker-alt"></i> Address</th>
                        <th><i class="fas fa-phone"></i> Phone</th>
                        <th><i class="fas fa-cogs"></i> Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $row)
                    <tr>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->email }}</td>
                        <td>{{ $row->company }}</td>
                        <td>{{ $row->address }}</td>
                        <td>{{ $row->phone }}</td>
                        <td>
                            <a href="{{ route('customers.edit', $row->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="{{ route('customers.destroy', $row->id) }}" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger delete-btn" title="Delete">
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
        columnDefs: [{ orderable: false, targets: [5] }],
        dom: 'Bfrtip',
        buttons: [
            { extend: 'copyHtml5', text: '<i class="fas fa-copy"></i> Copy', className: 'btn btn-sm btn-secondary' },
            { extend: 'excelHtml5', text: '<i class="fas fa-file-excel"></i> Excel', className: 'btn btn-sm btn-success' },
            { extend: 'pdfHtml5', text: '<i class="fas fa-file-pdf"></i> PDF', className: 'btn btn-sm btn-danger' },
            { extend: 'colvis', text: '<i class="fas fa-columns"></i> Column Visibility', className: 'btn btn-sm btn-info' }
        ]
    });

    // Delete confirmation
    $('.delete-btn').on('click', function(e) {
        e.preventDefault();
        if (confirm("Are you sure you want to delete this customer?")) {
            window.location.href = $(this).attr('href');
        }
    });
});
</script>

@endsection
