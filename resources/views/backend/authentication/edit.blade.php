
@extends('backend.layouts.adminmain')
@section('title', 'Edit User')

@section('content')

<!-- Main content -->
<section class="content">
	<section class="content-header">
		<h1>
			Edit User
		</h1>
	</section>

	<!-- Main content -->
	<section class="content">

		<div class="row">
			<div class="col-md-12">
				<!-- Custom Tabs -->
				@if (count($errors) > 0)
				<div class="alert alert-danger">
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
				<form role="form"  method="Post" action="{{ route('users.update',$user->id) }}" data-parsley-validate>
								{{csrf_field()}}
					<div class="nav-tabs-custom">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab_1" data-toggle="tab">English</a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="tab_1">
								<!-- form start -->
							
									<div class="box-body">

										<div class="form-group">
											<label for="first_name">First Name</label>
											<input type="text" class="form-control" name="first_name" id="first_name" placeholder="First Name" required value="{{$user->first_name}}" >
										</div>

										<div class="form-group">
											<label for="last_name">Last Name</label>
											<input type="text" class="form-control" name="last_name" id="last_name" placeholder="Last Name" required value="{{$user->last_name}}" >
										</div>

										<div class="form-group">
											<label for="email">Email</label>
											<input type="email" class="form-control" name="email" id="email" placeholder="Email" required value="{{$user->email}}" >
										</div>

										 <div class="form-group">
										 	<label for="role">Role</label>
								           	<select name="role" class="form-control" required>
								            	@foreach($roles as $role)
								              		<option {{$user->roles->first()->id==$role->id?'Selected':''}} value="{{$role->slug}}">{{$role->name}}</option>
								            	@endforeach
								         	</select>
								       	 </div>
									
									</div>
									<!-- /.box-body -->

									<div class="box-footer">
										<button type="submit" value="submit" class="btn btn-primary">Update</button>
									</div>

								</div>
							

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