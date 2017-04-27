 @extends('layouts.main')

 @section('title','My Account')
 @section('styles')
 <link href="{{asset('css/parsley.css')}}" rel="stylesheet">
 @endsection
 
 @section('content') 

 <!-- Main Content Section -->
 <main class="main">
 	<div class="container">
 		<div class="spacer-10"></div>
 		<div class="row">
 			<div class="col-md-12">
 				<h2 class="company-title color-title"></h2>
 				<h4 class="hood-subtitle subtitle">Update your quote request</h4>
 				<section class="about-accordion">
 					<div class="row publications">
 						<div class="panel-group" id="accordion">
 							<div class="panel panel-default">
 								<div class="panel-heading">
 									<h4 class="panel-title">
 										<a data-toggle="collapse" data-parent="#accordion" href="#1">1 - Quote Request Details</a>
 									</h4>
 								</div>
 								<div id="1" class="panel-collapse collapse in">
 									<div class="panel-body">
 										<table class="table">
 											<thead>
 												<tr>
 													<th><h3>Products</h3></th>
 													@if ($message = Session::get('success'))
 													<div class="alert alert-success alert-block">
 														<button type="button" class="close" data-dismiss="alert">×</button>
 														<strong>{{ $message }}</strong>
 													</div>
 													@endif
 													@if(session('error'))
 													<div class="alert alert-danger">

 														{{session('error')}}

 													</div>
 													@endif
 												</tr>
 											</thead>
 											<tbody>
 												@if(count($cart)>0)
 												@foreach($cart as $item)
 												<tr>
 													<td style="background: #f4f5f8;">
 														<meta name="csrf-token" content="{{ csrf_token() }}" />
 														<form class="quote-form" role="form"  method="Post" action="{{route('cart.updateCartItem',$item['item']['id'])}}" data-parsley-validate>
 															{{csrf_field()}}
 															<div class="col-md-4">
 																<h4>Product Name</h4>
 																<h4 ><strong>{{$item['item']['name_en']}}</strong></h4>
 															</div>
 															<div class="col-md-4"> 
 																<div class="col-md-6 text-right">
 																	<h4>Quantity</h4>
 																	<input style="width: 60px" type="number" name="quantity" required min="16.5" data-parsley-error-message="Min. value 16.5" step="any" value="{{ $item['quantity']}}" data-parsley-trigger="keyup">
 																</div>
 																<div class="col-md-6">
 																	<h4>Units</h4>
 																	<select name="unit">
 																		@foreach($units as $unit)
 																		<option {{$item['unit']==$unit->name_en ?'Selected':''}} value="{{$unit->name_en}}">{{$unit->name_en}}</option>
 																		@endforeach
 																	</select>

 																</div>
 															</div>
 															<div class="col-md-4">
 																<h4>Port of Delivery</h4>
 																<input class="form-control" type="text" name="port_of_delivery" value="{{ $item['port_of_delivery']}}"  data-parsley-required-message="Required">
 															</div>
 															<div class="spacer-5"></div>
 															<div class="col-md-4">
 																<h4>Delivery Terms</h4>
 																<select class="form-control" name="delivery_terms">
 																	@foreach($delivery_terms as $delivery_term)
 																	<option {{$item['delivery_terms']==$delivery_term->name_en ?'Selected':''}} value="{{$delivery_term->name_en}}">{{$delivery_term->name_en}}</option>
 																	@endforeach	
 																</select>
 															</div>
 															<div class="col-md-4">
 																<h4>Payment Method</h4>
 																<select class="form-control" name="payment_method">
 																	@foreach($payment_methods as $payment_method)
 																	<option {{$item['payment_method']==$payment_method->name_en ?'Selected':''}} value="{{$payment_method->name_en}}">{{$payment_method->name_en}}</option>
 																	
 																	@endforeach	
 																</select>
 															</div>
 															<div class="col-md-4">
 																<div>
 																	<h4 style="margin-bottom: 15px;">Shipping Documents</h4>
 																	<div class="checkbox checkbox-inline">
 																		<input id="invoice{{$loop->iteration}}" name="invoice" class="styled"  type="checkbox" {{$item['invoice']?'checked':''}}>
 																		<label for="invoice{{$loop->iteration}}">Invoice</label>
 																	</div>
 																	<div class="checkbox checkbox-inline">
 																		<input id="packing_list{{$loop->iteration}}" name="packing_list" class="styled"  type="checkbox" {{$item['packing_list']?'checked':''}}>
 																		<label for="packing_list{{$loop->iteration}}">Packing List</label>
 																	</div>
 																	<div class="checkbox checkbox-inline">
 																		<input id="co{{$loop->iteration}}" name="co" class="styled"  type="checkbox" {{$item['co']?'checked':''}}>
 																		<label for="co{{$loop->iteration}}">CO</label>
 																	</div>
 																	<div class="checkbox checkbox-inline">
 																		<input id="others{{$loop->iteration}}" name="others" class="styled"  type="checkbox" {{$item['others']?'checked':''}}>
 																		<label for="others{{$loop->iteration}}">Others</label>
 																	</div>
 																</div>
 																<div>
 																	<input id="others" name="others_text" placeholder="{{__('If others mention')}}" value="{{ $item['others_text']}}" class="form-control" type="text"  value="">
 																</div>
 															</div>

 															<div class="spacer-5"></div>
 															<div class="col-md-12">
 																<div class="col-md-2 pull-right">

 																	<input type="text" hidden value="{{route('cart.removeCartItem',$item['item']['id'])}}" name=""> 
 																	<a  href=""  class="btn btn-danger btn-sm btn-block removeCartItem" >{{__('Remove')}} <img id="loader" class="pull-right" width="35" style="display: none;" src="{{asset('images/ellipsis.gif')}}" alt="loading"></a>
 																</div>
 																<div class="col-md-2 pull-right">
 																	
 																	<button type="submit" name="submit" value="btn-update" class="btn btn-primary btn-sm btn-block updateCartItem" >{{__('Update')}} <img id="loader" class="pull-right" width="35" style="display: none;" src="{{asset('images/ellipsis.gif')}}" alt="loading"></button>

 																</div>
 																<div class="pull-right col-md-3 text-right">
 																	<div id="msg"  style="display: none;" >
 																	</div>
 																</div>
 															</div>

 														</form>

 													</td>
 												</tr>
 												@endforeach  
 												@else
 												<div class="alert alert-danger alert-dismissable">
 													<button type="button" class="close" data-dismiss="alert" aria-hidden="true">

 													</button>
 													Your cart is empty!
 												</div>
 												@endif 

 											</tbody>
 										</table>
 										<a href="{{route('cart.step','1')}}" class="btn btn-success btn-sm pull-right {{count($cart)<=0?'not-active':''}}" {{count($cart)<=0?'disabled':''}} >Continue</a>
 									</div>
 								</div>
 							</div>

