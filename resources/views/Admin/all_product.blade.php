@extends('layouts.admin_master')

@section('content')

<div class="container mt-4">
    <div class="card shadow-lg border-0 rounded-lg">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="m-0"><i class="fas fa-box-open"></i> Products in Stock</h3>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered text-center" id="dataTable" width="100%">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th><i class="fas fa-barcode"></i> Code</th>
                            <th><i class="fas fa-box"></i> Name</th>
                            <th><i class="fas fa-tags"></i> Category</th>
                            <th><i class="fas fa-cubes"></i> Stock</th>
                            <th><i class="fas fa-rupee-sign"></i> Unit Price</th>
                            <th><i class="fas fa-rupee-sign"></i> Sale Price</th>
                            <th><i class="fas fa-cogs"></i> Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $row)
                        <tr>
                            <td class="fw-bold">{{ $row->product_code }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->category }}</td>

                            <td class="{{ $row->stock > 0 ? 'text-success fw-bold' : 'text-danger fw-bold' }}">
                                {{ $row->stock > 0 ? $row->stock : 'Stock Out' }}
                            </td>

                            <td>₹{{ number_format($row->unit_price, 2) }}</td>
                            <td>₹{{ number_format($row->sales_unit_price, 2) }}</td>

                            <td class="d-flex justify-content-center">
                                <form action="{{ route('delete.product', $row->id) }}" method="POST" class="me-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>

                                <div class="card-footer text-center">
                                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left"></i> Back to Dashboard
                                    </a>
                                </div>

                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

@endsection

@section('script')

<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" />

<!-- DataTables Script -->
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            columnDefs: [{ orderable: false, targets: [6] }],
            dom: 'lBfrtip',
            buttons: [
                { extend: 'copyHtml5', exportOptions: { columns: [0, ':visible'] } },
                { extend: 'excelHtml5', exportOptions: { columns: [0, ':visible'] } },
                { extend: 'pdfHtml5', exportOptions: { columns: [0, 1, 2, 5] } },
                'colvis'
            ]
        });
    });
</script>

@endsection
