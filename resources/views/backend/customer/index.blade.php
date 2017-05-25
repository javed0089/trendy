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


			<div class="box box-success">
				@if ($message = Session::get('success'))
				<div class="alert alert-success alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>{{ $message }}</strong>
				</div>
				@endif
				<div class="box-header" style="padding: 5px 15px;"> 
					<div class="row">
						<div class="col-xs-6">
							<form method="get" action="{{url()->current()}}">
								<label>Search: <small class="text-green"><i>First name,Last name,Country,City,Email</i></small></label>
								<div class="input-group">

									<input type="text" class="form-control" name="term" value="{{Request::get('term')}}">
									<div class="input-group-btn">
										<button class="btn btn-success" type="submit"><i class="fa fa-plus"></i></button>
									</div> 
								</div>

							</form>	
						</div>
					</div>
				</div>
				<div class="box-body table-responsive no-padding">
					<a href="{{route('customers.export')}}" class="btn btn-md btn-primary">Export to Execel</a>
					<table id="example2" class="table table-hover">
						<thead>
							<tr>

								<th>Customer</th>
								<th>Email</th>
								<th>Full Address</th>
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

					<div class="col-md-12">
						<div class="col-md-6 pull-right text-right"> 
							{{ $customers->links() }}
						</div>
						<div class="col-md-6 pull-left" style="margin-top: 25px; ">Showing {{ $customers->firstItem() }} - {{ $customers->lastItem() }} of {{ $customers->total() }} [Page {{ $customers->currentPage() }} of {{$customers->lastPage()}}]
						</div>
					</div>

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