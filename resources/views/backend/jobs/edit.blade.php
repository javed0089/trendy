@extends('backend.layouts.adminmain')
@section('title', 'Edit Job')

@section('content')

<!-- Main content -->
<section class="content">
	<section class="content-header">
		<h1>
			Edit Job
		</h1>
	</section>

	<!-- Main content -->
	<section class="content">

		<div class="row">
			<div class="col-md-12">
				<!-- Custom Tabs -->
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
				@if ($message = Session::get('success'))
				<div class="alert alert-success alert-block">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<strong>{{ $message }}</strong>
				</div>
				@endif
				<form role="form"  method="Post" action="{{ route('jobs.update',$job->id) }}">
								{{csrf_field()}}
								{{ method_field('PATCH') }}
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab_1" data-toggle="tab">English</a></li>
							<li><a href="#tab_2" data-toggle="tab">Arabic</a></li>

							<li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="tab_1">
								<!-- form start -->
							
									<div class="box-body">

										<div class="form-group">
											<label for="title_en">Job Title</label>
											<input type="text" class="form-control" name="title_en" id="title_en" placeholder="Job title in english" required value="{{$job->title_en}}" >
										</div>

										<div class="form-group">
										<label for="slug">Slug</label>
											<input type="text" class="form-control"  name="slug" id="slug" placeholder="Seo Url" required value="{{$job->slug}}" >
										</div>

										<div class="form-group">
										<label for="department_id">Department</label>
											 <select name="department_id" class="form-control">
									            <option value="0">-- None --</option>
									            @foreach($departments as $department)
									              <option {{$job->department_id==$department->id?'Selected':''}} value="{{$department->id}}">{{$department->name_en}}</option>
									            @endforeach
									         </select>
										</div>

										<div class="form-group">
											<label for="location_en">Location</label>
											<input type="text" class="form-control" name="location_en" id="location_en" placeholder="Job location in english" required value="{{$job->location_en}}" >
										</div>

										<div class="form-group">
											<label for="education_en">Education</label>
											<input type="text" class="form-control" name="education_en" id="education_en" placeholder="Education required in english" required value="{{$job->education_en}}" >
										</div>

										<div class="form-group">
											<label for="experience_en">Experience</label>
											<input type="text" class="form-control" name="experience_en" id="experience_en" placeholder="Experience required in english" required value="{{$job->experience_en}}" >
										</div>
										
										<div class="form-group">
											<label for="job_description_en">Description</label>
											<small class="text-red">(Do not use enter key for new line. Use Shift+Enter for newline!)</small>
											<textarea class="textarea" name="job_description_en" id="job_description_en" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"> {{$job->job_description_en}}</textarea>
										</div>

										<div class="form-group">
											<label for="responsibilities_en">Responsibilities</label>
											<small class="text-red">(Do not use enter key for new line. Use Shift+Enter for newline!)</small>
											<textarea class="textarea" name="responsibilities_en" id="responsibilities_en" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$job->responsibilities_en}}</textarea>
										</div>

										<div class="checkbox">
						                  <label>
						                    <input name="job_status" type="checkbox" {{$job->job_status?'Checked':''}}> Job Status
						                  </label>
						                </div>

						                <div class="form-group">
										<label for="meta_title_en">Meta page title</label>
											<input type="text" class="form-control"  name="meta_title_en"  value="{{$job->meta_title_en}}" >
										</div>

										<div class="form-group">
											<label for="meta_description_en">Meta description</label>
											<textarea class="mceNoEditor" name="meta_description_en"  style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"> {{$job->meta_description_en}}</textarea>
										</div>
									</div>
									<!-- /.box-body -->

									<div class="box-footer">
										<button type="submit" class="btn btn-primary">Submit</button>
									</div>

								</div>
								<!-- /.tab-pane -->
								<div class="tab-pane" id="tab_2">
									<!-- form start -->
									<div class="box-body">

										<div class="form-group">
											<label for="title_ar">Job Title</label>
											<input type="text" class="form-control" name="title_ar" id="title_ar" placeholder="Job title in arabic" required value="{{$job->title_ar}}" >
										</div>
										<div class="form-group">
											<label for="location_ar">Location</label>
											<input type="text" class="form-control" name="location_ar" id="location_ar" placeholder="Job location in arabic" required value="{{$job->location_ar}}" >
										</div>

										<div class="form-group">
											<label for="education_ar">Education</label>
											<input type="text" class="form-control" name="education_ar" id="education_ar" placeholder="Education required in english" required value="{{$job->education_ar}}" >
										</div>

										<div class="form-group">
											<label for="experience_ar">Experience</label>
											<input type="text" class="form-control" name="experience_ar" id="experience_ar" placeholder="Experience required in arabic" required value="{{$job->experience_ar}}" >
										</div>
										
										<div class="form-group">
											<label for="job_description_ar">Description</label>
											<small class="text-red">(Do not use enter key for new line. Use Shift+Enter for newline!)</small>
											<textarea class="textarea" name="job_description_ar" id="job_description_ar" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"> {{$job->job_description_ar}}</textarea>
										</div>

										<div class="form-group">
											<label for="responsibilities_ar">Responsibilities</label>
											<small class="text-red">(Do not use enter key for new line. Use Shift+Enter for newline!)</small>
											<textarea class="textarea" name="responsibilities_ar" id="responsibilities_ar" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"> {{$job->responsibilities_ar}}</textarea>
										</div>

										<div class="form-group">
										<label for="meta_title_ar">Meta page title</label>
											<input type="text" class="form-control"  name="meta_title_ar"  value="{{$job->meta_title_ar}}" >
										</div>

										<div class="form-group">
											<label for="meta_description_ar">Meta description</label>
											<textarea class="mceNoEditor" name="meta_description_ar"  style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"> {{$job->meta_description_ar}}</textarea>
										</div>
									</div>
									<!-- /.box-body -->

									<div class="box-footer">
										<button type="submit" class="btn btn-primary">Submit</button>
									</div>
							         
							 </div>
								<!-- /.tab-pane -->

							</div>
							<!-- /.tab-content -->
						</div>
					<!-- nav-tabs-custom -->
					</div>
				</form>    
			</div>
		</section>
	</section>

	@endsection

	@section('scripts')
	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
	<script>tinymce.init({
		mode : "specific_textareas",
        editor_selector : "textarea",
		plugins: 'code preview lists link image',
		menubar:false,
		toolbar: 'undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code preview',

	});
	</script>