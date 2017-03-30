 
@extends('backend.layouts.adminmain')

@section('title')
{{$pageContent->page_title}}-{{$pageContent->section_title}}
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1 style="width: 60%;" class="pull-left">
		{{$pageContent->page_title}} - {{$pageContent->section_title}}
	</h1>
	<div style="width: 150px; padding: 5px;" class="pull-right">
		<a href="{{ route('pages.create',$pageContent->id) }}" class="btn btn-success btn-block">Add New</a>
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
								@if($pageContent->has_image)
								<th>Image</th>
								@endif

								@if($pageContent->has_title)
								<th>Title</th>
								@endif

								@if($pageContent->has_heading1)
								<th>Heading</th>
								@endif

								@if($pageContent->has_content)
								<th>Content</th>
								@endif

								<th width="80"></th>
								<th width="80"></th>
							</tr>
						</thead>
						<tbody>

							@foreach($pageContent->PageSections as $sections)
							<tr>
								@if($pageContent->has_image)
								<td>
									@if($sections->image_en)
									@if(File::exists(public_path($sections->image_en)))
									<img class="display-block" src="{{asset($sections->image_en)}}" width="150" height="80">
									@endif
									@endif
								</td>
								@endif

								@if($pageContent->has_title)
								<td>{{$sections->title_en}}</td>
								@endif

								@if($pageContent->has_heading1)
								<td>{{$sections->heading1_en}}</td>
								@endif

								@if($pageContent->has_content)
								<td>{{str_limit($sections->content_en,40)}}</td>
								@endif
								
								
								
								<td>
									<a href="{{ route('pages.edit',$sections->id) }}" class="btn btn-primary btn-block">Edit</a>
								</td>
								<td>
									<form role="form"  method="Post" action="{{ route('pages.destroy',$sections->id) }}">	
										{{csrf_field()}}
										{{ method_field('Delete') }}
										<button type="submit" id="delbutton" class="btn btn-danger  btn-block">Delete</button>
									</form>
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