@if(!Sentinel::check())
 							<div class="panel panel-default">
 								<div class="panel-heading">
 									<h4 class="panel-title">
 										<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#2">2 - Login/Register </a> </h4>
 									</div>
 									<div id="2" class="panel-collapse collapse">
 										<div class="panel-body">
 											<div class="col-md-4">
 												<div class="panel-div"> 
 													<h4>Register or login</h4>
 													<div class="content">
 														<form action="{{route('cart.step','2')}}" method="post">
 															
 															{{csrf_field()}}
 															<div class="radio">
 																<input type="radio" name="radio1" id="radio1" value="login" checked>
 																<label for="radio1">Login</label>
 															</div>
 															<div class="radio">
 																<input type="radio" name="radio1" id="radio2" value="register">
 																<label for="radio2">Register Account</label>
 															</div>
 														</div>
 													</div>
 												</div>
 												<div class="spacer-10"></div>
 												<button type="submit" id="login-register"  class="btn btn-success btn-sm pull-right">Continue</button>
 											</form>
 										</div>
 									</div>
 								</div>

@endif

 								<div class="panel panel-default">
 									<div class="panel-heading">
 										<h4 class="panel-title">
 											<a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#3">3 - Send Quote Request</a> </h4>
 										</div>
 										<div id="3" class="panel-collapse collapse">
 											<div class="panel-body">

 												<div class="col-md-12 text-center">
 													<a href="{{route('send.quote')}}" class="btn btn-success btn-lg">Send Quote Request</a>
 												</div>
 											</div>
 										</div>
 									</section>

 								</div>


 							</div>

 						</div>
 					</main>
 					<!-- Main Content Section -->
 					@endsection

 					@section('scripts')
 					<script>
 						$(function () {
 							var a= "{{ isset($step)?$step:'1' }}";
 							//$('a[data-toggle]').on('click', function(e) {
 								$('a[data-parent="#accordion"]').on('click', function(e) {

 									var target=$(this).attr('href');
 									var targetid = target.substr(target.length-1);

 									if(targetid>a ){
 										e.stopPropagation();
 									}

 								});

 								if(a == 1){
 									$("#1").collapse("show");
 									$("#2").collapse("hide");
 									$("#3").collapse("hide"); 
 								}
 								else if(a == 2){
 									$("#1").collapse("hide");
 									$("#2").collapse("show");
 									$("#3").collapse("hide"); 
 								}
 								else if(a == 3){
 									$("#1").collapse("hide");
 									$("#2").collapse("hide");
 									$("#3").collapse("show"); 
 								}

 								$('input[name=radio1]').change(function(){
 									var value = $( 'input[name=radio1]:checked' ).val();
 									if(value == "login"){
 										$('#login-register').attr('href',"{{route('frontend.login')}}");
 									}
 									else if(value == "register"){
 										$('#login-register').attr('href',"{{route('frontend.register')}}");
 									}
 								});

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




 					</script>
 					<!-- parsley JS -->
 					<script src="{{asset('js/parsley.min.js')}}"></script>
 					@endsection
