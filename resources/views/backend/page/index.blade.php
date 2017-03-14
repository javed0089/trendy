@extends('backend.layouts.adminmain')
@section('title','All Sections')

@section('styles')
 <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap.css')}}">

@endsection

@section('content')

<section class="content-header">
	<h1>
		Sections
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
						<h3 class="box-title" style="line-height: 25px;" >All Sections</h3> 
					</div>
						<div class="box-body">
							<table id="example2" class="table table-bordered table-hover">
								<thead>
									<tr>
										
										<th>Page</th>
										<th>Section</th>
										<th>Status</th>
										<th width="80"></th>
									</tr>
								</thead>
								<tbody>
								@if(isset($pages))
									@foreach($pages as $page)
									<tr>
										
										<td>
											{{$page->page_title}}
										</td>
										<td>{{$page->section_title}}</td>
										<td>{!!$page->status?'<span class="label label-success">ON</span>':'<span class="label label-danger">OFF</span>'!!}</td>
										<td>
										<form method="post" action="{{ route('pages.status',$page->id) }}">
										{{csrf_field()}}
											<button  type="submit" class="btn btn-sm @if($page->status) btn-danger @else btn-success @endif}}">{{$page->status?'Turn Off':'Turn ON'}}</button>
										</form>	
										</td>
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
       "order": [[ 0, "asc" ]]
    });
  });
</script>
@endsection