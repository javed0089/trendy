@extends('backend.layouts.adminmain')
@section('title','Information')

@section('content')

<section class="content-header">
<div class="box-header" style="padding: 5px 15px; height: 32px; "> 
	<h1 class="box-title" style="line-height: 25px;" >
		Page -{{$information->name_en}}
	</h1>
	<div style="width: 150px; " class="pull-right">
		<a class="btn btn-primary bt-md" href="{{ route('informations.edit',$information->id) }}">Edit Page</a>
	</div>
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
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-table"></i> English</a></li>
				<li><a href="#tab_2" data-toggle="tab"><i class="fa fa-table"></i> Arabic</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab_1">
					<div class="box-header with-border">
						<h3 class="box-title">{{$information->name_en}}</h3>
					</div>
					<div class="box-body">
						<div class="col-md-9">
							<p>{!!$information->desc_en!!}</p>
						</div>
						<div class="col-md-3">
							<div class="callout ">
								<h4>Page Type</h4>
				                <p>{{$information->InformationType->information_type_en}}</p>
								<h4>Created at</h4>
				                <p>{{date('M j, Y H:i',strtotime($information->created_at))}}</p>
				                <h4>Last updated at</h4>
				                <p>{{date('M j, Y H:i',strtotime($information->updated_at))}}</p>
				                <h4>Status</h4>
				                <p>{!!$information->status?'<span class="label label-success">Active</span>':'<span class="label label-warning">In-active</span>'!!}</p>

				                <h4>Meta page title</h4>
				                <p>{{$information->meta_title_en}}</p>
				                <h4>Meta description</h4>
				                <p>{{$information->meta_description_en}}</p>
			              </div>
		              </div>
					</div>

				</div>
				<!-- /.tab-pane -->
				<div class="tab-pane" id="tab_2">
					<div class="box-header with-border">
						<h3 class="box-title">{{$information->name_ar}}</h3>
					</div>
					<div class="box-body">
						<div class="col-md-9">
							<p>{!!$information->desc_ar!!}</p>
						</div>
						<div class="col-md-3">
							<div class="callout ">
								<h4>Page Type</h4>
				                <p>{{$information->InformationType->information_type_en}}</p>
								<h4>Created at</h4>
				                <p>{{date('M j, Y H:i',strtotime($information->created_at))}}</p>
				                <h4>Last updated at</h4>
				                <p>{{date('M j, Y H:i',strtotime($information->updated_at))}}</p>
				                <h4>Status</h4>
				                <p>{!!$information->status?'<span class="label label-success">Active</span>':'<span class="label label-warning">In-active</span>'!!}</p>

				                <h4>Meta page title</h4>
				                <p>{{$information->meta_title_ar}}</p>
				                <h4>Meta description</h4>
				                <p>{{$information->meta_description_ar}}</p>
			              </div>
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