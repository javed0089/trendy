@extends('backend.layouts.adminmain')
@section('title','Job')

@section('content')

<section class="content-header">
<div class="box-header" style="padding: 5px 15px; height: 32px; "> 
	<h1 class="box-title" style="line-height: 25px;" >
		Job -{{$job->title_en}}
	</h1>
	<div style="width: 150px; " class="pull-right">
		<a class="btn btn-primary bt-md" href="{{ route('jobs.edit',$job->id) }}">Edit Job</a>
	</div>
</div>
</section>

<!-- Main content -->
<section class="content">
	@if ($message = Session::get('success'))
	<div class="alert alert-success alert-block">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<strong>{{ $message }}</strong>
	</div>
	@endif

	@if (count($errors) > 0)
		<div class="alert alert-danger">
			<strong>Whoops!</strong> There were some problems with your input.<br><br>
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif



	<div class="col-md-12">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-table"></i> General</a></li>
				<li><a href="#tab_2" data-toggle="tab"><i class="fa fa-table"></i> Arabic</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab_1">
					<div class="box-header with-border">
						<h3 class="box-title">{{$job->title_en}}</h3>
					</div>
					<div class="box-body">
						<div class="col-md-9">
							<h3>Description</h3>	
							<p>{!!$job->job_description_en!!}</p>

							<h3>Responsibilities</h3>	
							<p>{!!$job->responsibilities_en!!}</p>
						</div>
						<div class="col-md-3">
							<div class="callout ">
								<h4>Department</h4>
				                <p>{{$job->Department->name_en}}</p>
				                <h4>location_en</h4>
				                <p>{{$job->location_en}}</p>
			        	        <h4>Education</h4>
				                <p>{{$job->education_en}}</p>
				                <h4>Experience</h4>
				                <p>{{$job->experience_en}}</p>
				                <h4>Created</h4>
				                <p>{{date('M j, Y H:i',strtotime($job->created_at))}}</p>
				                <h4>Slug</h4>
				                <p><a style="color: blue;" href="{{url($job->slug)}}">{{url($job->slug)}}</a></p>
			              </div>
		              </div>
					</div>

				</div>
				<!-- /.tab-pane -->
				<div class="tab-pane" id="tab_2">
					<div class="box-header with-border">
						<h3 class="box-title">{{$job->title_ar}}</h3>
					</div>
					<div class="box-body">
						<div class="col-md-9">
							<h4>Description</h4>	
							<p>{!!$job->job_description_ar!!}</p>

							<h4>Responsibilities</h4>	
							<p>{!!$job->responsibilities_ar!!}</p>
						</div>
						<div class="col-md-3">
							<div class="callout ">
				                <h4>location_en</h4>
				                <p>{{$job->location_ar}}</p>
			        	        <h4>Education</h4>
				                <p>{{$job->education_ar}}</p>
				                <h4>Experience</h4>
				                <p>{{$job->experience_ar}}</p>
			              </div>
		              </div>
					</div>


				</div>

				

				<div class="box-footer">
					
				</div>
			</div>

		</div>
	</div>

</section>
@endsection
