
<div id="wrapper" class="toggled-2">
  <!-- Sidebar -->
  <div id="sidebar-wrapper">
    <div data-spy="affix" data-offset-top="300" class="toggle-button" style="height: 40px; width: 250px; background-color: #034694;  z-index: 3000; display: block; " >

      <a href="#" class="navbar-toggle toggle-button collapse in" data-toggle="collapse" id="menu-toggle-2">  <i class="fa fa-chevron-left"></i> </a>

    </div>
    <div class="sidebar-nav" id="sidebar-container">

      <div class="panel-group" id="sidebar-accordion">

        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a class="collapsed" data-toggle="collapse" data-parent="#sidebar-accordion" href="#cart" aria-expanded="false"><i class="fa fa-pencil-square-o"></i><span class="badge cartCount">{{ Session::has('cart')? count(Session::get('cart')->items):''}}</span> <span> My Quote Request </span>  </a> </h4>
            </div>
            <div id="cart" class="panel-collapse collapse" aria-expanded="false">
              <div class="panel-body">
               <table class="table table-striped"  id="side-cart-table">
                <thead>
                 <tr>
                  <th>Product</th>
                  <th>Qty</th>
                  <th>Units</th>
                </tr>
              </thead>
              <tbody>
              @if($cart)
                @foreach($cart as $item)
                <tr id="{{ $item['item']['id']}}">
                  <td>
                    <strong>{{ $item['item']['name_en']}}</strong>
                  </td>
                  <td>
                    {{ $item['quantity']}}
                  </td>
                  <td>
                    <select disabled name="unit">
                      @foreach($units as $unit)
                      <option {{$item['unit']==$unit->name_en ?'Selected':''}} value="{{$unit->name_en}}">{{$unit->name_en}}</option>
                      @endforeach
                    </select>
                  </td>
                </tr>
                @endforeach
                @endif
              </tbody>
            </table>
            @if(count($cart)<=0)
            <div id="cartNoProducts" class="alert alert-danger">

              No products added
            </div>
            @else
            <div id="updateCart" class="center-block text-center">
              <a class="btn btn-primary btn-sm " href="{{ route('cart')}}">Update Cart</a>
            </div>
            @endif

          </div>
        </div>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h4 class="panel-title" >
            <a class="collapsed" data-toggle="collapse" data-parent="#sidebar-accordion" href="#quotes" aria-expanded="false">
              <i class="fa fa-sticky-note "></i> <span> My Quotes</span></a> </h4>
            </div>
            <div id="quotes" class="panel-collapse collapse" aria-expanded="false">
              <div class="panel-body">
               @if(Sentinel::check())
               <table class="table table-striped">
                <thead>
                 <tr>
                  <th>Quote</th>
                  <th>Dated</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
                @foreach($myquotes as $myquote)
                <tr>
                  <td>
                    <strong><a href="{{route('quotes.show',$myquote->id)}}">{{$myquote->id}}</a> </strong>
                  </td>
                  <td>
                   <a href="{{route('quotes.show',$myquote->id)}}">
                    {{date('M j, Y',strtotime($myquote->created_at))}}</a>
                  </td>
                  <td>
                    <a href="{{route('quotes.show',$myquote->id)}}">
                     {{$myquote->Status->status_en}}</a>
                   </td>
                 </tr>
                 @endforeach
               </tbody>
             </table>  
             @if(count($myquotes)<=0)
             <span>No Quotes</span>
             @else

             <div class="center-block text-center">
              <a class="btn btn-primary btn-sm " href="{{ route('quotes.index')}}">My Quotes</a>
            </div>
            @endif

            @else
            <div class="center-block text-center">
             <div class="alert alert-info">

              You must login first
            </div>

            <a class="btn btn-primary btn-sm " href="{{ route('frontend.login')}}"><i class="fa fa-sign-in" aria-hidden="true"></i> {{__('Login')}}</a>
          </div>


          @endif
        </div>
      </div>
    </div>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title" >
          <a class="collapsed" data-toggle="collapse" data-parent="#sidebar-accordion" href="#orders" aria-expanded="false"><i class="fa fa-truck"></i> <span> My Orders</span></a> </h4>
        </div>
        <div id="orders" class="panel-collapse collapse" aria-expanded="false">
          <div class="panel-body">
           @if(Sentinel::check())
           <table class="table table-striped">
            <thead>
             <tr>
               <th>Order</th>
               <th>Dated</th>
               <th>Status</th>
             </tr>
           </thead>
           <tbody>
            @foreach($orders as $order)
            <tr>
              <td>
                <a href="{{route('myorders.show',$order->id)}}">
                  <strong>{{$order->id}}</strong></a>
                </td>
                <td>
                  <a href="{{route('myorders.show',$order->id)}}">
                    {{date('M j, Y',strtotime($order->created_at))}}
                  </a>
                </td>
                <td>
                  <a href="{{route('myorders.show',$order->id)}}">
                   {{$order->Status->status_en}}
                 </a>
               </td>
             </tr>
             @endforeach
           </tbody>
         </table>  
         @if(count($orders)<=0)
         <span>No orders</span>
         @else

         <div class="center-block text-center">
          <a class="btn btn-primary btn-sm " href="{{ route('myorders.index')}}">My Orders</a>
        </div>
        @endif

        @else
        <div class="center-block text-center">
         <div class="alert alert-info">

          You must login first
        </div>

        <a class="btn btn-primary btn-sm " href="{{ route('frontend.login')}}"><i class="fa fa-sign-in" aria-hidden="true"></i> {{__('Login')}}</a>
      </div>


      @endif
    </div>
  </div>
</div>

<div class="panel panel-default">
  <div class="panel-heading">
    <h4 class="panel-title" >
      <a class="collapsed" data-toggle="collapse" data-parent="#sidebar-accordion" href="#contact" aria-expanded="false"><i class="fa fa-envelope"></i> <span> Contact Us</span></a> </h4>
    </div>
    <div id="contact" class="panel-collapse collapse" aria-expanded="false">
      <div class="panel-body">
        <form id="contact_form" class="form well-form1" action="{{route('frontend.comment')}}" method="post" data-parsley-validate>

         {{csrf_field()}}

         <div class="form-group">
          <input name="fullname" placeholder="{{__('Full Name')}}" class="form-control" type="text" required title="Please enter your full name">
        </div>

        <div class="form-group">
          <input name="email" placeholder="{{__('Email Address')}}" class="form-control" type="email" required title="Please enter your email address" data-msg-email="Ouch, that doesn't look like an email">
        </div>


        <div class="form-group">
          <input name="phone" placeholder="{{__('Phone Number')}}" class="form-control" type="text" data-rule-phoneUS="false" title="Please enter your phone number" data-msg-phoneUS="Ouch, that doesn't look like a valid phone number" required>
        </div>


        <div class="form-group">
          <textarea class="form-control" name="message" placeholder="{{__('Message')}}" required data-rule-minlength="10" data-msg-minlength="Please enter atleast 10 characters" title="Please enter your message"></textarea>
        </div>

        <button type="submit" class="btn btn-sm center-block btn-warning" > {{__('SEND MESSAGE')}} </button>

        <div id="js-contact-result" data-success-msg="Form submitted successfully." data-error-msg="Oops. Something went wrong."></div>

      </form>
    </div>
  </div>
</div>

</div>

</div>

</div>
</div>

                <!-- /#sidebar-wrapper -->