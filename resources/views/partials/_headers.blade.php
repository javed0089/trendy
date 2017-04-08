 <!-- Basic Page Needs -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="GAP - Polymers">
    <meta name="author" content="">

    <!-- Page Title -->
    <title> @yield('title') : GAP-Polymers </title>

    <!-- Favicon 
    <link rel="icon" type="image/png" href="favicon.png">-->
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap core CSS -->
    @if(LaravelLocalization::getCurrentLocale()=='ar')
        <link href="{{asset('css/bootstrap-rtl.min.css')}}" rel="stylesheet">
    @else
        <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    @endif


    <!-- Font Awesome CSS
    <link rel="stylesheet" href="fonts/font-awesome/css/font-awesome.min.css">-->
    <link href="https://fonts.googleapis.com/css?family=Oswald:300,400" rel="stylesheet">

    <!-- Flex Slider -->
    <link rel="stylesheet" href="{{asset('css/flexslider.css')}}">

       <!-- Owl Carousel -->
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.theme.min.css')}}">

    <!-- Custom styles for this template -->
    @if(LaravelLocalization::getCurrentLocale()=='ar')
        <link href="{{asset('css/style-rtl.css')}}" rel="stylesheet">
    @else
        <link href="{{asset('css/style.css')}}" rel="stylesheet">
    @endif
    <link href="{{asset('css/build.css')}}" rel="stylesheet">
   
    <script type="text/javascript">
        function init() {
            var hasActive = $('#menu-item-1505').children('.sub-menu')
            .children('li')
            .filter('.current-menu-item')
            .length;
            if (!hasActive) {
                $('#menu-item-2987').addClass('current-menu-item');
            }



/* ---------------------------------------------------------------------
        Mobile Menu Toggle
        ------------------------------------------------------------------------ */
        $('.menu-toggle').click( function() {
            $('.menu-toggle, .nav--main, #masthead').toggleClass('active');
        });


/* ---------------------------------------------------------------------
        Mobile - Main Nav Toggles
        ------------------------------------------------------------------------ */
       /* $('.nav--primary').after('<span class="main-menu-toggle icon-menu desk--hide"></span>');

        $('.main-menu-toggle').click( function() {
            $('.nav--primary').toggleClass('active');
        });*/

       $('.navbar-toggle').click( function() {
        $('.nav--primary').toggleClass('active');
    });


       /* ---------------------------------------------------------------------
        Mobile - Subnav Menu Toggles
        ------------------------------------------------------------------------ */
        $('.nav--primary li.menu-item-has-children > a, .nav--primary li.menu-item-type-custom > a, .menu--tools .menu li.menu-item-has-children > a, .industry-menu > ul > li.menu-item-has-children > a').after('<span class="sub-menu-toggle icon-arrow-down desk--hide hidden-sm hidden-md hidden-lg"></span>');


        $('.sub-menu-toggle').click( function() {
            var $this = $(this),
            $parent = $this.parent("li"),
            $wrap = $parent.children(".sub-menu");
            $wrap.toggleClass("toggled");
            $parent.toggleClass("toggled");
            $this.toggleClass("toggled");
        });
    }



    window.onload = init;
    </script>