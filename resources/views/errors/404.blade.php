 @extends('layouts.main')

 @if(isset($metatags->{lang_col('meta_title')}))
 @section('title'){{ $metatags->{lang_col('meta_title')} }} @stop
 @endif
 @if(isset($metatags->{lang_col('meta_description')}))
 @section('meta-description'){{ $metatags->{lang_col('meta_description')} }} @stop
 @endif


 @section('content') 

  <!-- Main Content Section -->
        <main class="main">
            <!-- Page Title -->
           
                    <div class="page-title text-center" style="background: url({{asset('images/banner-1.jpg')}}">
                        <h2 class="title"> 404 - Error </h2>
                    </div>
              
            <!-- Page Title -->
            <!-- Breadcrumbs -->
            <div class="breadcrumbs">
                <div class="container">
                    <span class="parent"> <i class="fa fa-home"></i> <a href="/"> {{__('Home')}} </a> </span>
                    <i class="fa fa-chevron-right"></i>
                    <span class="child"> {{__('WHO WE ARE')}} </span>
                </div>
            </div>

         <!-- Content Section -->
            <section class="page-not-found">
                <div class="container">
                    <div class="row error-page">
                        <div class="col-md-12 text-center">
                            <h1>404</h1>
                            <h2>Oops! That page can&rsquo;t be found</h2>
                            <h4>Sorry, but the page you are looking for does not exist</h4>
                            <a href="index.html" class="btn btn-default"> BACK TO HOME PAGE </a>
                        </div>
                    </div>

                </div>
            </section>
            <!-- Content Section -->
        </main>
        <!-- Main Content Section -->

   

    

@endsection
