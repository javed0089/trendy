@extends('backend.layouts.adminmain')
@section('title','Customer')

@section('content')

<section class="content-header">
<div class="box-header" style="padding: 5px 15px; height: 32px; "> 
	<h1 class="box-title" style="line-height: 25px;" >
		Customer
	</h1>
</div>
</section>

<!-- Main content -->
<section class="content">
	@if ($message = Session::get('success'))
	<div class="alert alert-success alert-block">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<strong>{{ $message }}</strong>
	</div>
	@endif

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



	<div class="col-md-12">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-table"></i> Information</a></li>
				<li><a href="#tab_2" data-toggle="tab"><i class="fa fa-table"></i> Quotes</a></li>
				<li><a href="#tab_3" data-toggle="tab"><i class="fa fa-table"></i> Orders</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab_1">
					<div class="box-header with-border">
						<h3 class="box-title">{{$customer->first_name}} {{$customer->last_name}}</h3>
					</div>
					<div class="box-body">
						<div class="col-md-9 callout">
							<h4>Email</h4>	
							<p>{{$customer->email}}</p>
							<h4>Company</h4>	
							<p>{{$customer->company}}</p>

							<h4>Address</h4>	
							<p>{{$customer->address}}</p>
							<h4>City</h4>	
							<p>{{$customer->city}}</p>
							<h4>Country</h4>	
							<p>{{$customer->country}}</p>
							<h4>Telephone</h4>	
							<p>{{$customer->telephone}}</p>
							<h4>Website</h4>	
							<p>{{$customer->website}}</p>
						</div>
						<div class="col-md-3">
							<div class="callout ">
								<h4>Registered IP Address</h4>
				                <p>{{$customer->ip_address}}</p>
				                <h4>Created</h4>
				                <p>{{date('M j, Y H:i',strtotime($customer->created_at))}}</p>
				                <h4>Last Updated</h4>
				                <p>{{date('M j, Y H:i',strtotime($customer->updated_at))}}</p>
				                <h4>Last Login</h4>
				                <p>{{date('M j, Y H:i',strtotime($customer->last_login))}}</p>
			              </div>
		              </div>
					</div>

				</div>
				<!-- /.tab-pane -->
				<div class="tab-pane" id="tab_2">
					<div class="box-header with-border">
						<h4 class="box-title">Customer Quotes</h4>
					</div>
					<div class="box-body">
								<table id="example2" class="table table-bordered table-hover">
								<thead>
									<tr>
										
										<th>Quote #</th>
										<th>User</th>
										<th>Created</th>
										<th>Assigned To</th>
										<th>Status</th>
										<th width="80"></th>
									</tr>
								</thead>
								<tbody>

									@foreach($customer->Quotes as $quote)
									<tr>
										
										<td>{{$quote->id}}</td>
										<td>{{$quote->User->first_name}} {{$quote->User->last_name}}</td>
										<td>{{ date('M j, Y H:i',strtotime($quote->created_at))}}</td>
										<td>{{isset($quote->AssignedTo)?$quote->AssignedTo->first_name:''}} {{isset($quote->AssignedTo)?$quote->AssignedTo->last_name:''}}</td>
										<td>{{$quote->Status->status_en}}</td>
										<td>
											<a href="{{ route('quote-requests.show',$quote->id) }}" class="btn btn-block btn-default">View</a>
										</td>
									</tr>
									@endforeach

								</tbody>
								<tfoot>

								</tfoot>
							</table>
						
					</div>


				</div>
				
				<!-- /.tab-pane -->
				<div class="tab-pane" id="tab_3">
					<div class="box-header with-border">
						<h4 class="box-title">Customer Orders</h4>
					</div>
					<div class="box-body">
							<table id="example2" class="table table-bordered table-hover">
								<thead>
									<tr>
										
										<th>Order #</th>
										<th>User</th>
										<th>P.I. Status</th>
										<th>Payment</th>
										<th>Created</th>
										<th>Assigned To</th>
										<th>Status</th>
										<th width="80"></th>
									</tr>
								</thead>
								<tbody>

									@foreach($customer->Orders as $order)
									<tr>
										
										<td>{{$order->id}}</td>
										<td>{{$order->User->first_name}} {{$order->User->last_name}}</td>
										<td>
											{!! $order->pi_confirmed?'<span class="label label-success">Confirmed</span>':'<span class="label label-danger">Not Confirmed</span>'!!}
										</td>
										<td>
											{!! $order->payment_status?'<span class="label label-success">Paid</span>':'<span class="label label-danger">Not Paid</span>'!!}
										</td>
										<td>{{ date('M j, Y H:i',strtotime($order->created_at))}}</td>
										<td>{{isset($order->AssignedTo)?$order->AssignedTo->first_name:''}} {{isset($order->AssignedTo)?$order->AssignedTo->last_name:''}}</td>
										<td>{{$order->Status->status_en}}</td>
										<td>
											<a href="{{ route('orders.show',$order->id) }}" class="btn btn-block btn-default">View</a>
										</td>
									</tr>
									@endforeach

								</tbody>
								<tfoot>

								</tfoot>
							</table>
						
					</div>


				</div>
				

				<div class="box-footer">
					
				</div>
			</div>

		</div>
	</div>

</section>
@endsection
