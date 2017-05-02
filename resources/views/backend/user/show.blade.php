@extends('backend.layouts.adminmain')
@section('title','Profile')

@section('content')

<section class="content-header">
	<div class="box-header" style="padding: 5px 15px; height: 32px; "> 
		<h1 class="box-title" style="line-height: 25px;" >
			User Profile
		</h1>
	</div>
</section>

<!-- Main content -->
<section class="content">
	



	<div class="col-md-12">

		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-user"></i> Personal Details</a></li>
				<li><a href="#tab_2" data-toggle="tab"><i class="fa fa-lock"></i> Change Password</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab_1">
					<div class="box-header with-border">
						@if ($message = Session::get('success'))
						<div class="alert alert-success alert-block">
							<button type="button" class="close" data-dismiss="alert">×</button>
							<strong>{{ $message }}</strong>
						</div>
						@endif
						@if(session('error'))
						<div class="alert alert-danger">

							{{session('error')}}

						</div>
						@endif

						<h3 class="box-title">{{$user->first_name}} {{$user->last_name}}</h3>
					</div>
					<div class="box-body">
						<div class="col-md-2">

							<img class="profile-user-img" src="{{route('users.getprofilepicture',$user->id)}}" style="width: 200px">
							<form action="{{route('users.addpicture')}}" method="post" enctype="multipart/form-data">
							{{csrf_field()}}
								<div class="form-group">

									<input type="file" name="picture">
								</div>
								<button type="submit" class="btn btn-primary btn-md btn-flat">Upload</button>

							</form>
						</div>
						<div class="col-md-10">
							<dl class="dl-horizontal">
								<dt>First Name :</dt>
								<dd>{{$user->first_name}}</dd>
								<dt>Last Name :</dt>
								<dd>{{$user->last_name}}</dd>
								<dt>Email :</dt>
								<dd>{{$user->email}}</dd>
								<dt>Role :</dt>
								<dd>{{User::UserRole($user->id)}}</dd>
								<dt>Created :</dt>
								<dd>{{isset($user->created_at)?date('M j, Y H:i',strtotime($user->created_at)):''}}</dd>
								<dt>Last Login :</dt>
								<dd>{{date('M j, Y H:i',strtotime($user->last_login))}}</dd>


							</dl></div>
						</div>

					</div>
					<!-- /.tab-pane -->
					<div class="tab-pane" id="tab_2">
						<div class="box-header with-border">
							<h3 class="box-title">{{$user->first_name}} {{$user->last_name}}</h3>
						</div>
						<div class="box-body">
							<div class="col-md-4">
								<form action="{{route('users.changepassword')}}" method="post" data-parsley-validate>
									{{csrf_field()}}
									<div class="form-group has-feedback">

										<div class="form-group has-feedback">
											<input type="password" name="oldPassword" id="oldPassword" class="form-control" minlength="6" placeholder="Old Password" required>
											<span class="glyphicon glyphicon-lock form-control-feedback"></span>
										</div>

										<div class="form-group has-feedback">
											<input type="password" name="newPassword" id="newPassword" class="form-control" minlength="6" placeholder="New Password" required>
											<span class="glyphicon glyphicon-lock form-control-feedback"></span>
										</div>
										<div class="form-group has-feedback">
											<input type="password" name="confirmPassword" class="form-control" minlength="6" placeholder="Retype password" required data-parsley-equalto="#newPassword">
											<span class="glyphicon glyphicon-lock form-control-feedback"></span>
										</div>

										<div class="row">
											<!-- /.col -->
											<div class="col-xs-5">
												<button type="submit" class="btn btn-primary btn-block btn-flat">Change Password</button>
											</div>
											<!-- /.col -->
										</div>
									</form>
								</div>
							</div>

						</div>
						<div class="box-footer">

						</div>
					</div>

				</div>
			</div>

		</section>
		@endsection

		@section('scripts')
		<script>
			$("#delbutton").on("click", function(){
				return confirm("Are you sure, you want to delete it?");
			});
		</script>
		@endsection