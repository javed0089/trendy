@extends('backend.layouts.adminmain')
@section('title','Jobs')

@section('styles')
 <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap.css')}}">

@endsection

@section('content')

<section class="content-header">
	<h1>
		Jobs
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
						<h3 class="box-title" style="line-height: 25px;" >All Jobs</h3> 
						<div style="width: 150px; " class="pull-right">
							<a href="{{ route('jobs.create') }}" class="btn btn-primary btn-block">Add Job</a>
						</div>
					</div>
						<div class="box-body">
							<table id="example2" class="table table-bordered table-hover">
								<thead>
									<tr>
										
										<th>Job Title</th>
										<th>Department</th>
										<th>Status</th>
										<th>Applications</th>
										<th>Created</th>
										<th width="80"></th>
										<th width="80"></th>
									</tr>
								</thead>
								<tbody>

									@foreach($jobs as $job)
									<tr>
										
										<td>
											<a href="{{route('jobs.show',$job->id)}}">{{$job->title_en}}</a>
										</td>
										<td>{{isset($job->Department->name_en)?$job->Department->name_en:'n/a'}}</td>
										<td>{!!$job->job_status?'<span class="label label-success">Active</span>':'<span class="label label-danger">In-active</span>'!!}</td>
										<td>{{count($job->JobApplications)}}</td>
										<td>{{ date('M j, Y H:i',strtotime($job->created_at))}}</td>
										<td>
											<a href="{{ route('jobs.edit',$job->id) }}" class="btn btn-block btn-default">Edit</a>
										</td>
										<td>
											<form role="form"  method="Post"  action="{{ route('jobs.destroy',$job->id) }}">
												{{csrf_field()}}
												{{ method_field('Delete') }}
												<button type="submit" id="delbutton" class="btn btn-block btn-danger">Delete</button>
											</form>
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