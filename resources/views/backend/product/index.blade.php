 
@extends('backend.layouts.adminmain')
@section('title','Products')

@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap.css')}}">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@endsection

@section('content')

<section class="content-header">
	<div class="col-md-4" style="">
		<h3>
			Products
		</h3>
	</div>
	<div class="col-md-4" >
		
		<label for="inputEmail3" class=" control-label text-right">Search Product</label>
		<span id="searchmsg" class="text-red" style="margin-left: 10px; font-style: italic;"></span>
		<div class="input-group">

			<input type="text" id="searchtxt" name="term" class="form-control" placeholder="Enter Product name">
			<div class="input-group-btn">
				<a  href="" id="prodlink" class="btn btn-primary">Go</a>
			</div>

		</div>
	</div>

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
						<div class="col-md-6">
							<form method="get" action="{{url()->current()}}">

								<label>Search: <small class="text-green"><i>Product Name,Category,Brand</i></small></label> 
								<div class="input-group input-group-sm">
									<input type="text" class="form-control" name="term" value="{{Request::get('term')}}">
									<span class="input-group-btn">
										<button type="submit" class="btn btn-info btn-flat">Go!</button>
									</span>
								</div>
							</form>	
						</div>

						<div  class="col-md-2 pull-right">
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

		$(function()
		{
			$( "#searchtxt" ).autocomplete({
				source: "{{route('products.search')}}",

				minLength: 2,
				response: function(event, ui) {
					if (ui.content.length === 0) {
						$('#searchmsg').text("No results found");
					} else {
						$('#searchmsg').empty();
					}
				},
				select: function(event, ui) {
					
					$('#searchtxt').val(ui.item.value);
					var id=ui.item.id;
					var url ='{{ route('products.show',"id") }}';
					url = url.replace('id', id);
					$('#prodlink').attr('href',url );
				}
			});
			

			$("#searchtxt").keyup(function(event){
				if(event.keyCode == 13){
					$('#prodlink')[0].click();
				}
				if(!this.value){
					$('#searchmsg').empty();
				}
			});
		});
	</script>
	@endsection