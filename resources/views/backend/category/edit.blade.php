
@extends('backend.layouts.adminmain')
@section('title', 'Add Category')

@section('content')

<!-- Main content -->
<section class="content">
	<section class="content-header">
		<h1>
			Edit Category
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
				<form role="form"  method="Post" enctype="multipart/form-data" action="{{ route('categories.update',$category->id) }}">
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
											<label for="name_en">Name</label>
											<input type="text" class="form-control" name="name_en" id="name_en" placeholder="Name (En)" value="{{$category->name_en}}">
										</div>

										<div class="form-group">
										<label for="slug">Slug</label>
											<input type="text" class="form-control"  name="slug" id="slug" placeholder="Seo Url" required value="{{$category->slug}}">
										</div>

										<div class="form-group">
										<label for="parent_id">Parent</label>
											 <select name="parent_id" class="form-control">
									            <option value="0">-- None --</option>
									            @foreach($Categories as $Cat)
									              <option {{$category->parent_id==$Cat->id?'Selected':''}} value="{{$Cat->id}}">{{$Cat->name_en}}</option>
									            @endforeach
									         </select>
										</div>
										
										<div class="form-group">
											<label for="desc_en">Description</label>
											<small class="text-red">(Do not use enter key for new line. Use Shift+Enter for newline!)</small>
											<textarea class="textarea" name="desc_en" id="desc_en" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{!!$category->desc_en!!}</textarea>
										</div>

										<div class="form-group">
											<label for="image">Add Image</label>
											<input type="file" id="image" name="image">
										</div>

										@if($category->image)
												<div style="width: 180px">
													<div>
														<img class="display-block" src="{{asset($category->image)}}" width="180" height="120">
													</div>
													<div>
														<button type="submit" name="submit" value="removeImage" class="btn btn-danger">
															Remove
														</button>
													</div>
												</div>
										@endif

										<div class="form-group">
											<label for="logo">Add Logo</label>
											<input type="file" id="logo" name="logo">
										</div>

										@if($category->logo)
												<div style="width: 180px">
													<div>
														<img class="display-block" src="{{asset($category->logo)}}" width="180" height="120">
													</div>
													<div>
														<button type="submit" name="submit" value="removeLogo" class="btn btn-danger">
															Remove
														</button>
													</div>
												</div>
										@endif
									</div>
									<!-- /.box-body -->

									<div class="box-footer">
										<button type="submit" value="submit" name="submit" class="btn btn-primary">Submit</button>
									</div>

								</div>
								<!-- /.tab-pane -->
								<div class="tab-pane" id="tab_2">
									<!-- form start -->
									<div class="box-body">

										<div class="form-group">
											<label for="name_ar">Name</label>
											<input type="text" class="form-control" name="name_ar" id="name_ar" placeholder="Name (Ar)" required value="{{$category->name_ar}}">
										</div>


										<div class="form-group">
											<label for="desc_ar">Description</label>
											<small class="text-red">(Do not use enter key for new line. Use Shift+Enter for newline!)</small>
											<textarea class="textarea" name="desc_ar" id="desc_ar" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$category->desc_ar}}</textarea>
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