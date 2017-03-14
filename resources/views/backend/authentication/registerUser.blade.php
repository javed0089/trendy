@extends('backend.layouts.adminmain')
@section('title', 'Register')
 

@section('content')
<section class="content-header">
      <h1>
        Create a new User
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Register</li>
      </ol>
    </section>
  <div class="register-box">
    <div class="register-box-body">
      <p class="login-box-msg">Create a New User</p>
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
      <form action="register" method="post">
        {{csrf_field()}}
        <div class="form-group has-feedback">
        <input type="text" name="first_name" class="form-control" placeholder="First Name" required value="{{old('first_name')}}">
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
         <div class="form-group has-feedback">
        <input type="text" name="last_name" class="form-control" placeholder="Last Name" required value="{{old('last_name')}}">
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
       
        <div class="form-group has-feedback">
          <input type="email" name="email" class="form-control" placeholder="Email" required value="{{old('email')}}">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" name="confirmPassword" class="form-control" placeholder="Retype password" required>
          <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
        </div>
          <div class="form-group has-feedback">
           <select name="role" class="form-control" required>
            <option value="">Select Role</option>
            @foreach($allroles as $role)
            {{$role}}
              <option value="{{$role->slug}}">{{$role->name}}</option>
            @endforeach
         </select>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
    <!-- /.form-box -->
  </div>
 @endsection
