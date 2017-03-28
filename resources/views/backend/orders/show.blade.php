@extends('backend.layouts.adminmain')
@section('title','Orders')

@section('styles')
<!-- DataTables -->
<link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap.css')}}">

@endsection

@section('content')

<section class="content-header">
	<h1>
		Order
	</h1>
	
	
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">

			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-table"></i> Order Details</a></li>
					<li><a href="#tab_2" data-toggle="tab"><i class="fa fa-folder"></i> Order Documents ({{ count($order->OrderFiles) }} )</a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="tab_1">

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
						<div class="box-header  with-border" > 
							<div class="col-md-4">
								<h4>Order # : <span >{{$order->id}}</span></h4>
								<h4>Customer : <span >{{$order->User->first_name}} {{$order->User->last_name}}</span></h4>
								<h4>Email : <span >{{$order->User->email}}</span></h4>
								<h4>Status : <span>{{$order->Status->status_en}}</span></h4>
							</div>
							<div class="col-md-4">
								<h4>Dated : <span>{{date('M j, Y',strtotime($order->created_at))}}</span></h4>
								<h4>P.I Status : {!! $order->pi_confirmed?'<span class="label label-success">Confirmed</span>':'<span class="label label-danger">Not Confirmed</span>'!!}</h4>
								<h4>Payment Status : {!! $order->payment_status?'<span class="label label-success">Paid</span>':'<span class="label label-danger">Not Paid</span>'!!}</h4>
							</div>
							<div class="col-md-2 pull-right">

								<form role="form"  method="Post" action="{{ route('orders.update',$order->id) }}">
									{{csrf_field()}}
									{{ method_field('PATCH') }}
									@if(User::isSupervisor())
									<label for="assign_to_id">Assigned to:</label>
									<select name="assign_to_id" class="form-control">
										<option value="">-- None --</option>
										@foreach($users as $user)
										<option {{$order->assign_to_id==$user->id?'Selected':''}} value="{{$user->id}}">{{$user->first_name}} {{$user->last_name}}</option>
										@endforeach
									</select>
									<button type="submit" name="submit" class="btn btn-block btn-primary" value="assignSalesRep">Assign</button>
									@endif
									@if(User::isSalesExecutive())
									<button type="submit" name="submit" class="btn btn-block btn-success" value="orderProcessed">Processed</button>
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
										<th>P.O.D.</th>
										<th>D.T.</th>
										<th>P.M.</th>
										<th>S.D.</th>
									</tr>
								</thead>
								<tbody>

									@foreach($order->OrderProducts()->get() as $item)
									<tr>
										<td>{{$item->product_name}}</td>
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
									</tr>
									@endforeach

								</tbody>
								<tfoot>

								</tfoot>
							</table>


							<div class="box box-success">
								<div class="box-header">
									<i class="fa fa-comments-o"></i>

									<h3 class="box-title">Comments</h3>

									<span class="pull-right text-muted"> {{ count($order->OrderComments) }} comments</span>



								</div>
								<div class="box-body chat" id="chat-box">

									<!-- chat item -->
									@foreach($order->OrderComments as $orderComment)
									<div class="item">
										<i class="fa fa-user" style="font-size: 35px; color: #3c8dbc;"></i>

										<p class="message">
											<a href="#" class="name">
												<small class="text-muted pull-right"><i class="fa fa-clock-o"></i> {{date('M j, Y H:i',strtotime($orderComment->created_at))}}</small>
												{{$orderComment->User->first_name}} {{$orderComment->User->last_name}}
											</a>
											{{$orderComment->comment}}
										</p>
									</div>
									@endforeach
									<!-- /.item -->


								</div>
								<!-- /.chat -->
								<div class="box-footer">
									<form role="form" method="Post" action="{{ route('orders.update',$order->id) }}">
										{{csrf_field()}}
										{{ method_field('PATCH') }}
										<div class="input-group">
											<input class="form-control" name="comment" placeholder="Type message...">

											<div class="input-group-btn">
												<button type="submit" name="submit" value="addComment" class="btn btn-success"><i class="fa fa-plus"></i></button>
											</div>
										</div>
									</form>
								</div>
							</div>
							<!-- /.box (chat box) -->


						</div>
					</div>	

					<div class="tab-pane" id="tab_2">
						<div class="box-header with-border">
							<h3 class="box-title">Order Documents</h3>

						</div>
						<div class="box-body" id="chat-box">
							<div class="col-md-9">
								<table id="example3" class="table table-bordered table-hover">
									<thead>
										<tr>
											<th>Document Type</th>
											<th>File Name</th>
											<th>Uploaded By</th>
											<th>Upload Date</th>
											<th></th>
										</tr>
									</thead>
									<tbody>

										@foreach($order->OrderFiles as $orderFile)
										<tr>
											<td>{{$orderFile->DocumentType->document_type_en}}</td>
											<td>{{$orderFile->original_filename}}</td>
											<td>{{$orderFile->UploadedBy->first_name}} {{$orderFile->UploadedBy->last_name}} - ({{$orderFile->UploadedBy->UserRole($orderFile->user_id)}})</td>
											<td>{{date('M j, Y H:i',strtotime($orderFile->created_at))}}</td>
											<td>
											@if($orderFile->DocumentType->id==3 && !$order->payment_status)
												<form class="form-inline pull-right" role="form"  method="Post"  action="{{route('orders.update',$order->id)}}">
													{{csrf_field()}}
													{{ method_field('PATCH') }}
													<button type="submit" name="submit" value="confirmPi" class="btn btn-sm btn-success">Confirm</button>
												</form>
												@endif

												<a href="{{route('orders.orderfile', [$orderFile->id,$orderFile->original_filename])}}" target="blank" class="btn btn-sm btn-primary">Download</a></td>
											</tr>
											@endforeach

										</tbody>
										<tfoot>

										</tfoot>
									</table>
								</div>

								<div class="col-md-3">
									<div class="callout ">

										<h4>Upload Documents</h4>
										<form role="form"  method="Post" enctype="multipart/form-data" action="{{route('orders.update',$order->id)}}">
											{{csrf_field()}}
											{{ method_field('PATCH') }}
											<div class="form-group">
												<label >Add Document</label>
												<div class="form-group">
													<label for="document_type">Document Type</label>
													<select name="document_type" class="form-control" required>
														<option value="">-- None --</option>
														@foreach($document_types as $document_type)
														<option value="{{$document_type->id}}">{{$document_type->document_type_en}}</option>
														@endforeach
													</select>
												</div>
												<input type="file" id="order_document" name="order_document" required>
											</div>
											<button type="submit" name="submit" value="uploadDocument" class="btn btn-success">Upload</button>
										</form>

									</div>
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

			});

		</script>
		@endsection