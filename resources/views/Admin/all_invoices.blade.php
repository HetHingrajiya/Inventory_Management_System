@extends('layouts.admin_master')

@section('content')


<main>
    <div class="container mt-5">
<div class="card mb-4 shadow-lg rounded">
    <div class="card-header bg-primary text-white text-center">
        <h4><i class="fas fa-file-invoice-dollar me-2"></i>Invoices List</h4>

    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover" id="dataTable" width="100%">
                <thead class="bg-light">
                    <tr>
                        <th><i class="fas fa-file-invoice"></i> Invoice No.</th>
                        <th><i class="fas fa-user"></i> Customer</th>
                        <th><i class="fas fa-envelope"></i> Email</th>
                        <th><i class="fas fa-building"></i> Company</th>
                        <th><i class="fas fa-map-marker-alt"></i> Address</th>
                        <th><i class="fas fa-box"></i> Product</th>
                        <th><i class="fas fa-sort-numeric-up"></i> Qty</th>
                        <th><i class="fas fa-dollar-sign"></i> Total</th>
                        <th><i class="fas fa-coins"></i> Due</th>
                        <th><i class="fas fa-calendar-alt"></i> Date</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($invoices as $row)
                    <tr>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->customer_name }}</td>
                        <td>{{ $row->customer_mail }}</td>
                        <td>{{ $row->company }}</td>
                        <td>{{ $row->address }}</td>
                        <td>{{ $row->product_name }}</td>
                        <td>{{ $row->quantity }}</td>
                        <td>${{ number_format($row->total, 2) }}</td>
                        <td>${{ number_format($row->due, 2) }}</td>
                        <td>{{ $row->created_at->format('d M Y') }}</td>

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
$(document).ready(function(){
   $('#dataTable').DataTable({
       columnDefs: [{ orderable: false, targets: [10] }],
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
