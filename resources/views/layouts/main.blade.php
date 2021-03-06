<!DOCTYPE html>
<html{!! LaravelLocalization::getCurrentLocale()=='ar'?' dir="rtl" lang="ar"':''!!}>

<head>

   <!-- header Section -->
   @include('partials._headers')
   @yield('styles')
   <!-- header Section -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-89050646-1', 'auto');
  ga('send', 'pageview');

</script>
</head>

<body  {!! LaravelLocalization::getCurrentLocale()=='ar'?' dir="rtl" lang="ar"':''!!} class="homepage">

    <!-- Preloader -->
    @include('partials._preloader')
    <!-- Preloader -->
    
    <!-- Page Wrapper -->
    <div class="wrapper">

        <!-- Header Section -->
        @include('partials._top-header-nav')
        <!-- Header Section -->

        <!-- Main Content Section -->
        <main class="main">
            
            @yield('content')
        </main>
        <!-- Main Content Section -->
        <!-- Footer Section -->
        @include('partials._footer')
        <!-- Footer Section -->


        <!-- back-to-top link -->
        <a href="#0" class="cd-top"> Top </a>
        <!-- back-to-top link -->

       <!-- Side Nav bar -->
        @include('partials._sidenav-bar')
       <!-- Side Nav bar -->

        
    </div>
    <!-- Page Wrapper
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->

    <!-- Scripts Section -->
    @include('partials._scripts')
    <script type="text/javascript">
        
      /*  (function(){
           
            window.setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function(){
                    $(this).remove(); 
                });
            }, 4000);
            
        }());*/
    </script>
    
    <div id="fb-root"></div>

    <script>(function(d, s, id) {

      var js, fjs = d.getElementsByTagName(s)[0];

      if (d.getElementById(id)) return;

      js = d.createElement(s); js.id = id;

      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8";

      fjs.parentNode.insertBefore(js, fjs);

  }(document, 'script', 'facebook-jssdk'));</script>
  @yield('scripts')
  <!-- Scripts Section -->

  
  <!--Live Chat-->
  <script type="text/javascript" async="async" defer="defer" data-cfasync="false" src="https://mylivechat.com/chatinline.aspx?hccid=79205068"></script>
</body>

</html>
