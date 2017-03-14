
@extends('backend.layouts.adminmain')
@section('title', 'Add Category')

@section('content')

<!-- Main content -->
<section class="content">
	<section class="content-header">
		<h1>
			Add Category
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
				<form role="form"  method="Post" enctype="multipart/form-data" action="{{ route('categories.store') }}">
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
										<label for="slug">Slug</label>
											<input type="text" class="form-control"  name="slug" id="slug" placeholder="Seo Url" required value="{{old('slug')}}" >
										</div>

										<div class="form-group">
										<label for="parent_id">Parent</label>
											 <select name="parent_id" class="form-control">
									            <option value="0">-- None --</option>
									            @foreach($Categories as $Category)
									              <option value="{{$Category->id}}">{{$Category->name_en}}</option>
									            @endforeach
									         </select>
										</div>
										
										<div class="form-group">
											<label for="desc_en">Description</label>
											<small class="text-red">(Do not use enter key for new line. Use Shift+Enter for newline!)</small>
											<textarea class="textarea" name="desc_en" id="desc_en" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"> {{old('desc_en')}}</textarea>
										</div>

										<div class="form-group">
											<label for="image">Add Image</label>
											<input type="file" id="image" name="image">
										</div>

										<div class="form-group">
											<label for="logo">Add Logo</label>
											<input type="file" id="logo" name="logo">
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
											<input type="text" class="form-control" name="name_ar" id="name_ar" placeholder="Name (Ar)" value="{{old('name_ar')}}" >
										</div>


										<div class="form-group">
											<label for="desc_ar">Description</label>
											<small class="text-red">(Do not use enter key for new line. Use Shift+Enter for newline!)</small>
											<textarea class="textarea" name="desc_ar" id="desc_ar" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"> {{old('desc_ar')}}</textarea>
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