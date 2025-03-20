@extends('layouts.admin_master')

@section('content')

<div class="container mt-4">
    <div class="card shadow-lg border-0 rounded-lg">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="m-0"><i class="fas fa-box-open mr-2"></i> Products in Stock</h3>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
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

                            <td>
                                <a href="{{ url('purchase-products/'.$row->id) }}" class="btn btn-sm btn-success">
                                    🛒 Order
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Back to Dashboard Button -->
                <div class="text-center mt-3">
                    <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Dashboard
                    </a>
                </div>
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
