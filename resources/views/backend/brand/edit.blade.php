
@extends('backend.layouts.adminmain')
@section('title', 'Edit Brand')

@section('content')

<section class="content">
	<section class="content-header">
		<h1>
			Brands
		</h1>
	</section>

	<!-- Main content -->
	<section class="content">

		<div class="row">
			<div class="col-md-12">
				
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
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">
							Edit Brand
						</h3>
					</div>
					<div class="box-body">
						
							<form   method="POST" enctype="multipart/form-data" action="{{ route('brands.update',$brand->id) }}">
								{{ method_field('PATCH') }}
								{{csrf_field()}}
								<div class="form-group">
									<label for="name_en">Brand Name[En]</label>
									<input type="text" class="form-control" name="name_en" id="name_en" placeholder="Brand Name (En)" value="{{$brand->name_en}}">
								</div>
								<div class="form-group">
									<label for="name_ar">Brand Name[Ar]</label>
									<input type="text" class="form-control" name="name_ar" id="name_ar" placeholder="Brand Name (Ar)" value="{{$brand->name_ar}}">
								</div>
								<div class="form-group">
									<label for="slug">Slug</label>
									<input type="text" class="form-control" name="slug" id="slug" placeholder="Seo Url" value="{{$brand->slug}}">
								</div>
								<div class="form-group">
									<label for="content_en">Logo</label>
									<input type="file" name="logo">
								</div>

								@if($brand->logo)
									@if(File::exists(public_path($brand->logo)))
										<div style="width: 180px">
											<div>
												<img class="display-block" src="{{asset($brand->logo)}}" width="180" height="120">
											</div>
									@endif
											<div>
												<button type="submit" name="submit" value="removeLogo" class="btn btn-danger">
													Remove Logo
												</button>
											</div>
										</div>
								@endif
							
					</div>
					<div class="box-footer">
							<button type="submit" value="submit" name="submit" class="btn btn-primary">Submit</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection