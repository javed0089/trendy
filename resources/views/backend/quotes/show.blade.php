@extends('backend.layouts.adminmain')
@section('title','Quotes')

@section('styles')
 <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap.css')}}">

@endsection

@section('content')

<section class="content-header">
	<h1>
		Quote
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
				@if (count($errors) > 0)
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif
				<div class="box box-success">
					<div class="box-header" style="padding: 5px 15px; "> 
						<div class="col-md-4">
						<h4>Quote # : <span >{{$quote->id}}</span></h4>
						<h4>Status : <span>{{$quote->Status->status}}</span></h4>
						</div>
						<div class="col-md-4">
						<h4>Dated : <span>{{date('M j, Y',strtotime($quote->created_at))}}</span></h4>
                        <h4>Valid until :<span>{{isset($quote->quote_validity)?date('M j, Y H:i',strtotime($quote->quote_validity)):''}}</span></h4>
                        </div>
                        <div class="col-md-4">
                        	<form role="form"  method="Post" action="{{ route('quote-requests.update',$quote->id) }}">
                        	{{csrf_field()}}
							{{ method_field('PATCH') }}
                        	<label for="assign_to_id">Assign to(Sales Representatives):</label>
								<select name="assign_to_id" class="form-control">
									<option value="">-- None --</option>
										@foreach($users as $user)
									    	<option {{$quote->assign_to_id==$user->id?'Selected':''}} value="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</option>
									            @endforeach
								</select>
				        	<button type="submit" name="submit" class="btn btn-block btn-primary" value="assignSalesRep">Assign</button>
				        	</form>
                        </div>
					</div>
						<div class="box-body">
							<table id="example2" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>Product</th>
	                                    <th>Qty.</th>
	                                    <th>Unit</th>
	                                    <th>Price</th>
	                                    <th>P.O.D.</th>
	                                    <th>D.T.</th>
	                                    <th>P.M.</th>
	                                    <th>S.D.</th>
	                                    <th>Validity</th>
	                                    <th>Status</th>
									</tr>
								</thead>
								<tbody>

									@foreach($quote->QuoteDetails()->get() as $item)
									<tr>
										<td>{{$item->Product->name_en}}</td>
                                      <td>{{$item->quantity}}</td>
                                      <td>{{$item->unit}}</td>
                                      <td>{{isset($item->price)?$item->price:'n/a'}}</td>
                                      <td>{{$item->port_of_delivery}}</td>
                                      <td>{{$item->delivery_terms}}</td>
                                      <td>{{$item->payment_method}}</td>
                                      <td>
                                        {{$item->shipping_doc_invoice=='1'?'Invoice,':''}}
                                        {{$item->shipping_doc_packing_list=='1'?'Packing List,':''}}
                                        {{$item->shipping_doc_co=='1'?'CO,':''}}
                                        {{$item->shipping_doc_others=='1'?'Others,':''}}
                                         {{$item->shipping_doc_others_text}}

                                      </td>
                                      <td>{{isset($item->quote_validity)?date('M j, Y H:i',strtotime($item->quote_validity)):''}}</td>
                                      <td>{{$item->Status->status}}</td>
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