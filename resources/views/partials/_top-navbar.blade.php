<nav class="navbar navbar-default  navbar-fixed-top  visible-md visible-lg">
  <div class="container">
   

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      
    <ul class="nav navbar-nav">
       
        <li><a rel="alternate" hreflang="en" href="{{LaravelLocalization::getLocalizedURL('en') }}">English</a></li>
        <li class="divider-vertical"></li>
        <li><a rel="alternate" hreflang="ar" href="{{LaravelLocalization::getLocalizedURL('ar') }}">العربية</a></li>
       
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="{{ route('cart')}}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> {{__('Cart')}} <span class="badge">{{ Session::has('cart')? count(Session::get('cart')->items):''}}</span></a></li>
         <li class="divider-vertical"></li>
        @if(Sentinel::check())
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{Sentinel::getUser()->first_name}} {{Sentinel::getUser()->last_name}} <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="{{route('frontend.myaccount')}}">My Account</a></li>
              <li><a href="{{route('quotes.index')}}">My Quote Requests</a></li>
              <li><a href="#">My Orders</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="#" onclick="document.getElementById('logout-form').submit()" >{{__('Logout')}}</a>
              </li>
            </ul>
            <form action="{{route('frontend.logout')}}" method="post" id="logout-form">
                       {{csrf_field()}}
            </form>
          </li>
         @else
           <li><a href="{{ route('frontend.register')}}"><i class="fa fa-user-plus" aria-hidden="true"></i> {{__('Register')}}</a></li> 
           <li class="divider-vertical"></li>
           <li><a href="{{ route('frontend.login')}}"><i class="fa fa-sign-in" aria-hidden="true"></i> {{__('Login')}}</a></li>
          @endif

      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>