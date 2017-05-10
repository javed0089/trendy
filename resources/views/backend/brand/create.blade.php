
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
							Add new Brand
						</h3>
					</div>
					<div class="box-body">
						<form   method="POST" enctype="multipart/form-data" action="{{ route('brands.store') }}">
							{{csrf_field()}}
							<div class="form-group">
								<label for="name_en">Brand Name[En]</label>
								<input type="text" class="form-control" name="name_en" id="name_en" placeholder="Brand Name (En)" value="{{old('name_en')}}">
							</div>
							<div class="form-group">
								<label for="name_ar">Brand Name[Ar]</label>
								<input type="text" class="form-control" name="name_ar" id="name_ar" placeholder="Brand Name (Ar)" value="{{old('name_ar')}}">
							</div>
							<div class="form-group">
								<label for="slug">Slug</label>
								<input type="text" class="form-control" name="slug" id="slug" placeholder="Seo Url" value="{{old('slug')}}">
							</div>
							<div class="form-group">
								<label for="content_en">Logo</label>
								<input type="file" name="logo">
							</div>

							<div class="form-group">
								<label for="meta_title_en">Meta page title[En] </label>
								<input type="text" class="form-control"  name="meta_title_en"  value="{{old('meta_title_en')}}" >
							</div>

							<div class="form-group">
								<label for="meta_description_en">Meta description[En]</label>
								<textarea class="mceNoEditor" maxlength="255" name="meta_description_en"  style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"> {{old('meta_description_en')}}</textarea>
							</div>

							<div class="form-group">
								<label for="meta_title_ar">Meta page title[Ar]</label>
								<input type="text" class="form-control"  name="meta_title_ar"  value="{{old('meta_title_ar')}}" >
							</div>

							<div class="form-group">
								<label for="meta_description_ar">Meta description[Ar]</label>
								<textarea class="mceNoEditor" maxlength="255" name="meta_description_ar"  style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"> {{old('meta_description_ar')}}</textarea>
							</div>	

						</div>
						<div class="box-footer">
							<button type="submit" name="submit" class="btn btn-primary">Submit</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
	@endsection