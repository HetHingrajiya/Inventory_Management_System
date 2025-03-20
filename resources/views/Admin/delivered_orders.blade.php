@extends('layouts.admin_master')

@section('content')


<main>
<div class="container">
<div class="card mb-4 shadow">
    <div class="card-header bg-primary text-white">
        <i class="fas fa-truck mr-1"></i> Delivered Products
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-center" id="dataTable" width="100%" cellspacing="0">
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
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->product_code }}</td>
                        <td>{{ $row->product_name }}</td>
                        <td>{{ $row->email }}</td>
                        <td>{{ $row->quantity }}</td>
                        <td>
                            @if($row->order_status == '0')
                                <span class="badge badge-warning"><i class="fas fa-clock"></i> Pending</span>
                            @else
                                <span class="badge badge-success"><i class="fas fa-check"></i> Delivered</span>
                            @endif
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
<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />

<script>
   $(document).ready(function() {
       $('#dataTable').DataTable({
           columnDefs: [{ bSortable: false, targets: [5] }],
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
