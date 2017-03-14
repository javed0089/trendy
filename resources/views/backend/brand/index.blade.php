 
@extends('backend.layouts.adminmain')
@section('title','Brands')



@section('content')

<section class="content-header">
	<h1>
		Brands
	</h1>
	
	
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				@if ($message = Session::get('success'))
					<div class="alert alert-success alert-block">
						<button type="button" class="close" data-dismiss="alert">×</button>
				        <strong>{{ $message }}</strong>
					</div>
				@endif
				<div class="box box-success">
					<div class="box-header" style="padding: 5px 15px; height: 32px; "> 
						<h3 class="box-title" style="line-height: 25px;" >All brands</h3> 
						<div style="width: 150px; " class="pull-right">
							<a href="{{ route('brands.create') }}" class="btn btn-primary btn-block">Add Brand</a>
						</div>
					</div>
						<div class="box-body">
							<table id="example2" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th width="150">Logo</th>
										<th>Brand</th>
										<th>Created</th>
										<th>Last Updated</th>
										<th width="120"></th>
									</tr>
								</thead>
								<tbody>

									@foreach($brands as $brand)
									<tr>
										<td>
											@if($brand->logo)
												@if(File::exists(public_path($brand->logo)))
													<img class="display-block" src="{{asset($brand->logo)}}" width="150" height="80">
												@endif
											@endif
										</td>
										<td>{{str_limit($brand->name_en,30)}}</td>
										<td>{{ date('M j, Y H:i',strtotime($brand->created_at))}}</td>
										<td>{{date('M j, Y H:i',strtotime($brand->updated_at))}}</td>
										<td>
											<a href="{{ route('brands.edit',$brand->id) }}" class="btn btn-block btn-default">Edit</a>
										</td>
									</tr>
									@endforeach

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