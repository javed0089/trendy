@extends('backend.layouts.adminmain')
@section('title','Orders')

@section('styles')
 <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap.css')}}">

@endsection

@section('content')

<section class="content-header">
	<h1>
	Orders
	</h1>
	
	
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				@if ($message = Session::get('success'))
					<div class="alert alert-success alert-block">
						<button type="button" class="close" data-dismiss="alert">×</button>
				        <strong>{{ $message }}</strong>
					</div>
				@endif
				<div class="box box-success">
					<div class="box-header" style="padding: 5px 15px; height: 32px; "> 
						<h3 class="box-title" style="line-height: 25px;" >All Orders</h3> 
					</div>
						<div class="box-body">
							<table id="example2" class="table table-bordered table-hover">
								<thead>
									<tr>
										
										<th>Order #</th>
										<th>User</th>
										<th>P.I. Status</th>
										<th>Payment</th>
										<th>Created</th>
										<th>Assigned To</th>
										<th>Status</th>
										<th width="80"></th>
									</tr>
								</thead>
								<tbody>

									@foreach($orders as $order)
									<tr>
										
										<td>{{$order->id}}</td>
										<td>{{$order->User->first_name}} {{$order->User->last_name}}</td>
										<td>
											{!! $order->pi_confirmed?'<span class="label label-success">Confirmed</span>':'<span class="label label-danger">Not Confirmed</span>'!!}
										</td>
										<td>
											{!! $order->payment_status?'<span class="label label-success">Paid</span>':'<span class="label label-danger">Not Paid</span>'!!}
										</td>
										<td>{{ date('M j, Y H:i',strtotime($order->created_at))}}</td>
										<td>{{isset($order->AssignedTo)?$order->AssignedTo->first_name:''}} {{isset($order->AssignedTo)?$order->AssignedTo->last_name:''}}</td>
										<td>{{$order->Status->status_en}}</td>
										<td>
											<a href="{{ route('orders.show',$order->id) }}" class="btn btn-block btn-default">View</a>
										</td>
									</tr>
									@endforeach

								</tbody>
								<tfoot>

								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
		</section>
@endsection

@section('scripts')
 

!-- DataTables -->
<script src="{{asset('backend/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>

 <!-- page script -->
<script>
  $(function () {
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
       "order": [[ 1, "desc" ]]
    });

    $("#delbutton").on("click", function(){
	    return confirm("Are you sure, you want to delete it?");
	});

  });
</script>
@endsection