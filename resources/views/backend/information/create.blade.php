@extends('backend.layouts.adminmain')
@section('title', 'Add Information')

@section('content')

<!-- Main content -->
<section class="content">
	<section class="content-header">
		<h1>
			Add Information
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
				<form role="form"  method="Post" enctype="multipart/form-data" action="{{ route('informations.store') }}">
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
											<label for="name_en">Name</label>
											<input type="text" class="form-control" name="name_en" id="name_en" placeholder="Name (En)" required value="{{old('name_en')}}" >
										</div>
										<div class="form-group">
										<label for="information_type_id">Page Type</label>
											 <select name="information_type_id" class="form-control" required>
									            <option value="" >-- None --</option>
									            @foreach($informationTypes as $informationType)
									              <option value="{{$informationType->id}}">{{$informationType->information_type_en}}</option>
									            @endforeach
									         </select>
										</div>
									

										<div class="form-group">
											<label for="desc_en">Description</label>
											<small class="text-red">(Do not use enter key for new line. Use Shift+Enter for newline!)</small>
											<textarea class="textarea" name="desc_en" id="desc_en" style="width: 100%; height: 500px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"> {{old('desc_en')}}</textarea>
										</div>

										<div class="checkbox">
						                  <label>
						                    <input name="status" type="checkbox"> Status
						                  </label>
						                </div>

						                <div class="form-group">
										<label for="meta_title_en">Meta page title</label>
											<input type="text" class="form-control"  name="meta_title_en"  value="{{old('meta_title_en')}}" >
										</div>

										<div class="form-group">
											<label for="meta_description_en">Meta description</label>
											<textarea class="mceNoEditor"  maxlength="255" name="meta_description_en"  style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"> {{old('meta_description_en')}}</textarea>
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
											<label for="name_ar">Name</label>
											<input type="text" class="form-control" name="name_ar" id="name_ar" placeholder="Name (Ar)" required value="{{old('name_ar')}}" >
										</div>
										<div class="form-group">
											<label for="desc_ar">Description</label>
											<small class="text-red">(Do not use enter key for new line. Use Shift+Enter for newline!)</small>
											<textarea class="textarea" name="desc_ar" id="desc_ar" style="width: 100%; height: 500px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"> {{old('desc_ar')}}</textarea>
										</div>

										<div class="form-group">
										<label for="meta_title_ar">Meta page title</label>
											<input type="text" class="form-control"  name="meta_title_ar"  value="{{old('meta_title_ar')}}" >
										</div>

										<div class="form-group">
											<label for="meta_description_ar">Meta description</label>
											<textarea class="mceNoEditor" maxlength="255" name="meta_description_ar"  style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"> {{old('meta_description_ar')}}</textarea>
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