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
			

			<div class="box box-success">
				@if ($message = Session::get('success'))
				<div class="alert alert-success alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>{{ $message }}</strong>
				</div>
				@endif
				<div class="box-header" style=" "> 
					<form method="get" action="{{url()->current()}}">
						<div class="form-group col-md-2">
							<label>Status</label>
							<select class="form-control" name="status" style="width: 100%;" tabindex="-1" aria-hidden="true">
								<option value="">--All--</option>
								@foreach($statuses as $status)
								<option {{{ Request::get('status') == $status->id?'selected':'' }}} value="{{$status->id}}">{{$status->status_en}} </option>

								@endforeach
							</select>
						</div> 
						@if(User::isSupervisor())
						<div class="form-group col-md-2">
							<label>Assigned to</label>
							<select class="form-control" name="assign_to_id" style="width: 100%;" tabindex="-1" aria-hidden="true">
								<option value="">--All--</option>
								@foreach($salesExecutives as $salesExecutive)
								<option {{{ Request::get('assign_to_id') == $salesExecutive->id?'selected':'' }}} value="{{$salesExecutive->id}}">{{$salesExecutive->first_name}} {{$salesExecutive->last_name}} </option>

								@endforeach
							</select>
						</div> 
						@endif
						<div class="col-md-1 pull-right" style="margin-top: 20px;" >
							<button class="btn btn-primary btn-md" type="submit">Filter</button>
						</div>
					</form>	
				</div>
				<div class="box-body table-responsive no-padding">
					<table id="example2" class="table table-hover">
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

								<td>{{$quote->quote_no}}</td>
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

					<div class="col-xs-12">
						<div class="col-xs-6 pull-right text-right"> 
							{{ $quotes->links() }}
						</div>
						<div class="col-xs-6 pull-left" style="margin-top: 25px; ">Showing {{ $quotes->firstItem() }} - {{ $quotes->lastItem() }} of {{ $quotes->total() }} [Page {{ $quotes->currentPage() }} of {{$quotes->lastPage()}}]
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
		/*	$('#example2').DataTable({
				"paging": true,
				"lengthChange": false,
				"searching": false,
				"ordering": true,
				"info": true,
				"autoWidth": false
			});*/

			$("#delbutton").on("click", function(){
				return confirm("Are you sure, you want to delete it?");
			});

		});
	</script>
	@endsection