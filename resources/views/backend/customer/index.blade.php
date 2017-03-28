@extends('backend.layouts.adminmain')
@section('title','Customers')

@section('styles')
 <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap.css')}}">

@endsection

@section('content')

<section class="content-header">
	<h1>
		Customers
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
						<h3 class="box-title" style="line-height: 25px;" >All Customers</h3> 
					</div>
						<div class="box-body">
							<table id="example2" class="table table-bordered table-hover">
								<thead>
									<tr>
										
										<th>Customer</th>
										<th>Email</th>
										<th>Address</th>
										<th>IP Address</th>
										<th>Activation Status</th>
										<th>Created</th>
										
									</tr>
								</thead>
								<tbody>

									@foreach($customers as $customer)
									<tr>
										
										<td>{{$customer->first_name}} {{$customer->last_name}}
										</td>
										<td>{{$customer->email}}

										</td>
										<td>{{$customer->address}}<br>
											{{$customer->city}} {{$customer->country? ','.$customer->country : ''}}
										</td>
										<td>{{$customer->ip_address}}	</td>
										<td>
											{!!Activation::completed($customer)?'<span class="label label-success">Activated</span>':'<span class="label label-danger">Not-Activated</span>'!!}
										</td>
										<td>{{ date('M j, Y H:i',strtotime($customer->created_at))}}</td>
										<td><a href="{{ route('customers.show',$customer->id) }}" class="btn btn-block btn-default">View</a></td>
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