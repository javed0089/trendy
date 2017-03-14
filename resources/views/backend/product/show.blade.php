@extends('backend.layouts.adminmain')
@section('title','Product')

@section('content')

<section class="content-header">
<div class="box-header" style="padding: 5px 15px; height: 32px; "> 
	<h1 class="box-title" style="line-height: 25px;" >
		Product -{{$product->name_en}}
	</h1>
	<div style="width: 150px; " class="pull-right">
		<a class="btn btn-primary bt-md" href="{{ route('products.edit',$product->id) }}">Edit Product</a>
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
				<li><a href="#tab_4" data-toggle="tab"><i class="fa fa-file-text"></i> Files</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab_1">
					<div class="box-header with-border">
						<h3 class="box-title">{{$product->name_en}}</h3>
					</div>
					<div class="box-body">
						<div class="col-md-9">
							<h3>Description</h3>
							<p>{!!$product->desc_en!!}</p>
							<h3>Specification</h3>
							<p>{!!$product->specs_en!!}</p>
						</div>
						<div class="col-md-3">
							<div class="callout ">
								
								<h4>Category</h4>
				                <p>{{isset($product->Category->name_en)?$product->Category->name_en:'n/a'}}</p>
				                <h4>Brand</h4>
				                <p>{{isset($product->Brand->name_en)?$product->Brand->name_en:'n/a'}}</p>
			        	        <h4>Created at</h4>
				                <p>{{date('M j, Y H:i',strtotime($product->created_at))}}</p>
				                <h4>Last updated at</h4>
				                <p>{{date('M j, Y H:i',strtotime($product->updated_at))}}</p>
				                <h4>Slug</h4>
				                <p><a style="color: blue;" href="{{url($product->slug)}}">{{url($product->slug)}}</a></p>
				                <h4>Featured</h4>
				                <p>{!!$product->featured?'<span class="label label-success">Yes</span>':'<span class="label label-warning">No</span>'!!}</p>
				                <h4>Discontinued</h4>
				                <p>{!!$product->discontinued?'<span class="label label-danger">Yes</span>':'<span class="label label-success">No</span>'!!}</p>

				                <p>
									<form role="form"  method="Post"  action="{{ route('products.featured',$product->id) }}">
										{{csrf_field()}}
										<button type="submit" class="btn btn-block {{$product->featured?'btn-danger':'btn-success'}}">{{$product->featured?'Undo Featured':'Make Featured'}}</button>
									</form>
								</p>
				                <p>
									<form role="form"  method="Post"  action="{{ route('products.discontinue',$product->id) }}">
										{{csrf_field()}}
										<button type="submit" class="btn btn-block {{$product->discontinued?'btn-success':'btn-danger'}}">{{$product->discontinued?'Activate':'Discontinue'}}</button>
									</form>
								</p>
				                
			              </div>
		              </div>
					</div>

				</div>
				<!-- /.tab-pane -->
				<div class="tab-pane" id="tab_2">
					<div class="box-header with-border">
						<h3 class="box-title">{{$product->name_ar}}</h3>
					</div>
					<div class="box-body">
						<div class="col-md-8">
							<h3>Description</h3>
							<p>{!!$product->desc_ar!!}</p>
							<h3>Specification</h3>
							<p>{!!$product->specs_ar!!}</p>
						</div>
					</div>

				</div>

				<div class="tab-pane" id="tab_3">
					<div class="box-header with-border">
						<h3 class="box-title">Product Images</h3>
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

									@foreach($product->Images as $image)
									<tr>
										<td>
											@if($image->filename)
												@if(File::exists(public_path($image->filename)))
													<img class="display-block" src="{{asset($image->filename)}}" width="150" height="80">
												@endif
											@endif
										</td>
										<td>{{$image->mime}}</td>
										<td>{{ date('M j, Y H:i',strtotime($image->created_at))}}</td>
										
										<td>
											<form role="form"  method="Post"  action="{{ route('images.destroy',$image->id) }}">
												{{csrf_field()}}
												{{ method_field('Delete') }}
												<input name="product_id" type="hidden" value="{{$product->id}}">
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
								<form role="form"  method="Post" enctype="multipart/form-data" action="{{ route('images.store') }}">
									{{csrf_field()}}
					                <div class="form-group">
										<label for="product_image">Add image</label>
										<input type="file" id="product_image" name="product_image">
										<input name="product_id" type="hidden" value="{{$product->id}}">
									</div>
									<button type="submit" class="btn btn-primary">Upload</button>
								</form>
				                
			              </div>
		              </div>
					</div>
				</div>

				<div class="tab-pane" id="tab_4">
					<div class="box-header with-border">
						<h3 class="box-title">Product downloads</h3>
					</div>
					<div class="box-body">
						<div class="col-md-8">
							<table id="example2" class="table table-bordered table-hover">
								<thead>
									<tr>
										
										<th>File Name</th>
										<th>Type</th>
										<th>Uploaded</th>
										<th width="80"></th>
										<th width="80"></th>
									</tr>
								</thead>
								<tbody>

									@foreach($product->Files as $file)
									<tr>
										<td>{{$file->original_filename}}</td>
										<td>{{$file->mime}}</td>
										<td>{{ date('M j, Y H:i',strtotime($file->created_at))}}</td>
										<td>
											
											<a href="{{asset($file->filename) }}" target="blank" class="btn btn-sm btn-default">Download</a>
											
										</td>
										<td>
											<form role="form"  method="Post"  action="{{ route('files.destroy',$file->id) }}">
												{{csrf_field()}}
												{{ method_field('Delete') }}
												<input name="product_id" type="hidden" value="{{$product->id}}">
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
						<div class="col-md-4">
							<div class="callout ">
								
								<h4>File Uploads</h4>
								<form role="form"  method="Post" enctype="multipart/form-data" action="{{ route('files.store') }}">
									{{csrf_field()}}
					                <div class="form-group">
										<label for="product_file">Add new file</label>
										<input type="file" id="product_file" name="product_file">
										<input name="product_id" type="hidden" value="{{$product->id}}">
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