 
@extends('backend.layouts.adminmain')
@section('title','Departments')



@section('content')

<section class="content-header">
	<h1>
		Departments
	</h1>
	
	
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			
			<div class="box box-info">
				<div class="box-header with-border">
					<h3 class="box-title">
						@if(isset($department))
							  Edit 
						@else
							Add New
						@endif
					</h3>

				</div>
				@if(isset($department))
					<form role="form"  method="Post" enctype="multipart/form-data" action="{{ route('departments.update',$department->id) }}">
					{{ method_field('PATCH') }}
				@else
					<form role="form"  method="Post" enctype="multipart/form-data" action="{{ route('departments.store') }}">
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
								<label>Department(En)</label>
								<input type="text" name="name_en" class="form-control" placeholder="Department name in english" required @if(isset($department)) value={{$department->name_en}} @endif>
							</div>
							<div class="col-xs-6">
								<label>Department(Ar)</label>
								<input type="text" name="name_ar" class="form-control" placeholder="Department name in arabic" required @if(isset($department)) value={{$department->name_ar}} @endif>
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
						<button class="btn btn-block btn-primary" type="submit" value="Add Department">
						@if(isset($department))
							Update Department
						@else
							Add Department
						@endif
						</button>
						</div>
					</div>
				</form>
			</div>
			<div class="box">

				
				<div class="box box-success">
					<div class="box-header"> 
						<h3 class="box-title">All Departments</h3> </div>
						<div class="box-body">
							<table id="example2" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>Department</th>
										<th>Created</th>
										<th>Last Updated</th>
										<th width="80"></th>
										<th width="80"></th>
									</tr>
								</thead>
								<tbody>

									@foreach($departments as $department)
									<tr>
										<td>{{str_limit($department->name_en,30)}}</td>
										<td>{{ date('M j, Y H:i',strtotime($department->created_at))}}</td>
										<td>{{date('M j, Y H:i',strtotime($department->updated_at))}}</td>
										<td>
											<a href="{{ route('departments.edit',$department->id) }}" class="btn btn-block btn-default">Edit</a>
										</td>
										<td>
											<form role="form"  method="Post"  action="{{ route('departments.destroy',$department->id) }}">
												{{csrf_field()}}
												{{ method_field('Delete') }}
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

@section('scripts')
	<script>
	    $("#delbutton").on("click", function(){
	        return confirm("Are you sure, you want to delete it?");
	    });
	</script>
@endsection