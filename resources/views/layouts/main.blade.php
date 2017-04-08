<!DOCTYPE html>
<html{!! LaravelLocalization::getCurrentLocale()=='ar'?' dir="rtl" lang="ar"':''!!}>

<head>

 <!-- header Section -->
 @include('partials._headers')
 @yield('styles')
 <!-- header Section -->

</head>

<body style="padding-top: 25px;" {!! LaravelLocalization::getCurrentLocale()=='ar'?' dir="rtl" lang="ar"':''!!} class="homepage">

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
        
    </div>
    <!-- Page Wrapper
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->

    <!-- Scripts Section -->
    @include('partials._scripts')
    <script type="text/javascript">
        
        (function(){
         
            window.setTimeout(function() {
                $(".alert").fadeTo(500, 0).slideUp(500, function(){
                    $(this).remove(); 
                });
            }, 4000);
            
        }());
    </script>

    @yield('scripts')
    <!-- Scripts Section -->

    
</body>

</html>
