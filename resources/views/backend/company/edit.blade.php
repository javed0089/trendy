
@extends('backend.layouts.adminmain')
@section('title', 'Edit Company')

@section('content')

<!-- Main content -->
<section class="content">
	<section class="content-header">
		<h1>
			Edit Company
		</h1>
	</section>

	<!-- Main content -->
	<section class="content">

		<div class="row">
			<div class="col-md-12">
				<!-- Custom Tabs -->
				@if (count($errors) > 0)
				<div class="alert alert-danger">
					There were some problems with your input.<br><br>
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

				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Edit Company</h3>
					</div>
					<!-- /.box-header -->
					<!-- form start -->
					<form role="form"  method="Post" enctype="multipart/form-data" action="{{ route('company.update',$company->id) }}" >
						{{csrf_field()}}
					{{ method_field('PATCH') }}

						<div class="box-body">
							<div class="form-group">
								<label for="company_name">Company Name</label>
								<input type="text" class="form-control" name="company_name"  placeholder="Company Name" required value="{{$company->company_name}}" >
							</div>
							<div class="form-group">
								<label for="company_logo">Company Logo</label>
								<input type="file" name="company_logo">
							</div>
							@if($company->company_logo)
							<div style="width: 180px">
								<div>
								<img class="display-block" src="{{asset($company->company_logo)}}" width="180" height="120">
								</div>
							</div>
							@endif
							<hr>
							<div class="form-group">
								<label for="company_profile">Company Profile</label>
								<input type="file" name="company_profile">
							</div>
							@if($company->company_profile)
							
								<div>
								<a href="{{asset($company->company_profile)}}" target="_blank">Download</a>
								</div>
							
							@endif
							<hr>
							<div class="form-group">
								<label for="company_qrcode">Contact QR Code</label>
								<input type="file" name="company_qrcode">
							</div>
							@if($company->company_qrcode)
							<div style="width: 180px">
								<div>
								<img class="display-block" src="{{asset($company->company_qrcode)}}" width="180" height="120">
								</div>
							</div>
							@endif
							
						</div>
						<!-- /.box-body -->

						<div class="box-footer">
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</form>
				</div>
				
			</div>
		</section>
	</section>

	@endsection
	@section('scripts')
	@section('scripts')
	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
	<script>

		tinymce.init({
			selector:'textarea',
			plugins: 'code preview lists link image',
			menubar:false,
			toolbar: 'undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code preview',

		});

	</script>

	@endsection