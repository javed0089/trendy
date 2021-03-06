@extends('backend.layouts.adminmain')
@section('title','Quotes')

@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap.css')}}">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link href="{{asset('css/parsley.css')}}" rel="stylesheet">
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
							<h4>Quote # : <span >{{$quote->quote_no}}</span></h4>
							<h4>Customer : <span >{{$quote->User->first_name}} {{$quote->User->last_name}}</span></h4>
							<h4>Email : <span >{{$quote->User->email}}</span></h4>
							<h4>Status : <span>{{$quote->Status->status_en}}</span></h4>
						</div>
						<div class="col-md-4">
							<h4>Dated : <span>{{date('M j, Y',strtotime($quote->created_at))}}</span></h4>
							<h4>Valid until :<span>{{isset($quote->quote_validity)?date('M j, Y',strtotime($quote->quote_validity)):''}}</span>
								@if(!$quote->Order)
								<button type="button" class="btn btn-md btn-primary" data-toggle="modal" data-target="#setValidity">Set</button></h4>
								@endif
								<div id="setValidity" class="modal fade" role="dialog">
									<div class="modal-dialog">

										<!-- Modal content-->
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="modal-title">Quote id: {{$quote->id}}</h4>
											</div>

											<form role="form" method="Post" action="{{ route('quote-requests.update',$quote->id) }}" >
												{{csrf_field()}}
												{{ method_field('PATCH') }}
												<div class="modal-body">
													<div class="form-group" >
														<label for="quote_validity">Validity</label>
														<input type="date" class="form-control" name="quote_validity" min={{ date('Y-m-d H:i:s') }}  id="quote_validity" value="{{$quote->quote_validity}}" >
													</div>
												</div>

												<div class="modal-footer">
													<button type="button" class="btn btn-md " data-dismiss="modal">Cancel</button>
													<button type="submit" name="submit" class="btn btn-md btn-primary" value="setValidity">Save</button>
												</div>
											</form>

										</div>
									</div>
								</div>
								<h4>Assigned to : @if($quote->AssignedTo)<span>{{$quote->AssignedTo->first_name}} {{$quote->AssignedTo->last_name}}</span>@endif</h4>
							</div>
							<div class="col-md-2 ">
								@if($quote->status == 3)
								<a target="_blank" href="{{route('quote-requests.download',$quote->id)}}" class="btn btn-success btn-md">Download Pdf</a>
								@endif
								@if(!$quote->Order)	
								<button type="button" class="btn btn-md btn-primary" data-toggle="modal" data-target="#addProduct">Add Product</button>
								@endif
							</div>
							<div class="col-md-2 pull-right">
								
								<form role="form"  method="Post" action="{{ route('quote-requests.update',$quote->id) }}">
									{{csrf_field()}}
									{{ method_field('PATCH') }}
									@if(User::isSupervisor())
									<label for="assign_to_id">Assigned to:</label>
									<select name="assign_to_id" class="form-control">
										<option value="">-- None --</option>
										@foreach($users as $user)
										<option {{$quote->assign_to_id==$user->id?'Selected':''}} value="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</option>
										@endforeach
									</select>

									@if(!$quote->Order)
									<button type="submit" name="submit" class="btn btn-block btn-primary" value="assignSalesRep">Assign</button>
									
									
									<button type="submit" name="submit" class="btn btn-block btn-success" value="sendQuote">Approve</button>
									@endif
									@endif
									@if(User::isSalesExecutive() && !$quote->Order)
									<button type="submit" name="submit" class="btn btn-block btn-success" value="quoteProcessed">Processed</button>
									@endif
									
									
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
										<th>Currency</th>
										<th>P.O.D.</th>
										<th>D.T.</th>
										<th>P.M.</th>
										<th>S.D.</th>
										<th>Status</th>
										<th></th>
									</tr>
								</thead>
								<tbody>

									@foreach($quote->QuoteDetails()->get() as $item)
									<tr>
										<td>{{$item->Product->name_en}}</td>
										<td>{{$item->quantity}}</td>
										<td>{{$item->unit}}</td>
										<td>{{isset($item->price)?$item->price:'n/a'}}</td>
										<td>{{$item->currency}}</td>
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
										<td>{{$item->Status->status_en}}</td>
										<td>
											@if(!$quote->Order)	
											<button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#{{$item->id}}">Edit</button>
											@endif
											<div id="{{$item->id}}" class="modal fade" role="dialog">
												<div class="modal-dialog">

													<!-- Modal content-->
													<div class="modal-content">
														<div class="modal-header">
															<button type="button" class="close" data-dismiss="modal">&times;</button>
															<h4 class="modal-title">{{$item->Product->name_en}}</h4>
														</div>

														<form role="form" method="Post" action="{{ route('quote-requests.update',$item->id) }}" class="form-vertical">
															{{csrf_field()}}
															{{ method_field('PATCH') }}
															<div class="modal-body">
																<div class="form-group" >
																	<label for="quantity">Quantity</label>
																	<input type="number" class="form-control"  name="quantity" id="quantity" step="any" value="{{$item->quantity}}" required style="width: 80px;">
																</div>
																<div class="form-group" >
																	<label for="unit">Unit</label>
																	<select class="form-control"  name="unit">
																		@foreach($units as $unit)
																		<option {{$item->unit==$unit->name_en ?'Selected':''}} value="{{$unit->name_en}}">{{$unit->name_en}}</option>
																		@endforeach	
																	</select>
																</div>
																<div class="form-group" >
																	<label for="price">Price</label>
																	<input type="number"   class="form-control" name="price" id="price" step="any" value="{{$item->price}}" required style="width: 120px;">
																</div>
																<div class="form-group" >
																	<label for="currency">Currency</label>
																	<select class="form-control"  name="currency">
																		@foreach($currencies as $currency)
																		<option {{$item->currency==$currency->name_en ?'Selected':''}} value="{{$currency->name_en}}">{{$currency->name_en}}</option>
																		@endforeach	
																	</select>
																</div>
																<div class="control-group">
																	&nbsp;
																</div>

																<div class="form-group" style="display:block;">
																	<label for="title_en">Port of delivery</label>
																	<input type="text" style="display: block;width: 100%" class="form-control" name="port_of_delivery" id="port_of_delivery" value="{{$item->port_of_delivery}}">
																</div>
																<div class="form-group" style="display:block;">
																	<label for="delivery_terms">Delivery Terms</label>
																	<select class="form-control" style="display: block;width: 100%" name="delivery_terms">
																		@foreach($delivery_terms as $delivery_term)
																		<option {{$item->delivery_terms==$delivery_term->name_en ?'Selected':''}} value="{{$delivery_term->name_en}}">{{$delivery_term->name_en}}</option>
																		@endforeach	
																	</select>
																</div>
																<div class="form-group" style="display:block;">
																	<label for="delivery_terms">Payment Method</label>
																	<select class="form-control" style="display: block;width: 100%" name="payment_method">
																		@foreach($payment_methods as $payment_method)
																		<option {{$item->payment_method==$payment_method->name_en ?'Selected':''}} value="{{$payment_method->name_en}}">{{$payment_method->name_en}}</option>

																		@endforeach	
																	</select>
																</div>
																<div class="form-group" style="display:block;">
																	<div>
																		<h4 style="margin-bottom: 15px;">Shipping Documents</h4>
																		<div class="checkbox checkbox-inline">
																			<input id="invoice" name="invoice" class="styled"  type="checkbox" {{$item->shipping_doc_invoice?'checked':''}}>
																			<label for="invoice">Invoice</label>
																		</div>
																		<div class="checkbox checkbox-inline">
																			<input id="packing_list" name="packing_list" class="styled"  type="checkbox" {{$item->shipping_doc_packing_list?'checked':''}}>
																			<label for="packing_list">Packing List</label>
																		</div>
																		<div class="checkbox checkbox-inline">
																			<input id="co" name="co" class="styled"  type="checkbox" {{$item->shipping_doc_co?'checked':''}}>
																			<label for="co">CO</label>
																		</div>
																		<div class="checkbox checkbox-inline">
																			<input id="others" name="others" class="styled"  type="checkbox" {{$item->shipping_doc_others?'checked':''}}>
																			<label for="others">Others</label>
																		</div>
																	</div>
																	<div style="display:block;">
																		<label for="others_text">Others</label>
																		<input style="display: block;width: 100%" id="others" name="others_text" value="{{ $item->shipping_doc_others_text }}" class="form-control" type="text"  value="">
																	</div>
																</div>

																<div class="form-group" style="display:block;">
																	<label for="remarks">Remarks</label>
																	<input type="text" style="display: block;width: 100%" class="form-control" name="remarks" id="remarks" value="{{$item->remarks}}" >
																</div>
																<div class="form-group" style="display:block;">
																	<label for="status">Status</label>
																	<select class="form-control" style="display: block;width: 100%" name="status">
																		@foreach($statuses as $status)
																		<option {{$item->status==$status->id ?'Selected':''}} value="{{$status->id}}">{{$status->status_en}}</option>

																		@endforeach	
																	</select>
																</div>
															</div>

															<div class="modal-footer">
																<button type="button" class="btn btn-md " data-dismiss="modal">Cancel</button>
																<button type="submit" name="submit" class="btn btn-md btn-primary" value="saveProduct">Save</button>
															</div>
														</form>

													</div>
												</div>
											</div>
											<div id="addProduct" class="modal fade" role="dialog">
												<div class="modal-dialog">
													<!-- Modal content-->
													<div class="modal-content">
														<form role="form" method="Post" action="{{ route('quote-requests.store') }}" class="form-vertical" data-parsley-validate>
															{{csrf_field()}}
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal">&times;</button>
																<h4 class="modal-title">Select Product</h4>
																<div class="input-group">
																	<input type="text" id="searchtxt" name="term" style="width: 400px;" class="form-control" placeholder="Enter Product name" required>
																	<span id="searchmsg" class="text-red" style="margin-left: 10px; font-style: italic;"></span>

																	<input type="hidden" required name="product_id" id="prodId">

																	<input type="hidden" required name="quote_id" value="{{$quote->id}}">

																</div>
															</div>

															
															<div class="modal-body">
																<div class="form-group" >
																	<label for="quantity">Quantity</label>
																	<input type="number" class="form-control"  name="quantity" min="16.50" id="quantity" step=".25" value="16.50" step=".25" required style="width: 80px;">
																</div>
																<div class="form-group" >
																	<label for="unit">Unit</label>
																	<select class="form-control"  name="unit">
																		@foreach($units as $unit)
																		<option value="{{$unit->name_en}}">{{$unit->name_en}}</option>
																		@endforeach	
																	</select>
																</div>
																<div class="form-group" >
																	<label for="price">Price</label>
																	<input type="number"   class="form-control" name="price" id="price" step="any" value="" style="width: 120px;" required>
																</div>
																<div class="form-group" >
																	<label for="currency">Currency</label>
																	<select class="form-control"  name="currency">
																		@foreach($currencies as $currency)
																		<option  value="{{$currency->name_en}}">{{$currency->name_en}}</option>
																		@endforeach	
																	</select>
																</div>
																<div class="control-group">
																	&nbsp;
																</div>

																<div class="form-group" style="display:block;">
																	<label for="title_en">Port of delivery</label>
																	<input type="text" style="display: block;width: 100%" class="form-control" name="port_of_delivery" value="">
																</div>
																<div class="form-group" style="display:block;">
																	<label for="delivery_terms">Delivery Terms</label>
																	<select class="form-control" style="display: block;width: 100%" name="delivery_terms">
																		@foreach($delivery_terms as $delivery_term)
																		<option  value="{{$delivery_term->name_en}}">{{$delivery_term->name_en}}</option>
																		@endforeach	
																	</select>
																</div>
																<div class="form-group" style="display:block;">
																	<label for="delivery_terms">Payment Method</label>
																	<select class="form-control" style="display: block;width: 100%" name="payment_method">
																		@foreach($payment_methods as $payment_method)
																		<option  value="{{$payment_method->name_en}}">{{$payment_method->name_en}}</option>

																		@endforeach	
																	</select>
																</div>
																<div class="form-group" style="display:block;">
																	<div>
																		<h4 style="margin-bottom: 15px;">Shipping Documents</h4>
																		<div class="checkbox checkbox-inline">
																			<input id="invoice" name="invoice" class="styled"  type="checkbox" >
																			<label for="invoice">Invoice</label>
																		</div>
																		<div class="checkbox checkbox-inline">
																			<input id="packing_list" name="packing_list" class="styled"  type="checkbox" >
																			<label for="packing_list">Packing List</label>
																		</div>
																		<div class="checkbox checkbox-inline">
																			<input id="co" name="co" class="styled"  type="checkbox" >
																			<label for="co">CO</label>
																		</div>
																		<div class="checkbox checkbox-inline">
																			<input id="others" name="others" class="styled"  type="checkbox" >
																			<label for="others">Others</label>
																		</div>
																	</div>
																	<div style="display:block;">
																		<label for="others_text">Others</label>
																		<input style="display: block;width: 100%" id="others" name="others_text" value="" class="form-control" type="text"  value="">
																	</div>
																</div>

																<div class="form-group" style="display:block;">
																	<label for="remarks">Remarks</label>
																	<input type="text" style="display: block;width: 100%" class="form-control" name="remarks" id="remarks" value="" >
																</div>
																
															</div>

															<div class="modal-footer">
																<button type="button" class="btn btn-md " data-dismiss="modal">Cancel</button>
																<button type="submit" name="submit" class="btn btn-md btn-primary" value="addProduct">Add</button>
															</div>
														</form>

													</div>
												</div>
											</div>




										</td>
									</tr>
									@endforeach

								</tbody>
								<tfoot>

								</tfoot>
							</table>

							<hr>
							<div class="nav-tabs-custom" style="margin-top: 20px;">
								<ul class="nav nav-tabs">
									<li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-comments-o"></i> Private Messages ({{ count($quote->QuoteComments->where('is_private','=','1')) }})</a></li>
									<li><a href="#tab_2" data-toggle="tab"><i class="fa fa-comments-o"></i> Public Messages ({{ count($quote->QuoteComments->where('is_private','=','0')) }})</a></li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="tab_1">
										<div class="box-body chat" id="chat-box">

											<!-- chat item -->
											@foreach($quote->QuoteComments->where('is_private','=','1') as $quoteComment)
											<div class="item">
												<i class="fa fa-user" style="font-size: 35px; color: #3c8dbc;"></i>

												<p class="message">
													<a href="#" class="name">
														<small class="text-muted pull-right"><i class="fa fa-clock-o"></i> {{date('M j, Y H:i',strtotime($quoteComment->created_at))}}</small>
														{{$quoteComment->User->first_name}} {{$quoteComment->User->last_name}}
													</a>
													{{$quoteComment->comment}}
												</p>
											</div>
											@endforeach
											<!-- /.item -->


										</div>
										<!-- /.chat -->
										<div class="box-footer">
											<form role="form" method="Post" action="{{ route('quote-requests.update',$quote->id) }}" class="single-click-form">
												{{csrf_field()}}
												{{ method_field('PATCH') }}
												<div class="input-group">
													<input class="form-control" required name="comment" placeholder="Type message...">

													<div class="input-group-btn">
														<button type="submit" name="submit" value="addCommentPrvt" class="btn btn-success"><i class="fa fa-plus"></i></button>
													</div>
												</div>
											</form>
										</div>

										

									</div>
									<!-- /.tab-pane -->
									<div class="tab-pane" id="tab_2">
										<div class="box-body chat" id="chat-box">

											<!-- chat item -->
											@foreach($quote->QuoteComments->where('is_private','=','0') as $quoteComment)
											<div class="item">
												<i class="fa fa-user" style="font-size: 35px; color: #3c8dbc;"></i>

												<p class="message">
													<a href="#" class="name">
														<small class="text-muted pull-right"><i class="fa fa-clock-o"></i> {{date('M j, Y H:i',strtotime($quoteComment->created_at))}}</small>
														{{$quoteComment->User->first_name}} {{$quoteComment->User->last_name}}
													</a>
													{{$quoteComment->comment}}
												</p>
											</div>
											@endforeach
											<!-- /.item -->


										</div>
										<!-- /.chat -->
										<div class="box-footer">
											<form role="form" method="Post" action="{{ route('quote-requests.update',$quote->id) }}" 
												class="single-click-form">
												{{csrf_field()}}
												{{ method_field('PATCH') }}
												<div class="input-group">
													<input class="form-control" required name="comment" placeholder="Type message...">

													<div class="input-group-btn">
														<button type="submit" name="submit" value="addCommentPub" class="btn btn-success"><i class="fa fa-plus"></i></button>
													</div>
												</div>
											</form>
										</div>

										

									</div>


									<div class="box-footer">

									</div>
								</div>

							</div>


							

							
							<!-- /.box (chat box) -->
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

		<script src="{{asset('js/parsley.min.js')}}"></script>
		<!-- page script -->
		<script>
			$(function () {
				$('#example2').DataTable({
					"paging": true,
					"lengthChange": false,
					"searching": false,
					"ordering": true,
					"info": true,
					"autoWidth": false
				});

				$("#delbutton").on("click", function(){
					return confirm("Are you sure, you want to delete it?");
				});


				$( "#searchtxt" ).autocomplete({

					source: "{{route('products.search')}}",
					appendTo: "#addProduct",
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
						$('#prodId').val(id);
					},
					change: function (event, ui) {
						if (ui.item == null || ui.item == undefined) {
							$("#searchtxt").val("");
							$('#prodId').val("");
						}
					}
				});


				$("#searchtxt").keyup(function(event){
					if(!this.value){
						$('#searchmsg').empty();


					}
					if(event.keyCode != 13){
						$('#prodId').val('');
					}
					
				});


				$("select[name=delivery_terms]").bind('change', function() {

					if (($(this).val() != 'ExWorks') && ($(this).val() != 'FOB' )) {
						$(this).closest('tr').find("input[name=port_of_delivery]")
						.prop("disabled", false)
						.attr('data-parsley-required', 'true')
						.parsley();
					} else {
						$(this).closest('tr').find("input[name=port_of_delivery]")
						.prop("disabled", true)
						.removeAttr('data-parsley-required');
						$(this).closest('tr').find("input[name=port_of_delivery]").val('');
					}
				});

			});
		</script>
		@endsection