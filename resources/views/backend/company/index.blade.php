@extends('backend.layouts.adminmain')
@section('title','Company')

@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap.css')}}">

@endsection

@section('content')

<section class="content-header">
	<h1>
		Company
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
						<h3 class="box-title" style="line-height: 25px;" >Comapny</h3> 
						<div style="width: 150px; " class="pull-right">
							<a href="{{ route('company.create') }}" class="btn btn-primary btn-block">Add Company</a>
						</div>
					</div>
					<div class="box-body">
						<table id="example2" class="table table-bordered table-hover">
							<thead>
								<tr>

									<th>Name</th>
									<th>Logo</th>
									<th>Profile</th>
									<th>QR Code</th>
									<th></th>
									

								</tr>
							</thead>
							<tbody>

								@foreach($companies as $company)
								<tr>

									<td>{{$company->company_name}} 
									</td>
									<td>
										@if($company->company_logo)

										<img class="display-block" src="{{asset($company->company_logo)}}" width="100" height="80">

										@endif
									</td>
									<td>
										@if($company->company_profile)


										<a href="{{asset($company->company_profile)}}" target="_blank">Download</a>


										@endif
									</td>
									<td>
										@if($company->company_qrcode)

										<img class="display-block" src="{{asset($company->company_qrcode)}}" width="100" height="80">

										@endif	</td>
										
										<td><a href="{{ route('company.edit',$company->id) }}" class="btn btn-block btn-default">Edit</a></td>
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

		@section('scripts')


		!-- DataTables -->
		<script src="{{asset('backend/plugins/datatables/jquery.dataTables.min.js')}}"></script>
		<script src="{{asset('backend/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>

		<!-- page script -->
		<script>
			$(function () {
				$('#example2').DataTable({
					"paging": true,
					"lengthChange": false,
					"searching": false,
					"ordering": true,
					"info": true,
					"autoWidth": false,
					"order": [[ 1, "desc" ]]
				});

				$("#delbutton").on("click", function(){
					return confirm("Are you sure, you want to delete it?");
				});

			});
		</script>
		@endsection