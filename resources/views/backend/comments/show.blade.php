@extends('backend.layouts.adminmain')
@section('title','Message')

@section('content')

<section class="content-header">
<div class="box-header" style="padding: 5px 15px; height: 32px; "> 
	<h1 class="box-title" style="line-height: 25px;" >
		Message
	</h1>
</div>
</section>

<!-- Main content -->
<section class="content">
	@if ($message = Session::get('success'))
	<div class="alert alert-success alert-block">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<strong>{{ $message }}</strong>
	</div>
	@endif

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



	<div class="col-md-12">
	<div class="box">
			<div class="box-header with-border">
				<div class="box-body">
					<h4>Fullname : <span >{{$comment->fullname}}</span></h4>
					<h4>Email : <span >{{$comment->email}}</span></h4>
					<h4>Phone : <span >{{$comment->phone}}</span></h4>
					<h4>IP Address : <span >{{$comment->ip_address}}</span></h4>
					<h4>Message : <span >{{$comment->message}}</span></h4>
					
				</div>
			</div>
		</div>
		
	</div>

</section>
@endsection
