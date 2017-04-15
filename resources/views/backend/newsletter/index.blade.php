@extends('backend.layouts.adminmain')
@section('title','Newsletter Subscribers')

@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap.css')}}">

@endsection

@section('content')

<section class="content-header">
	<h1>
		Newsletter Subscribers
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
						<h3 class="box-title" style="line-height: 25px;" >All Subscribers</h3> 
					</div>
					<div class="box-body">
						<table id="example2" class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>Email</th>
									<th>IP Address</th>
									<th>Created</th>

								</tr>
							</thead>
							<tbody>

								@foreach($subscribers as $subscriber)
								<tr>

									<td>{{$subscriber->email}}

									</td>

									<td>{{$subscriber->ip_address}}	</td>

									<td>{{ date('M j, Y H:i',strtotime($subscriber->created_at))}}</td>

								</tr>
								@endforeach

							</tbody>
							<tfoot>

							</tfoot>
						</table>

						<div class="row">
							<div class="col-md-2 pull-right"> 
								{{ $subscribers->links() }}
							</div>
							<div class="col-md-2 pull-left" style="margin-top: 25px; ">Showing {{ $subscribers->firstItem() }} - {{ $subscribers->lastItem() }} of {{ $subscribers->total() }} [Page {{ $subscribers->currentPage() }} of {{$subscribers->lastPage()}}]
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
			$('#example2aa').DataTable({
				"paging": true,
				"lengthChange": false,
				"searching": false,
				"ordering": true,
				"info": true,
				"autoWidth": false,
				"order": [[ 1, "desc" ]]
			});
		});
	</script>
	@endsection