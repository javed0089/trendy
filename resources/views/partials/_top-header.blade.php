<div class="row logo-top-info">
  <div class="container">
    <div class="col-md-3 logo">
      <!-- Main Logo -->
      <a href="/"><img src="{{asset('images/logo.png')}}" alt="Gap-Polymers Logo" /></a>
    </div>
    <div class="col-md-9 top-info-social">
      <div class="pull-right">
        <div class="top-info">
          <div class="call">
            <h3> {{$header_blocks->get(0)->{lang_col('title')} }}</h3>
            <p> {{$header_blocks->get(0)->{lang_col('value')} }} </p>
          </div>
          <div class="email">
            <h3> {{$header_blocks->get(1)->{lang_col('title')} }} </h3>
            <p> {{$header_blocks->get(1)->{lang_col('value')} }} </p>
          </div>
          <div class="market">
                        <!--<h3> {{$header_blocks->get(2)->{lang_col('title')} }} </h3>
                        <p> {{$header_blocks->get(2)->{lang_col('value')} }} </p>
                      -->
                      <ul class="center-block login-links" >
                       @if(Sentinel::check())
                       <li class="dropdown" style="margin-top: 10px;">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> {{Sentinel::getUser()->first_name}} {{Sentinel::getUser()->last_name}} <span class="caret"></span></a>
                        <ul class="dropdown-menu" style="margin-top: 0">
                          <li><a href="{{route('user.show',User::getId())}}">{{__('My Account')}}</a></li>
                          <li><a href="{{route('quotes.index')}}">{{__('My Quote Requests')}}</a></li>
                          <li><a href="{{route('myorders.index')}}">{{__('My Orders')}}</a></li>
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
                     
                     <li><a href="{{ route('frontend.login')}}"><i class="fa fa-sign-in" aria-hidden="true"></i> {{__('Login')}}</a></li>
                     @endif

                   </ul>
                   

                 </div>

               </div>
               <div class="social">
               <div style="height: 50px">
                <ul class="social-icons pull-right">
                  <li><a target="_blank" href="{{$social_blocks->get(0)->{lang_col('value')} }}"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                  <li><a target="_blank" href="{{$social_blocks->get(1)->{lang_col('value')} }}"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                  <li><a target="_blank" href="{{$social_blocks->get(2)->{lang_col('value')} }}"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                  <li><a target="_blank" href="{{$social_blocks->get(3)->{lang_col('value')} }}"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                  <li><a target="_blank" href="{{$social_blocks->get(4)->{lang_col('value')} }}"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                </ul>
                </div>
  <div>
                  <a class="center-block text-center" href="{{ route('cart')}}"><i class="fa fa-pencil-square-o fa-lg" aria-hidden="true"></i> {{__('My Quote Request')}} <span class="badge cartCount">{{ Session::has('cart')? count(Session::get('cart')->items):''}}</span></a>
                </div>
              </div> 

            </div>

          </div>

        </div>


      </div>