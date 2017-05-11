 <header class="main-header">
  <!-- Logo -->
  <a href="{{ url('backoffice/') }}" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><img src="{{asset('images/footer-logo.png')}}" align="GAP"></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><img src="{{asset('images/footer-logo.png')}}" align="GAP"></span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>

    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">

       <li class="dropdown notifications-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
          <i class="fa fa-bell-o"></i>
          <span class="label label-danger">{{count(User::getUser()->notifications)}}</span>
        </a>
        <ul class="dropdown-menu">
          <li class="header">You have {{count(User::getUser()->notifications)}} notifications</li>
          <li>
            <!-- inner menu: contains the actual data -->
            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 200px;"><ul class="menu" style="overflow: hidden; width: 100%; height: 200px;">

<!-- inner menu: contains the actual data -->
          <ul class="menu">
             @foreach (User::getUser()->notifications as $notification) 
             <li>
              <a href="{{route($notification->data['route-name'],$notification->data['Id'])}}"  class="{{$notification->read_at?'':'text-bold'}}">
                <i class="fa fa-pencil-square-o " ></i> {{$notification->data['Title']}}
              </a>
            </li>

            @endforeach


          </ul><div class="slimScrollBar" style="background: rgb(0, 0, 0); width: 3px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 195.122px;"></div><div class="slimScrollRail" style="width: 3px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div></div>
        </li>
        <li class="footer"><a  href="{{route('notifications.index')}}"><strong>View All</strong></a></li>
      </ul>
    </li>

  <!-- User Account: style can be found in dropdown.less -->
  <li class="dropdown user user-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
      <img src="{{route('users.getprofilepicture',Sentinel::check()->id)}}" class="user-image" alt="User Image">
      <span class="hidden-xs">{{Sentinel::getUser()->first_name." ".Sentinel::getUser()->last_name}}</span>
    </a>
    <ul class="dropdown-menu">
      <!-- User image -->
      <li class="user-header">
        <img src="{{route('users.getprofilepicture',Sentinel::check()->id)}}" class="img-circle" alt="User Image">

        <p>
          {{Sentinel::getUser()->first_name." ".Sentinel::getUser()->last_name}} -
          {{Sentinel::getUser()->roles()->first()->name}}

          <small>Member since {{Sentinel::getUser()->created_at}}</small>
        </p>
      </li>
      <!-- Menu Body -->

      <!-- Menu Footer-->
      <li class="user-footer">
        <div class="pull-left">
          <a href="{{route('users.show')}}" class="btn btn-default btn-flat">Profile</a>
        </div>
        <div class="pull-right">
          <form action="/backoffice/logout" method="post" id="logout-form">
            {{csrf_field()}}
            <a href="#" onclick="document.getElementById('logout-form').submit()" class="btn btn-default btn-flat">Logout</a>

          </form>
        </div>
      </li>
    </ul>
  </li>

</ul>
</div>
</nav>
</header>