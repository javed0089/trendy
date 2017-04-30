
@extends('backend.layouts.adminmain')
@section('title', 'Edit page')

@section('content')

<section class="content">
	<section class="content-header">
		<h1>
			Edit page
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
							Edit Page
						</h3>
					</div>
					<div class="box-body">
						
						<form   method="POST" enctype="multipart/form-data" action="{{ route('webpages.update',$webpage->id) }}">
							{{ method_field('PATCH') }}
							{{csrf_field()}}
							<div class="form-group">
								<label for="name_en">Page name</label>
								<input type="text" class="form-control" disabled name="page_name"  value="{{$webpage->page_name}}">
							</div>
							
							<div class="form-group">
								<label for="meta_title_en">Meta page title[En] </label>
								<input type="text" class="form-control"  name="meta_title_en"  value="{{$webpage->meta_title_en}}" >
							</div>

							<div class="form-group">
								<label for="meta_description_en">Meta description[En]</label>
								<textarea class="mceNoEditor" name="meta_description_en"  style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"> {{$webpage->meta_description_en}}</textarea>
							</div>

							<div class="form-group">
								<label for="meta_title_ar">Meta page title[Ar]</label>
								<input type="text" class="form-control"  name="meta_title_ar"  value="{{$webpage->meta_title_ar}}" >
							</div>

							<div class="form-group">
								<label for="meta_description_ar">Meta description[Ar]</label>
								<textarea class="mceNoEditor" name="meta_description_ar"  style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"> {{$webpage->meta_description_ar}}</textarea>
							</div>	
							
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