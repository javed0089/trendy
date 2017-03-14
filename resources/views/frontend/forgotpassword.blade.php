 @extends('layouts.main')

 @section('title','Forgot password')


 @section('content')

  <!-- Main Content Section -->
        <main class="main">
            <!-- Page Title -->
            @if(isset($topImage))
                @if($topImage->page->status)
                    <div class="page-title text-center" style="background: url({{isset($topImage->{lang_col('image')})?asset($topImage->{lang_col('image')}):'http://placehold.it/1600x268'}});">
                        <h2 class="title"> {{isset($topImage->{lang_col('title')})?$topImage->{lang_col('title')}:''}} </h2>
                        <p class="description light"> {!!isset($topImage->{lang_col('content')})?$topImage->{lang_col('content')}:''!!} </p>
                    </div>
                @endif
            @endif
            <!-- Page Title -->
            <!-- Breadcrumbs -->
            <div class="breadcrumbs">
                <div class="container">
                    <span class="parent"> <i class="fa fa-home"></i> <a href="/"> {{__('Home')}} </a> </span>
                    <i class="fa fa-chevron-right"></i>
                    <span class="child"> {{__('Fogot Password')}} </span>
                </div>
            </div>
            <!-- Breadcrumbs -->

            <div class="container">
              
                <section class="contact-form">
                    <div class="row form">
                    <div class="spacer-80"></div>
                        <div class="col-md-12">
                            <div class="col-md-6 col-md-offset-3">

                                <h2 class="title-2" style="text-align: center;"> {{__('Please enter the email.')}} </h2>
                                <form id="contact_form" class="form well-form" action="{{ route('forgot-password') }}" method="post">
                                   {{csrf_field()}}
          
                                      @if(session('error'))
                                        <div class="alert alert-danger">
                                  
                                          {{session('error')}}
                                       
                                        </div>
                                      @endif
                                       @if(session('success'))
                                        <div class="alert alert-success">
                                  
                                          {{session('success')}}
                                       
                                        </div>
                                      @endif
                                   
                                    <!-- Email input-->
                                    <div class="form-group">
                                        <input name="email" placeholder="{{__('Email Address')}}" class="form-control" type="email" required title="Please enter your email address">
                                    </div>

                                    <!-- Button -->
                                    <button type="submit" class="btn btn-block btn-warning" id="js-contact-btn"> {{__('Send Code')}} </button>
                                    <div class="spacer-30"> </div>
                                </form>
                            </div>
                        </div>
                     
                    </div>

                </section>
            </div>
        </main>
        <!-- Main Content Section -->
    

@endsection


@section('scripts')
 

@endsection
