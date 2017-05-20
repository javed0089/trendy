 @extends('layouts.main')

 @if(isset($metatags->{lang_col('meta_title')}))
 @section('title'){{ $metatags->{lang_col('meta_title')} }} @stop
 @endif
 @if(isset($metatags->{lang_col('meta_description')}))
 @section('meta-description'){{ $metatags->{lang_col('meta_description')} }} @stop
 @endif
 
 @section('styles')
 <link href="{{asset('css/parsley.css')}}" rel="stylesheet">
 @endsection

 @section('content')

  <!-- Main Content Section -->
        <main class="main">
           

            <div class="container">
              
                <section class="contact-form">
                    <div class="row form">
                    <div class="spacer-80"></div>
                        <div class="col-md-12">
                            <div class="col-md-6 col-md-offset-3">

                                <h2 class="title-2" style="text-align: center;"> {{__('Login to your account')}} </h2>
                                <form id="contact_form" class="form well-form single-click-form" action="{{route('frontend.login')}}" method="post"  data-parsley-validate>
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
                                        <input name="email" placeholder="{{__('Email Address')}}" class="form-control" type="email" required data-parsley-required-message="Please enter your email address">
                                    </div>
                                    <!-- Password-->
                                    <div class="form-group">
                                        <input name="password" placeholder="{{__('Password')}}" class="form-control" type="password" required minlength="6" data-parsley-required-message="Please enter your password" >
                                    </div>
                                    <a href="{{route('frontend.forgot-password')}}">{{__('Forgot password')}}?</a>
                                    <div class="pull-right">
                                        <label><input name="rememberMe" style="margin-top: .5px;" type="checkbox"> {{__('Remeber me')}}</label>
                                    </div>
                                    
                                    <!-- Button -->
                                    <button type="submit" class="btn btn-block btn-warning" id="js-contact-btn"> {{__('LOGIN')}} </button>
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
<!-- parsley JS -->
<script src="{{asset('js/parsley.min.js')}}"></script>
@if(LaravelLocalization::getCurrentLocale()=='ar')
    <script src="{{asset('js/parsley/ar.js')}}"></script>
    @endif
@endsection