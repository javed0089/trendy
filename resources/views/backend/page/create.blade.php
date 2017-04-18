
@extends('backend.layouts.adminmain')
@section('title', 'Homepage-Company Section')

@section('content')

<!-- Main content -->
<section class="content">
	 <section class="content-header">
      <h1>
       {{$pageContent->page_title}} - {{$pageContent->section_title}} - CREATE
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
							<form role="form"  method="Post" enctype="multipart/form-data" action="{{ route('pages.store',$pageContent->id) }}">
								{{csrf_field()}}
								<div class="box-body">
								@if(Session::has('message'))
								<div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible">
					                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					                <h4><i class="icon fa fa-check"></i> Alert!</h4>
					              {{ Session::get('message')}}
					             </div>
									@endif
									@if($pageContent->has_title)
										<div class="form-group">
											<label for="title_en">Title</label>
											<input type="text" class="form-control" name="title_en" id="title_en" placeholder="Title (En)" >
										</div>
									@endif
									@if($pageContent->id == '14')
										<div class="form-group">
											<label for="title_en">Link</label>
											<input type="text" class="form-control" name="link_en" id="link_en" placeholder="HyperLink (En)" >
										</div>
									@endif

									@if($pageContent->has_heading1)
										<div class="form-group">
											<label for="heading1_en">Heading</label>
											<input type="text" class="form-control"  name="heading1_en" id="heading1_en" placeholder="Heading (En)" >
										</div>
									@endif


									@if($pageContent->has_content)
							            <div class="form-group">
							              <label for="content_en">Content</label>
							              <small class="text-red">(Do not use enter key for new line. Use Shift+Enter for newline!)</small>
							                <textarea class="textarea" name="content_en" id="content_en" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
							            </div>
          							@endif

									@if($pageContent->has_image)	
										<div class="form-group">
											<label for="content_en">Image</label>
											<input type="file" id="name_en" name="image_en">
										</div>
									@endif

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
									@if($pageContent->has_title)
										<div class="form-group">
											<label for="title_ar">Title</label>
											<input type="text" class="form-control"  name="title_ar" id="title_ar" placeholder="Title (Ar)">
										</div>
									@endif
									@if($pageContent->id == '14')
										<div class="form-group">
											<label for="title_ar">Link</label>
											<input type="text" class="form-control" name="link_ar" id="link_ar" placeholder="HyperLink (Ar)" >
										</div>
									@endif
									
									@if($pageContent->has_heading1)
										<div class="form-group">
											<label for="heading1_ar">Heading</label>
											<input type="text" class="form-control"  name="heading1_ar" id="heading1_ar" placeholder="Heading (Ar)">
										</div>
									@endif
										
									@if($pageContent->has_content)
							            <div class="form-group">
							              <label for="content_ar">Content</label>
							              <small class="text-red">(Do not use enter key for new line. Use Shift+Enter for newline!)</small>
							                <textarea class="textarea" name="content_ar" id="content_ar" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
							            </div>
          							@endif
									
									@if($pageContent->has_image)	
										<div class="form-group">
											<label for="image_ar">Image</label>
											<input type="file"  id="name_ar" name="image_ar">
										</div>
									@endif

									

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
  	 forced_root_block : "",
	  });</script>
			
	@endsection