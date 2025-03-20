@extends('layouts.admin_master')

@section('content')

<main>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-lg border-0 rounded-lg mt-4">
                    <div class="card-header bg-primary text-white text-center">
                        <h3 class="font-weight-light"><i class="fas fa-list-alt"></i> Orders List</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered text-center" id="dataTable" width="100%">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th>#</th>
                                        <th><i class="fas fa-barcode"></i> Product Code</th>
                                        <th><i class="fas fa-box"></i> Product Name</th>
                                        <th><i class="fas fa-envelope"></i> Customer Email</th>
                                        <th><i class="fas fa-sort-numeric-up"></i> Quantity</th>
                                        <th><i class="fas fa-info-circle"></i> Status</th>
                                        <th><i class="fas fa-cogs"></i> Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $row)
                                    <tr>
                                        <td>{{ $row->id }}</td>
                                        <td>{{ $row->product_code }}</td>
                                        <td>{{ $row->product_name }}</td>
                                        <td>{{ $row->email }}</td>
                                        <td>{{ $row->quantity }}</td>
                                        <td>
                                            @if($row->order_status == '0')
                                                <span class="badge bg-warning text-dark"><i class="fas fa-clock"></i> Pending</span>
                                            @else
                                                <span class="badge bg-success"><i class="fas fa-check"></i> Delivered</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($row->order_status == '0')
                                                <a href="{{ url('add-invoice/'.$row->id) }}" class="btn btn-sm btn-primary" title="Create Invoice">
                                                    <i class="fas fa-file-invoice"></i> Invoice
                                                </a>
                                            @else
                                                <button class="btn btn-sm btn-secondary" disabled>
                                                    <i class="fas fa-check-double"></i> Invoiced
                                                </button>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="card-footer text-center">
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to Dashboard
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>

@endsection

@section('script')
<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" />

<!-- DataTables JS -->
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
