@extends('backend.layouts.adminmain')
@section('title','Quotes')

@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap.css')}}">

@endsection

@section('content')

<section class="content-header">
	<h1>
		Quote Requests
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
						<h3 class="box-title" style="line-height: 25px;" >All Quotes</h3> 
					</div>
					<div class="box-body">
						<table id="example2" class="table table-bordered table-hover">
							<thead>
								<tr>
									
									<th>Quote #</th>
									<th>User</th>
									<th>Created</th>
									<th>Assigned To</th>
									<th>Status</th>
									<th width="80"></th>
								</tr>
							</thead>
							<tbody>

								@foreach($quotes as $quote)
								<tr>
									
									<td>{{$quote->id}}</td>
									<td>{{$quote->User->first_name}} {{$quote->User->last_name}}
										{!! User::isActivated($quote->user_id)?'<span class="label label-success pull-right">Activated</span>':'<span class="label label-danger pull-right">Not-Activated</span>' !!}
									</td>
									<td>{{ date('M j, Y H:i',strtotime($quote->created_at))}}</td>
									<td>{{isset($quote->AssignedTo)?$quote->AssignedTo->first_name:''}} {{isset($quote->AssignedTo)?$quote->AssignedTo->last_name:''}}</td>
									<td>{{$quote->Status->status_en}}</td>
									<td>
										<a href="{{ route('quote-requests.show',$quote->id) }}" class="btn btn-block btn-default">View</a>
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