 
@extends('backend.layouts.adminmain')
@section('title','Categories')

@section('styles')
 <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap.css')}}">

@endsection

@section('content')

<section class="content-header">
	<h1>
		Categories
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
						<h3 class="box-title" style="line-height: 25px;" >All Categories</h3> 
						<div style="width: 150px; " class="pull-right">
							<a href="{{ route('categories.create') }}" class="btn btn-primary btn-block">Add Category</a>
						</div>
					</div>
						<div class="box-body">
							<table id="example2" class="table table-bordered table-hover">
								<thead>
									<tr>
										
										<th>Category</th>
										<th>Sort Order</th>
										<th>Created</th>
										<th>Last Updated</th>
										<th width="120"></th>
									</tr>
								</thead>
								<tbody>
								@if(isset($categories))
									@foreach($categories as $category)
									<tr>
										
										<td>
											{!!$category->name_en!!}
											@if($category->image)
												@if(File::exists(public_path($category->image)))
													<i class="fa fa-picture-o pull-right" aria-hidden="true"></i>
												@endif
											@endif
										</td>
										<td>{{$category->sort_order}}</td>
										<td>{{ date('M j, Y H:i',strtotime($category->created_at))}}</td>
										<td>{{date('M j, Y H:i',strtotime($category->updated_at))}}</td>
										<td>
											<a href="{{ route('categories.edit',$category->id) }}" class="btn btn-block btn-default">Edit</a>
										</td>
									</tr>
									@endforeach
								@endif
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
  });
</script>
@endsection