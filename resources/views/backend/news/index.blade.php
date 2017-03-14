@extends('backend.layouts.adminmain')
@section('title','News')

@section('styles')
 <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap.css')}}">

@endsection

@section('content')

<section class="content-header">
	<h1>
		News
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
						<h3 class="box-title" style="line-height: 25px;" >All News</h3> 
						<div style="width: 150px; " class="pull-right">
							<a href="{{ route('news.create') }}" class="btn btn-primary btn-block">Add News</a>
						</div>
					</div>
						<div class="box-body">
							<table id="example2" class="table table-bordered table-hover">
								<thead>
									<tr>
										
										<th>Title</th>
										<th>Status</th>
										<th>Created</th>
										<th width="80"></th>
										<th width="80"></th>
									</tr>
								</thead>
								<tbody>

									@foreach($newsCol as $news)
									<tr>
										
										<td><a href="{{route('news.show',$news->id)}}"> {{$news->title_en}}</a></td>
										<td>{!!$news->status?'<span class="label label-success">Active</span>':'<span class="label label-danger">In-active</span>'!!}</td>
										<td>{{ date('M j, Y H:i',strtotime($news->created_at))}}</td>
										<td>
											<a href="{{ route('news.edit',$news->id) }}" class="btn btn-block btn-default">Edit</a>
										</td>
										<td>
											<form role="form"  method="Post"  action="{{ route('news.destroy',$news->id) }}">
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