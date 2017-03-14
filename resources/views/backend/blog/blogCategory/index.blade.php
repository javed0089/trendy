 
@extends('backend.layouts.adminmain')
@section('title','Blog Categories')



@section('content')

<section class="content-header">
	<h1>
		Blog Categories
	</h1>
	
	
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			
			<div class="box box-info">
				<div class="box-header with-border">
					<h3 class="box-title">
						@if(isset($blogCategory))
							  Edit Category
						@else
							Add new Category
						@endif
					</h3>

				</div>
				@if(isset($blogCategory))
					<form role="form"  method="Post" enctype="multipart/form-data" action="{{ route('blogcategory.update',$blogCategory->id) }}">
					{{ method_field('PATCH') }}
				@else
					<form role="form"  method="Post" enctype="multipart/form-data" action="{{ route('blogcategory.store') }}">
				@endif	
				
								{{csrf_field()}}
					<div class="box-body">
						<div class="row">
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
							<div class="col-xs-6">
								<label>Category(En)</label>
								<input type="text" name="name_en" class="form-control" placeholder="Category name in english" required @if(isset($blogCategory)) value={{$blogCategory->name_en}} @endif>
							</div>
							<div class="col-xs-6">
								<label>Category(Ar)</label>
								<input type="text" name="name_ar" class="form-control" placeholder="Category name in arabic" required @if(isset($blogCategory)) value={{$blogCategory->name_ar}} @endif>
							</div>
							
						</div>
					</div>

					<div class="box-footer" style="padding: 3px">
						@if ($message = Session::get('success'))
							<div class="alert alert-success alert-block pull-left" style="width: 50%">
								<button type="button" class="close" data-dismiss="alert">×</button>
								<strong>{{ $message }}</strong>
							</div>
						@endif
				<div style="width: 150px;padding: 5px;" class="pull-right">
						<button class="btn btn-block btn-primary" type="submit" value="Add Category">
						@if(isset($blogCategory))
							Update Category
						@else
							Add Category
						@endif
						</button>
						</div>
					</div>
				</form>
			</div>
			<div class="box">

				
				<div class="box box-success">
					<div class="box-header"> 
						<h3 class="box-title">All blog Categories</h3> </div>
						<div class="box-body">
							<table id="example2" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>Category</th>
										<th>Created</th>
										<th>Last Updated</th>
										<th width="120"></th>
									</tr>
								</thead>
								<tbody>

									@foreach($blogCategories as $blogCategory)
									<tr>
										<td>{{str_limit($blogCategory->name_en,30)}}</td>
										<td>{{ date('M j, Y H:i',strtotime($blogCategory->created_at))}}</td>
										<td>{{date('M j, Y H:i',strtotime($blogCategory->updated_at))}}</td>
										<td>
											<a href="{{ route('blogcategory.edit',$blogCategory->id) }}" class="btn btn-block btn-default">Edit</a>
										</td>
									</tr>
									@endforeach

								</tbody>
								<tfoot>

								</tfoot>
							</table>
						</div>
						<!-- /.box-body -->
					</div>
					<!-- /.box -->


					<!-- /.box -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</section>
		<!-- /.content -->
		@endsection