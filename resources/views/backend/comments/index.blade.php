@extends('backend.layouts.adminmain')
@section('title','Messages')

@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap.css')}}">

@endsection

@section('content')

<section class="content-header">
	<h1>
		Messages
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
				<div class="box-header"> 
					<h3 class="box-title">All Messages</h3> 
				</div>
				<div class="box-body table-responsive no-padding">
					<table id="example2" class="table table-hover">
						<thead>
							<tr>

								<th>Full Name</th>
								<th>Email</th>
								<th>Phone</th>
								<th width="200px">Message</th>
								<th>IP Address</th>
								<th>Dated</th>
								<th></th>
								<th></th>

							</tr>
						</thead>
						<tbody>

							@foreach($comments as $comment)
							<tr>

								<td>{{$comment->fullname}}</td>
								<td>{{$comment->email}}</td>
								<td>{{$comment->phone}}</td>
								<td>{{$comment->message}}</td>
								<td>{{$comment->ip_address}}</td>
								<td>{{ date('M j, Y H:i',strtotime($comment->created_at))}}</td>
								<td><a href="{{ route('comments.show',$comment->id) }}" class="btn btn-block btn-default">View</a></td>
								<td><form role="form"  method="Post"  action="{{ route('comments.destroy',$comment->id) }}">
									{{csrf_field()}}
									{{ method_field('Delete') }}
									<button type="submit" id="delbutton" class="btn btn-block btn-danger">Delete</button>
								</form></td>
							</tr>
							@endforeach

						</tbody>
						<tfoot>

						</tfoot>
					</table>
					<div class="col-md-12">
						<div class="col-md-6 pull-right text-right">
							{{ $comments->links() }}
						</div>
						<div class="col-md-6 pull-left" style="margin-top: 25px; ">Showing {{ $comments->firstItem() }} - {{ $comments->lastItem() }} of {{ $comments->total() }} [Page {{ $comments->currentPage() }} of {{$comments->lastPage()}}]
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
			"autoWidth": false,
			"order": [[ 1, "desc" ]]
		});*/
		$("#delbutton").on("click", function(){
			return confirm("Are you sure, you want to delete it?");
		});

	});
</script>
@endsection