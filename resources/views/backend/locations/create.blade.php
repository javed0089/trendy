
@extends('backend.layouts.adminmain')
@section('title', 'Add Location')

@section('content')

<!-- Main content -->
<section class="content">
	<section class="content-header">
		<h1>
			Add Location
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
				<form role="form"  method="Post" action="{{ route('locations.store') }}">
								{{csrf_field()}}
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab_1" data-toggle="tab">English</a></li>
							<li><a href="#tab_2" data-toggle="tab">Arabic</a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="tab_1">
								<!-- form start -->
							
									<div class="box-body">

										<div class="form-group">
											<label for="country_en">Country</label>
											<input type="text" class="form-control" name="country_en" id="country_en" placeholder="Country in english" required value="{{old('country_en')}}" >
										</div>

										<div class="form-group">
											<label for="address_en">Address</label>
											<textarea class="textarea" name="address_en" id="address_en"  style="width: 100%; height: 150px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{old('address_en')}}</textarea>
										</div>

										<div class="form-group">
											<label for="telephone">Telephone</label>
											<input type="text" class="form-control" name="telephone" id="telephone" placeholder="Telephone"  value="{{old('telephone')}}" >
										</div>

										<div class="form-group">
											<label for="fax">Fax</label>
											<input type="text" class="form-control" name="fax" id="fax" placeholder="Fax"  value="{{old('fax')}}" >
										</div>

										<div class="form-group">
											<label for="email">Email</label>
											<input type="text" class="form-control" name="email" id="email" placeholder="Email"  value="{{old('email')}}" >
										</div>
										
										<div class="form-group">
											<label for="latitude">Map-Latitude</label>
											<input type="text" class="form-control" name="latitude" id="latitude" placeholder="Map latitudes"  value="{{old('latitude')}}" >
										</div>

										<div class="form-group">
											<label for="longitude">Map-Longitude</label>
											<input type="text" class="form-control" name="longitude" id="longitude" placeholder="Map longitudes"  value="{{old('longitude')}}" >
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
											<label for="country_ar">Country</label>
											<input type="text" class="form-control" name="country_ar" id="country_ar" placeholder="Country in english" required value="{{old('country_ar')}}" >
										</div>

										<div class="form-group">
											<label for="address_ar">Address</label>
											<textarea class="textarea" name="address_ar" id="address_ar"  style="width: 100%; height: 150px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{old('address_ar')}}</textarea>
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