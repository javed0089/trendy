@extends('backend.layouts.adminmain')
@section('title','News')

@section('content')

<section class="content-header">
<div class="box-header" style="padding: 5px 15px; height: 32px; "> 
	<h1 class="box-title" style="line-height: 25px;" >
		News -{{$news->title_en}}
	</h1>
	<div style="width: 150px; " class="pull-right">
		<a class="btn btn-primary bt-md" href="{{ route('news.edit',$news->id) }}">Edit News</a>
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
				<li><a href="#tab_3" data-toggle="tab"><i class="fa fa-picture-o"></i> Images</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab_1">
					<div class="box-header with-border">
						<h3 class="box-title">{{$news->title_en}}</h3>
					</div>
					<div class="box-body">
						<div class="col-md-9">
							<h3>Description</h3>
							<p>{!!$news->desc_en!!}</p>
						</div>
						<div class="col-md-3">
							<div class="callout ">
			        	        <h4>Created at</h4>
				                <p>{{date('M j, Y H:i',strtotime($news->created_at))}}</p>
				                <h4>Last updated at</h4>
				                <p>{{date('M j, Y H:i',strtotime($news->updated_at))}}</p>
				                <h4>Status</h4>
				                <p>{!!$news->status?'<span class="label label-success">Active</span>':'<span class="label label-danger">In-active</span>'!!}</p>
			             	</div>
		              </div>
					</div>

				</div>
				<!-- /.tab-pane -->
				<div class="tab-pane" id="tab_2">
					<div class="box-header with-border">
						<h3 class="box-title">{{$news->title_ar}}</h3>
					</div>
					<div class="box-body">
						<div class="col-md-8">
							<h3>Description</h3>
							<p>{!!$news->desc_ar!!}</p>
						</div>
					</div>

				</div>

				<div class="tab-pane" id="tab_3">
					<div class="box-header with-border">
						<h3 class="box-title">News Images</h3>
					</div>
					<div class="box-body">
						<div class="col-md-9">
							<table id="example2" class="table table-bordered table-hover">
								<thead>
									<tr>
										
										<th  width="150">Image</th>
										<th>Type</th>
										<th>Uploaded</th>
										<th width="80"></th>
									</tr>
								</thead>
								<tbody>

									@foreach($news->Photos as $photo)
									<tr>
										<td>
											@if($photo->filename)
												@if(File::exists(public_path($photo->filename)))
													<img class="display-block" src="{{asset($photo->filename)}}" width="150" height="80">
												@endif
											@endif
										</td>
										<td>{{$photo->mime}}</td>
										<td>{{ date('M j, Y H:i',strtotime($photo->created_at))}}</td>
										
										<td>
											<form role="form"  method="Post"  action="{{ route('photos.destroy',$photo->id) }}">
												{{csrf_field()}}
												{{ method_field('Delete') }}
												<input name="news_id" type="hidden" value="{{$news->id}}">
												<button type="submit" id="delbutton" class="btn btn-sm btn-danger">Delete</button>
											</form>

										</td>
									</tr>
									@endforeach

								</tbody>
								<tfoot>

								</tfoot>
							</table>
						</div>
						<div class="col-md-3">
							<div class="callout ">
								
								<h4>Upload Image</h4>
								<form role="form"  method="Post" enctype="multipart/form-data" action="{{ route('photos.store') }}">
									{{csrf_field()}}
					                <div class="form-group">
										<label for="news_image">Add image</label>
										<input type="file" id="news_image" name="news_image">
										<input name="news_id" type="hidden" value="{{$news->id}}">
									</div>
									<button type="submit" class="btn btn-primary">Upload</button>
								</form>
				                
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