 
@extends('backend.layouts.adminmain')
@section('title')
{{$pageContent->page_title}}-{{$pageContent->section_title}}
@endsection


@section('content')

<section class="content-header">
	<h1>
		{{$pageContent->page_title}} - {{$pageContent->section_title}}
	</h1>
	@if($pageContent->PageSections()->count()==0)
		<div style="width: 150px; padding: 5px;" class="pull-right">
			<a href="{{ route('pages.create',$pageContent->id) }}" class="btn btn-success btn-block">Add New</a>
		</div>
	@endif
</section>

<!-- Main content -->
<section class="content">
	@if ($message = Session::get('success'))
		<div class="alert alert-success alert-block">
			<button type="button" class="close" data-dismiss="alert">×</button>
	        <strong>{{ $message }}</strong>
		</div>
	@endif

	@if($pageContent->PageSections()->count()>0)
		<div class="col-md-6">
		<!-- Default box -->
		<div class="box">
			<div class="box-header with-border">
				<h3 class="box-title">{{$pageContent->page_title}} - {{$pageContent->section_title}} - English</h3>

				<div class="box-tools pull-right">
					<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
						<i class="fa fa-minus"></i></button>
					</div>
				</div>
				<div class="box-body">
					<h3>{{$pageContent->PageSections->first()->title_en}}</h3>
					<h4>{{$pageContent->PageSections->first()->heading1_en}}</h4>
					<p>{!!$pageContent->PageSections->first()->content_en!!}</p>
					
					@if($pageContent->PageSections->first()->image_en)
						@if(File::exists(public_path($pageContent->PageSections->first()->image_en)))
							<img class="display-block" src="{{url($pageContent->PageSections->first()->image_en)}}" width="150" height="150">
						@endif
					@endif
				</div>
				<!-- /.box-body -->
				<div class="box-footer">
					<div class="col-md-4 pull-right">
						<a class="btn btn-warning btn-block" href="{{ route('pages.edit',$pageContent->PageSections->first()->id) }}">Edit</a>
					</div>
				</div>
				<!-- /.box-footer-->
			</div>
			<!-- /.box -->
		</div>
		<div class="col-md-6">
			<!-- Default box -->
			<div class="box">
				<div class="box-header with-border">
					<h3 class="box-title">{{$pageContent->page_title}} - {{$pageContent->section_title}} - Arabic</h3>

					<div class="box-tools pull-right">
						<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
							<i class="fa fa-minus"></i></button>
						</div>
					</div>
					<div class="box-body">
						<h3>{{$pageContent->PageSections->first()->title_ar}}</h3>
						<h4>{{$pageContent->PageSections->first()->heading1_ar}}</h4>
						<p>{!!$pageContent->PageSections->first()->content_ar!!}</p>
						@if($pageContent->PageSections->first()->image_ar)
							@if(File::exists(public_path($pageContent->PageSections->first()->image_ar)))
								<img src="{{url($pageContent->PageSections->first()->image_ar)}}" width="100" height="100">
							@endif
						@endif
					</div>
					<!-- /.box-body -->
					<div class="box-footer">
						<div class="col-md-4 pull-right">
							<a class="btn btn-warning btn-block" href="{{ route('pages.edit',$pageContent->PageSections->first()->id) }}">Edit</a>
						</div>
					</div>
					<!-- /.box-footer-->
				</div>
				<!-- /.box -->
		</div> 
	@endif
</section>
@endsection