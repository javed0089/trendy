@extends('backend.layouts.adminmain')
@section('title', 'Edit Page')

@section('content')

<!-- Main content -->
<section class="content">
	<section class="content-header">
		<h1>
			Edit Page
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
				<form role="form"  method="Post" enctype="multipart/form-data" action="{{ route('informations.update',$information->id) }}">
								{{ method_field('PATCH') }}
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
											<input type="text" class="form-control" name="name_en" id="name_en" placeholder="Name (En)" required value="{{$information->name_en}}" >
										</div>
										<div class="form-group">
										<label for="information_type_id">Page Type</label>
											 <select name="information_type_id" class="form-control" required>
									            <option value="" >-- None --</option>
									            @foreach($informationTypes as $informationType)
									              <option {{$information->information_type_id==$informationType->id?'Selected':''}} value="{{$informationType->id}}">{{$informationType->information_type_en}}</option>
									            @endforeach
									         </select>
										</div>

										
										<div class="form-group">
											<label for="desc_en">Description</label>
											<small class="text-red">(Do not use enter key for new line. Use Shift+Enter for newline!)</small>
											<textarea class="textarea" name="desc_en" id="desc_en" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$information->desc_en}}</textarea>
										</div>

										<div class="checkbox">
						                  <label>
						                    <input name="status" type="checkbox" {{$information->status?'Checked':''}}> Status
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
											<label for="name_ar">Name</label>
											<input type="text" class="form-control" name="name_ar" id="name_ar" placeholder="Name (Ar)" required value="{{$information->name_ar}}" >
										</div>
										<div class="form-group">
											<label for="desc_ar">Description</label>
											<small class="text-red">(Do not use enter key for new line. Use Shift+Enter for newline!)</small>
											<textarea class="textarea" name="desc_ar" id="desc_ar" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$information->desc_ar}}</textarea>
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