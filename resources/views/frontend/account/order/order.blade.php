 @extends('layouts.main')

 @section('title','My Order')

 @section('styles')
 <link rel="stylesheet" href="{{asset('backend/dist/css/vertical-tab.css')}}">
 <link href="{{asset('css/starrr.css')}}" rel="stylesheet">
 @endsection

 @section('content') 

 <!-- Main Content Section -->
 <main class="main">



  <div class="container">

    <div class="row about-sidebar">
      <div class="spacer-40"></div>
      <div class="col-md-10 about-content">
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
        <div class="panel-div">
          <div class="panel-title">Order #: {{$order->id}}</div>
          <div class="content">
            <div class="row">

              <div class="col-md-4">
                <h4>Order # : <span >{{$order->id}}</span></h4>
                <h4>Status : <span>{{$order->Status->status_en}}</span></h4>

              </div>
              <div class="col-md-4">
                <h4>Dated : <span>{{date('M j, Y',strtotime($order->created_at))}}</span></h4>



              </div>
              <div class="col-md-4 text-right">
                <h4>P. I. Status : {!!$order->pi_confirmed?'<span class="success small">Confirmed</span>' : '<span class="danger small">Not Confirmed</span>'!!} </h4>
                <h4 >Payment Status : {!!$order->payment_status?'<span class="success small">Paid</span>' : '<span class="danger small">Not Paid</span>'!!} </h4>
              </div>
            </div>

          </div>


          <table class="table table-striped">
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
              <th>Sub Total</th>


            </tr>
          </thead>
          <tbody>
            @foreach($order->OrderProducts as $product)
            <tr>
              <td>{{$product->product_name}}</td>
              <td>{{$product->quantity}}</td>
              <td>{{$product->unit}}</td>
              <td>{{number_format($product->price)}}</td>
              <td>{{$product->currency}}</td>
              <td>{{$product->port_of_delivery}}</td>
              <td>{{$product->delivery_terms}}</td>
              <td>{{$product->payment_method}}</td>
              <td>
                {{$product->shipping_doc_invoice=='1'?'Invoice,':''}}
                {{$product->shipping_doc_packing_list=='1'?'Packing List,':''}}
                {{$product->shipping_doc_co=='1'?'CO,':''}}
                {{$product->shipping_doc_others=='1'?'Others,':''}}
                {{$product->shipping_doc_others_text}}

              </td>
              <td>{{number_format($product->quantity * $product->price,2)}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>


        <div class="col-md-4 pull-right text-right">
          <div class="spacer-10"></div>
          <h3>Grand Total: {{number_format($total,2)}}</h3>
        </div>
      </div>

      <div class="spacer-30"></div>

      <div class="panel-div">
        <div class="panel-title">Order Documents
          <span class="pull-right small">{{count($order->OrderFiles)}} document(s)</span>
        </div>
        <div class="content">
          <div class="row">

            <div class="col-md-12">
              <form class="form-inline pull-right" role="form"  method="Post" enctype="multipart/form-data" action="{{route('myorders.update',$order->id)}}">
                {{csrf_field()}}
                {{ method_field('PATCH') }}
                <label class="mr-sm-2" for="inlineFormCustomSelect">Document Type</label>
                <select name="document_type" class="custom-select mb-2 mr-sm-2 mb-sm-0" required>
                  <option value="">-- None --</option>
                  @foreach($document_types as $document_type)
                  <option value="{{$document_type->id}}">{{$document_type->document_type_en}}</option>
                  @endforeach
                </select>
                <label class="mr-sm-2" for="inlineFormCustomSelect">
                 <input type="file" id="order_document" name="order_document" required>
               </label>
               <br>
               <button type="submit" name="submit" value="uploadDocument" class="btn btn-sm btn-default pull-right">Upload</button>
             </form>
             <div class="spacer-10"></div>
             <table class="table table-striped">
              <thead>

               <tr>
                <th>Document Type</th>
                <th>Uploaded By</th>
                <th>Upload Date</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($order->OrderFiles as $orderFile)
              <tr>
                <td>{{$orderFile->DocumentType->document_type_en}}</td>
                <td>{{$orderFile->UploadedBy->first_name}} {{$orderFile->UploadedBy->last_name}} 
                  @if($orderFile->UploadedBy->UserRole($orderFile->user_id)!='Subscriber')
                  - ({{$orderFile->UploadedBy->UserRole($orderFile->user_id)}})
                  @endif
                </td>
                <td>{{date('M j, Y H:i',strtotime($orderFile->created_at))}}</td>
                <td>
                  @if($orderFile->DocumentType->id==1 && !$order->pi_confirmed)
                  <form class="form-inline pull-right" role="form"  method="Post"  action="{{route('myorders.update',$order->id)}}">
                    {{csrf_field()}}
                    {{ method_field('PATCH') }}
                    <button type="submit" name="submit" value="confirmPi" class="btn btn-xs btn-success">Confirm</button>
                  </form>
                  @endif
                  <a href="{{route('myorders.orderfile', [$orderFile->id,$orderFile->original_filename])}}" target="blank" class="btn btn-xs btn-primary">Download</a></td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>


    <!--Shipping-->

    <div class="panel-div">
      <div class="panel-title">Track your order (Shipment)

      </div>
      <div class="content">
        <div class="row">

         <div class="col-md-12">
          <div class="col-xs-3"> 
            <ul class="nav nav-tabs tabs-left">
              @foreach($order->OrderShipments as $OrderShipment)
              <li  {{{ $loop->first? 'class=active' : '' }}} ><a href="#{{$OrderShipment->id}}tab" data-toggle="tab"><i style="color:{{{$OrderShipment->order_shipment_status_id == '4'?($order->bl_draft_confirmed?'green':'red'):'green'}}} " class="fa fa-check-circle"></i> {{$OrderShipment->OrderShipmentStatus->shipping_status_en}}
                <span class="pull-right small text-muted">{{count($OrderShipment->OrderShipmentFiles)}}</span>
              </a></li>
              @endforeach

            </ul>
          </div>
          <div class="col-xs-9">
            <div class="tab-content">



              @foreach($order->OrderShipments as $OrderShipment)
              <div class="tab-pane {{{ $loop->first? 'active' : '' }}}" id="{{$OrderShipment->id}}tab">
                <div class="col-xs-12">
                  <div class="row">
                    <div class="col-xs-6">
                      <h4>Status: <span>{{$OrderShipment->OrderShipmentStatus->shipping_status_en}} </span></h4>
                      <h4>Dated: <span>{{date('M j, Y H:i',strtotime($OrderShipment->created_at))}}</span></h4>
                    </div>
                    <div class="col-xs-6">
                      @if($OrderShipment->order_shipment_status_id == 4)
                      <h4>BL Status : {!! $order->bl_draft_confirmed?'<span class="label label-success">Confirmed</span>':'<span class="label label-danger">Not Confirmed</span>'!!}</h4>
                      @endif

                      @if(isset($order->shipping_tracking_id) || isset($order->shipping_tracking_hyperlink))

                      <h4>Tracking ID: {{$order->shipping_tracking_id}}</h4>
                      <h4>Tracking link:  <a href="{{$order->shipping_tracking_hyperlink}}" target="_blank">Click here</a>  </h4>


                      @endif
                    </div>
                  </div>
                  @if($OrderShipment->order_shipment_status_id != 3)
                  <h4>Files</h4>
                  <table class="table table-striped">
                    <thead>
                     <tr>
                      <th>Filename</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                   @foreach($OrderShipment->OrderShipmentFiles as $OrderShipmentFile)
                   <tr>
                     <td>

                      {{$OrderShipmentFile->original_filename}}
                    </td>
                    <td>
                     @if($OrderShipment->order_shipment_status_id == 4 && !$order->bl_draft_confirmed)
                     <form class="form-inline pull-right" role="form"  method="Post"  action="{{route('myorders.update',$order->id)}}">
                      {{csrf_field()}}
                      {{ method_field('PATCH') }}
                      <button type="submit" name="submit" value="confirmBl" class="btn btn-xs btn-success">Confirm</button>
                    </form>
                    @endif
                    <a target="_blank" class="btn btn-primary btn-xs" href="{{route('myorders.orderShipmentfile',[$OrderShipmentFile->id,$OrderShipmentFile->original_filename])}}">Download</a></td>
                  </tr>

                  @endforeach
                </tbody>
              </table>

              <div class="spacer-30"></div>



              @foreach($OrderShipment->OrderShipmentFiles as $OrderShipmentFile)
              @if(substr($OrderShipmentFile->mime,0,5) == 'image')
              @if($loop->first)
              <div class="service-slider"  style="direction: ltr;">
               <div class="flex-viewport" style="overflow: hidden; position: relative;">
                <ul class="slides" style="width: 800%; transition-duration: 0s; transform: translate3d(-1110px, 0px, 0px);">
                  @endif


                  <li class="clone" aria-hidden="true" style="width: 555px; margin-right: 0px; float: left; display: block;">
                    <img src="{{route('myorders.orderShipmentfile',[$OrderShipmentFile->id,$OrderShipmentFile->original_filename])}}" alt="" draggable="false">
                    <div class="slider-caption">
                      <p> {{$OrderShipmentFile->original_filename }}  </p>
                    </div>
                  </li>
                  @if($loop->last)

                </ul>
              </div>
              <ul class="flex-direction-nav">
                <li class="flex-nav-prev"><a class="flex-prev" href="#">{{__('Previous')}}</a></li>
                <li class="flex-nav-next"><a class="flex-next" href="#">{{__('Next')}}</a></li>
              </ul>
            </div>
            @endif
            @endif
            @endforeach

            @endif

          </div>
        </div>
        @endforeach
      </div>
    </div>

  </div>

</div>
</div>
</div>

<!--Shipping Ends -->



<div class="comments1">
  <h3 class="title-2 text-center"> {{count($order->OrderComments->where('is_private','==','0'))}} Message(s)</h3>
  <div class="message-box" >
    @foreach($order->OrderComments->sortByDesc('created_at')->where('is_private','==','0') as $orderComment)
    <div class="{{$orderComment->User->UserRole($orderComment->User->id) == 'Subscriber'?'message1':'message2'}}">
      <i class="fa fa-user-circle" ></i>
      <h3>{{$orderComment->User->first_name}} {{$orderComment->User->last_name}} <span {{$orderComment->User->UserRole($orderComment->User->id) == 'Subscriber'?'dir="rtl"':''}}>{{date('M j, Y H:i',strtotime($orderComment->created_at))}}</span> </h3>

      <p>{{$orderComment->comment}}</p>
    </div>

    @endforeach
  </div>

</div>
<div class="col-md-12 text-center">
 <form  role="form"  method="Post"  action="{{route('rating.update',$order->id)}}">
  {{csrf_field()}}
  {{ method_field('PATCH') }}
  <h4>Rate our Service</h4>
  <div id='star' class="star"></div>
  <input id="rating" hidden type="text" value="{{count($rating)>0? $rating->rating:''}}"  name="rating" >
  <div class="spacer-20"></div>
  <div class="col-md-4 col-md-offset-4">
    <button type="submit" class="btn btn-md btn-block btn-primary">RATE</button>
  </div>
</form>
</div>
<div class="spacer-10"></div>
<div class="comment-box">
  <h2 class="title-2 text-center"> New Message </h2>

  <form action="{{route('myorders.update',$order->id)}}" method="POST"  class="commentform">
    {{csrf_field()}}
    {{ method_field('PATCH') }}
    <div class='row'>
      <div id="comment-message" class="col-md-12">
        <textarea id="comment" class="form-control" name="comment" placeholder="Message" required></textarea>
      </div>
      <div class="comment-btn col-md-12">
        <button type="submit" name="submit" value="addComment" class="btn btn-block btn-warning"> Send Message </button>
      </div>
    </div>
  </form>

</div>

</div>
<div class="col-md-2 sidebar left" style="padding:0;">
  <div class="sidebar-blog-categories">
    @include('partials._acct-sidebar')
  </div>

</div>

</div>

</div>
</main>
<!-- Main Content Section -->





@endsection
@section('scripts')
<script src="{{asset('js/stars.min.js')}}"></script>
<script type="text/javascript">

 $('#star').stars({
  stars: 4,
  value:$('#rating').val(),
  text: ['Poor', 'Average', 'Good','Excellent'],
  color: '#ffda44',
  starClass  : 'star',
  click: function(index) {
    $('#rating').val(index);
  }
});
</script>
@endsection
