 
@extends('backend.layouts.adminmain')
@section('title','Products')

@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap.css')}}">

@endsection

@section('content')

<section class="content-header">
	<h1>
		Products
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
						<h3 class="box-title" style="line-height: 25px;" >All Products</h3> 
						<div style="width: 150px; " class="pull-right">
							<a href="{{ route('products.create') }}" class="btn btn-primary btn-block">Add Product</a>
						</div>
					</div>
					<div class="box-body">
						<table id="example2" class="table table-bordered table-hover">
							<thead>
								<tr>

									<th>Product Name</th>
									<th>Category</th>
									<th>Brand</th>
									<th>Sort Order</th>
									<th>Featured</th>
									<th>Status</th>
									<th>Created</th>
									<th width="130"></th>
								</tr>
							</thead>
							<tbody>
								@if(isset($products))
								@foreach($products as $product)
								<tr>

									<td>
										<a href="{{ route('products.show',$product->id) }}">{!!$product->name_en!!}</a>
									</td>
									<td>{!!isset($product->Category->name_en)?$product->Category->name_en:'n/a'!!}</td>
									<td>{!!isset($product->Brand->name_en)?$product->Brand->name_en:'n/a'!!}</td>
									<td>{{$product->sort_order}}</td>
									<td>{!!$product->featured?'<span class="label label-success">YES</span>':'<span class="label label-warning">NO</span>'!!}</td>
									<td>{!!$product->discontinued?'<span class="label label-danger">Discontinued</span>':'<span class="label label-success">Active</span>'!!}</td>
									<td>{{date('M j, Y H:i',strtotime($product->created_at))}}</td>
									<td>
										<a href="{{ route('products.show',$product->id) }}" class="btn btn-sm btn-default">View</a>
										<a href="{{ route('products.edit',$product->id) }}" class="btn btn-sm btn-primary">Edit</a>

									</td>
								</tr>
								@endforeach
								@endif
							</tbody>
							<tfoot>
								
							</tfoot>
						</table>
						<div class="row">
							<div class="col-md-2 pull-right"> 
								{{ $products->links() }}
							</div>
							<div class="col-md-4 pull-left" style="margin-top: 25px; ">Showing {{ $products->firstItem() }} - {{ $products->lastItem() }} of {{ $products->total() }} [Page {{ $products->currentPage() }} of {{$products->lastPage()}}]
							</div>
						</div>
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
	/*$(function () {
			$('#example2').DataTable({
				"paging": true,
				"lengthChange": false,
				"searching": false,
				"ordering": true,
				"info": true,
				"autoWidth": false,
				"order": [[ 5, "asc" ]]
			});
		});*/
	</script>
	@endsection