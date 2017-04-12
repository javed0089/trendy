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
        
       
      
        <!-- User Account: style can be found in dropdown.less -->
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="{{asset('backend/dist/img/general-user.png')}}" class="user-image" alt="User Image">
            <span class="hidden-xs">{{Sentinel::getUser()->first_name." ".Sentinel::getUser()->last_name}}</span>
          </a>
          <ul class="dropdown-menu">
            <!-- User image -->
            <li class="user-header">
              <img src="{{asset('backend/dist/img/general-user.png')}}" class="img-circle" alt="User Image">

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