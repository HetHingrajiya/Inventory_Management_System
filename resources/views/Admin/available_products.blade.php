@extends('layouts.admin_master')

@section('content')

<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-lg  text-center">

        <div class="card-header bg-primary text-white text-center">
            <h4 class="m-0"><i class="fas fa-box-open mr-2"></i>Available Products </h4>
        </div>
        <div class="card-body ">
            <div class="table-responsive ">
                <table class="table table-hover table-bordered " id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-light">
                        <tr>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Stock</th>
                            <th>Unit Price</th>
                            <th>Sale Price</th>
                            <th>Action</th>
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

                            <td>{{ number_format($row->unit_price, 2) }}</td>
                            <td>{{ number_format($row->sales_unit_price, 2) }}</td>

                            <td>
                                <a href="{{ url('purchase-products/'.$row->id) }}" class="btn btn-sm btn-success">
                                    🛒 Order
                                </a>
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
