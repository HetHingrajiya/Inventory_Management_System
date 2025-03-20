@extends('layouts.admin_master')

@section('content')

<main>
<div class="container mt-4">
    <div class="card shadow-lg border-0 rounded-lg">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h3 class="m-0"><i class="fas fa-truck"></i> Delivered Products</h3>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead class="bg-dark text-white">
                        <tr>
                            <th><i class="fas fa-hashtag"></i> Order ID</th>
                            <th><i class="fas fa-barcode"></i> Product Code</th>
                            <th><i class="fas fa-box"></i> Product Name</th>
                            <th><i class="fas fa-envelope"></i> Customer Email</th>
                            <th><i class="fas fa-sort-numeric-up"></i> Quantity</th>
                            <th><i class="fas fa-info-circle"></i> Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $row)
                        <tr>
                            <td class="fw-bold">{{ $row->id }}</td>
                            <td>{{ $row->product_code }}</td>
                            <td>{{ $row->product_name }}</td>
                            <td>{{ $row->email }}</td>
                            <td class="fw-bold">{{ $row->quantity }}</td>
                            <td>
                                @if($row->order_status == '0')
                                    <span class="badge bg-warning text-dark p-2"><i class="fas fa-clock"></i> Pending</span>
                                @else
                                    <span class="badge bg-success text-white p-2"><i class="fas fa-check-circle"></i> Delivered</span>
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
</main>

@endsection

@section('script')

<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" />

<!-- DataTables Script -->
<script>
   $(document).ready(function() {
       $('#dataTable').DataTable({
           columnDefs: [{ orderable: false, targets: [5] }],
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
