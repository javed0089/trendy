
@extends('backend.layouts.adminmain')
@section('title', 'Add Post')

@section('content')

@section('styles')
 <!-- Select2 -->
  <link rel="stylesheet" href="{{asset('backend/plugins/select2/select2.min.css')}}">
@endsection
<!-- Main content -->
<section class="content">
	<section class="content-header">
		<h1>
			Create a new post
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

				<div class="nav-tabs-custom">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#tab_1" data-toggle="tab">English</a></li>
						<li><a href="#tab_2" data-toggle="tab">Arabic</a></li>

						<li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="tab_1">
							<!-- form start -->
							<form role="form"  method="Post" enctype="multipart/form-data" action="{{ route('posts.store') }}">
								{{csrf_field()}}
								<div class="box-body">

									<div class="form-group">
										<label for="title_en">Title</label>
										<input type="text" class="form-control" name="title_en" id="title_en" placeholder="Title (En)"  value="{{old('title_en')}}">
									</div>

									<div class="form-group">
									<label for="slug">Slug</label>
										<input type="text" class="form-control"  name="slug" id="slug" placeholder="Url slug" required  value="{{old('slug')}}">
									</div>

									<div class="form-group">
									<label for="blog_category_id">Category</label>
										 <select name="blog_category_id" class="form-control">
								            <option value="0">Select Category</option>
								            @foreach($blogCategories as $blogCategory)
								              <option value="{{$blogCategory->id}}">{{$blogCategory->name_en}}</option>
								            @endforeach
								         </select>
									</div>
									
									<div class="form-group">
						                <label>Tags</label>
						                <select class="form-control select2" multiple="multiple" name="tags[]" data-placeholder="Choose tags" style="width: 100%;">
						                  @foreach($tags as $tag)
											 <option value="{{$tag->id}}">{{$tag->name_en}}</option>
										  @endforeach
						                </select>
						              </div>

									<div class="form-group">
										<label for="body_en">Body</label>
										<small class="text-red">(Do not use enter key for new line. Use Shift+Enter for newline!)</small>
										<textarea class="textarea" name="body_en" id="body_en" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{old('body_en')}}</textarea>
									</div>

									<div class="form-group">
									<label for="author_en">Author</label>
										<input type="text" class="form-control"  name="author_en" id="author_en" placeholder="Name of author" required value="{{old('author_en')}}">
									</div>

									<div class="form-group">
										<label for="image">Add Image</label>
										<input type="file" id="image" name="image">
									</div>
									
									<div class="checkbox">
						                <label>
						            	    <input name="featured" type="checkbox"> Featured
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
										<label for="title_ar">Title</label>
										<input type="text" class="form-control"  name="title_ar" id="title_ar" placeholder="Title (Ar)" value="{{old('title_ar')}}">
									</div>

									<div class="form-group">
										<label for="body_ar">Body</label>
										<small class="text-red">(Do not use enter key for new line. Use Shift+Enter for newline!)</small>
										<textarea class="textarea" name="body_ar" id="body_ar" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{old('body_ar')}}</textarea>
									</div>

									<div class="form-group">
									<label for="author_ar">Author</label>
										<input type="text" class="form-control"  name="author_ar" id="author_ar" placeholder="Name of author"  value="{{old('author_ar')}}">
									</div>

									<div class="form-group">
										<label for="featured_image_ar">Add featured Image</label>
										<input type="file"  id="featured_image_ar" name="featured_image_ar">
									</div>
									
									

								</div>
								<!-- /.box-body -->

								<div class="box-footer">
									<button type="submit" class="btn btn-primary">Submit</button>
								</div>
							</form>              </div>
							<!-- /.tab-pane -->

						</div>
						<!-- /.tab-content -->
					</div>
					<!-- nav-tabs-custom -->
				</div>
				<!-- /.col -->
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
 
 $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

	});
	</script>
	

	<script src="{{ asset('backend/plugins/select2/select2.full.min.js')}}"></script>

	@endsection