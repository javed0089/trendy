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
			<div class="box">
				@if ($message = Session::get('success'))
					<div class="alert alert-success alert-block">
						<button type="button" class="close" data-dismiss="alert">×</button>
				        <strong>{{ $message }}</strong>
					</div>
				@endif
				<div class="box box-success">
					<div class="box-header" style="padding: 5px 15px; height: 32px; "> 
						<h3 class="box-title" style="line-height: 25px;" >All Messages</h3> 
					</div>
						<div class="box-body">
							<table id="example2" class="table table-bordered table-hover">
								<thead>
									<tr>
										
										<th>Full Name</th>
										<th>Email</th>
										<th>Phone</th>
										<th>Message</th>
										<th>IP Address</th>
										<th>Dated</th>
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