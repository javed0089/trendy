 
@extends('backend.layouts.adminmain')
@section('title','Block')



@section('content')

<section class="content-header">
	<h1>
		Block
	</h1>
	
	
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
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
				<div class="box box-success">
					<div class="box-header" style="padding: 5px 15px; height: 32px; "> 
						<h3 class="box-title" style="line-height: 25px;" >{{$blocks->first()->block_type}}</h3> 
						
					</div>
						<div class="box-body">
							<table id="example2" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th></th>
										<th>Title[En]</th>
										<th>Title[Ar]</th>
										<th>Value[En]</th>
										<th>Value[Ar]</th>
										<th></th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									@if(isset($blocks))
									@foreach($blocks as $block)
									<tr>
									<form method="post" enctype="multipart/form-data" action="{{route('blocks.update',$block->id)}}">
										{{ method_field('PATCH') }}
										{{csrf_field()}}

										<td>
											@if($block->image)
												<div style="width: 80px">
													<div>
														<img class="display-block" src="{{asset($block->image)}}" width="50" height="40">
													</div>
													<div>
														<button type="submit" name="submit" value="removeImage" class="btn btn-xs btn-danger">
															Remove
														</button>
													</div>
												</div>
										@endif


										</td>
										<td>
											<input type="text" class="form-control" name="title_en" id="title_en" placeholder="Title (En)" value="{!!$block->title_en!!}" {{!$block->title_enabled?'':'readonly'}}>
										</td>
										<td>
											<input type="text" class="form-control" name="title_ar" id="title_ar" placeholder="Title (Ar)" value="{!!$block->title_ar!!}" {{!$block->title_enabled?'':'readonly'}}>
										</td>
										<td>
											<textarea class="form-control" name="value_en" id="value_en" cols="25" rows="3">{!!$block->value_en!!}</textarea>
										</td>
										<td>
											<textarea class="form-control" name="value_ar" id="value_ar" cols="25" rows="3">{!!$block->value_ar!!}</textarea>
										</td>
										@if($block->has_image)
											<td>
												<div class="form-group">
													<input type="file" id="image" name="image">
												</div>
											</td>
										@endif
										<td><button type="submit" class="btn btn-primary">Update</button></td>
									</form>
									</tr>
									@endforeach
									@endif
								</tbody>
								<tfoot>

								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
		</section>
@endsection