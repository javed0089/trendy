
@extends('backend.layouts.adminmain')
@section('title', 'Add Testimonial')

@section('content')

<!-- Main content -->
<section class="content">
	<section class="content-header">
		<h1>
			Add Client Testimonial
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
				<form role="form"  method="Post"  action="{{ route('testimonials.store') }}">
								{{csrf_field()}}
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
											<label for="client_name_en">Client Name</label>
											<input type="text" class="form-control" name="client_name_en" id="client_name_en" placeholder="Client Name in english" required value="{{old('client_name_en')}}" >
										</div>

										<div class="form-group">
										<label for="location_en">Location</label>
											<input type="text" class="form-control"  name="location_en" id="location_en" placeholder="Location in english" required value="{{old('location_en')}}" >
										</div>
										<div class="form-group">
											<label for="quote_en">Quote</label>
											<small class="text-red">(Do not use enter key for new line. Use Shift+Enter for newline!)</small>
											<textarea class="textarea" name="quote_en" id="quote_en" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{old('quote_en')}}</textarea>
										</div>
										<div class="checkbox">
						                  <label>
						                    <input name="featured" type="checkbox"> Featured
						                  </label>
						                </div>
						                <div class="checkbox">
						                  <label>
						                    <input name="status" type="checkbox"> Status
						                  </label>
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
											<label for="client_name_ar">Client Name</label>
											<input type="text" class="form-control" name="client_name_ar" id="client_name_ar" placeholder="Client Name in arabic" value="{{old('client_name_ar')}}" >
										</div>

										<div class="form-group">
										<label for="location_ar">Location</label>
											<input type="text" class="form-control"  name="location_ar" id="location_ar" placeholder="Location in arabic" value="{{old('location_ar')}}" >
										</div>
										<div class="form-group">
											<label for="quote_ar">Quote</label>
											<small class="text-red">(Do not use enter key for new line. Use Shift+Enter for newline!)</small>
											<textarea class="textarea" name="quote_ar" id="quote_ar" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"> {{old('quote_ar')}}</textarea>
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
		selector:'textarea',
		plugins: 'code preview lists link image',
		menubar:false,
		toolbar: 'undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code preview',

	});
	</script>