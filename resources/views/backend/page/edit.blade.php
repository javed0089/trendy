 
@extends('backend.layouts.adminmain')
@section('title', 'Homepage-Company Section')

@section('content')

<!-- Main content -->
<section class="content">
	<section class="content-header">
		<h1>
			{{$pageContent->page->page_title}} - {{$pageContent->page->section_title}} - EDIT
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
				@if ($message = Session::get('error'))
				<div class="alert alert-danger alert-block">
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
							<form role="form"  method="Post" enctype="multipart/form-data"  action="{{ route('pages.update',$pageContent->id) }}">
								{{csrf_field()}}
								{{ method_field('PATCH') }}
								<div class="box-body">

									@if($pageContent->page->has_title)
									<div class="form-group">
										<label for="title_en">Title</label>
										<input type="text" class="form-control" name="title_en" id="title_en" placeholder="Title (En)" value="{{$pageContent->title_en}}">
									</div>
									@endif
									@if($pageContent->page->id == '14')
										<div class="form-group">
											<label for="link_en">Link</label>
											<input type="text" class="form-control" name="link_en" id="link_en" placeholder="HyperLink (En)" value="{{$pageContent->link_en}}" >
										</div>
									@endif

									@if($pageContent->page->has_heading1)
									<div class="form-group">
										<label for="heading1_en">Heading</label>
										<input type="text" class="form-control"  name="heading1_en" id="heading1_en" placeholder="Heading (En)" value="{{$pageContent->link_en}}">
									</div>
									@endif

									
									@if($pageContent->page->has_content)
									<div class="form-group">
										<label for="content_en">Content</label>
										<small class="text-red">(Do not use enter key for new line. Use Shift+Enter for newline!)</small>
										<textarea class="textarea" name="content_en" id="content_en" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$pageContent->content_en}}</textarea>
									</div>
									@endif

									@if($pageContent->page->has_image)	
									<div class="form-group">
										<label for="content_en">Image</label>
										<input type="file" name="image_en">
									</div>


									@if($pageContent->image_en)
										@if(File::exists(public_path($pageContent->image_en)))
											<div style="width: 180px">
												<div><img class="display-block" src="{{asset($pageContent->image_en)}}" width="180" height="120"></div>
												@endif
												<div>
													<button type="submit" name="submit" value="removeImageEn" class="btn btn-danger">
														Remove Image
													</button>
												</div>
											</div>
										@endif
									@endif

								</div>
								<!-- /.box-body -->

								<div class="box-footer">
									<button type="submit" name="submit" value="Update" class="btn btn-primary">Submit</button>
								</div>

							</div>
							<!-- /.tab-pane -->
							<div class="tab-pane" id="tab_2">
								<!-- form start -->
								<div class="box-body">
									
									@if($pageContent->page->has_title)
									<div class="form-group">
										<label for="title_ar">Title</label>
										<input type="text" class="form-control"  name="title_ar" id="title_ar" placeholder="Title (Ar)" value="{{$pageContent->title_ar}}">
									</div>
									@endif
									@if($pageContent->page->id == '14')
										<div class="form-group">
											<label for="link_ar">Link</label>
											<input type="text" class="form-control" name="link_ar" id="link_ar" placeholder="HyperLink (Ar)" value="{{$pageContent->link_ar}}">
										</div>
									@endif
									@if($pageContent->page->has_heading1)
									<div class="form-group">
										<label for="heading1_ar">Heading</label>
										<input type="text" class="form-control"  name="heading1_ar" id="heading1_ar" placeholder="Heading (Ar)" value="{{$pageContent->heading1_ar}}">
									</div>
									@endif
									
									@if($pageContent->page->has_content)
									<div class="form-group">
										<label for="content_en">Content</label>
										<small class="text-red">(Do not use enter key for new line. Use Shift+Enter for newline!)</small>
										<textarea class="textarea" name="content_ar" id="content_ar"  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$pageContent->content_ar}}</textarea>
									</div>
									@endif

									@if($pageContent->page->has_image)
									<div class="form-group">
										<label for="content_en">Image</label>
										<input type="file" name="image_ar">
									</div>


									@if($pageContent->image_ar)
									@if(File::exists(public_path($pageContent->image_ar)))
									<div style="width: 180px">
										<div>
											<img class="display-block" src="{{asset($pageContent->image_ar)}}" width="180" height="120">
										</div>
									</div>
									<div>
										<button type="submit" name="submit" value="removeImageAr" class="btn btn-danger">
											Remove Image
										</button>
									</div>
									@endif
									@endif



									@endif

								</div>
								<!-- /.box-body -->

								<div class="box-footer">
									<button type="submit" name="submit" value="Update" class="btn btn-primary">Submit</button>
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
		forced_root_block : "",

	});</script>
	@endsection