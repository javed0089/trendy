 
@extends('backend.layouts.adminmain')
@section('title','Blog Posts')



@section('content')

<section class="content-header">
	<h1>
		Blog Posts
	</h1>
	<div style="width: 150px; padding: 5px;" class="pull-right">
		<a href="{{ url('backoffice/blog/posts/create') }}" class="btn btn-primary btn-block">Add Post</a>
	</div>
	
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
				<!-- /.box-header -->
				<div class="box-body">
					<table id="example2" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>Title</th>
								<th>Category</th>
								<th>Created</th>
								<th>Last Updated</th>
								<th width="120"></th>
							</tr>
						</thead>
						<tbody>

							@foreach($posts as $post)
							<tr>
								<td>{{str_limit($post->title_en,30)}}</td>
								<td>{{$post->BlogCategory->name_en}}</td>
								<td>{{ date('M j, Y H:i',strtotime($post->created_at))}}</td>
								<td>{{date('M j, Y H:i',strtotime($post->updated_at))}}</td>
								<td>
									<a href="{{ route('posts.edit',$post->id) }}" class="btn btn-sm btn-primary">Edit</a>

									<a href="{{ route('posts.show',$post->id) }}" class="btn btn-sm btn-default">View</a>
								</td>
							</tr>
							@endforeach

						</tbody>
						<tfoot>
						
						</tfoot>
					</table>
				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.box -->


			<!-- /.box -->
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->
</section>
<!-- /.content -->
@endsection