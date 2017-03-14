
@extends('backend.layouts.adminmain')
@section('title', 'Add Member')

@section('content')

<!-- Main content -->
<section class="content">
	<section class="content-header">
		<h1>
			Add Member
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
				<form role="form"  method="Post" enctype="multipart/form-data" action="{{ route('members.store') }}">
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
											<label for="name_en">Member Name</label>
											<input type="text" class="form-control" name="name_en" id="name_en" placeholder="Member Name in english" required value="{{old('name_en')}}" >
										</div>

										<div class="form-group">
											<label for="designation_en">Designation</label>
											<input type="text" class="form-control" name="designation_en" id="designation_en" placeholder="Designation_en in english" required value="{{old('designation_en')}}" >
										</div>

										<div class="form-group">
											<label for="facebook">Facebook</label>
											<input type="text" class="form-control" name="facebook" id="facebook" placeholder="Facebook link"  value="{{old('facebook')}}" >
										</div>

										<div class="form-group">
											<label for="twitter">Twitter</label>
											<input type="text" class="form-control" name="twitter" id="twitter" placeholder="Twitter link"  value="{{old('twitter')}}" >
										</div>

										<div class="form-group">
											<label for="linkedin">LinkedIn</label>
											<input type="text" class="form-control" name="linkedin" id="linkedin" placeholder="Linked In link"  value="{{old('linkedin')}}" >
										</div>
										
										<div class="form-group">
											<label for="image">Add Image</label>
											<input type="file" id="image" name="image">
										</div>

										<div class="checkbox">
						                  <label>
						                    <input name="status" type="checkbox">Status
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
											<label for="name_ar">Member Name</label>
											<input type="text" class="form-control" name="name_ar" id="name_ar" placeholder="Member Name in arabic"  value="{{old('name_ar')}}" >
										</div>

										<div class="form-group">
											<label for="designation_ar">Designation</label>
											<input type="text" class="form-control" name="designation_ar" id="designation_ar" placeholder="Designation_en in arabic"  value="{{old('designation_ar')}}" >
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