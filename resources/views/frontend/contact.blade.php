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
            <span class="child"> {{__('CONTACT')}} </span>
        </div>
    </div>
    <!-- Breadcrumbs -->

    <div class="container">

        <div class="col-md-12">
            <section class="contact">
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="row contact-centers">
                    @foreach($locations as $location)
                    <div class="col-md-4">
                        <div class="contact-area-box">
                            <h4 class="contact-title subtitle">{{$location->{lang_col('country')} }}</h4>
                            <div class="address">
                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                <p>{!!nl2br($location->{lang_col('address')})!!}</p>
                            </div>
                            <div class="phone">
                                <i class="fa fa-phone" aria-hidden="true"></i>
                                <p>{{$location->telephone}}</p>
                            </div>
                            <div class="phone">
                                <i class="fa fa-fax" aria-hidden="true"></i>
                                <p>{{$location->fax}}</p>
                            </div>
                            <div class="email">
                                <i class="fa fa-envelope" aria-hidden="true"></i>
                                <p><a href="mailto:{{$location->email}}"> {{$location->email}} </a> </p>
                            </div>
                        </div>
                    </div>
                    @endforeach



                </div>
            </section>

            <section class="contact-form">
                <div class="row form">
                    <div class="col-md-6">

                        <h2 class="title-2"> {{__('Send us a message')}} </h2>
                        <form id="contact_form" class="form well-form single-click-form" action="{{route('frontend.comment')}}" method="post" data-parsley-validate>

                           {{csrf_field()}}
                           
                           <div class="form-group">
                            <input name="fullname" placeholder="{{__('Full Name')}}" class="form-control" type="text" required value="{{old('fullname')}}" data-parsley-required-message="Please enter your full name">
                        </div>
                        <!-- Email input-->
                        <div class="form-group">
                            <input name="email" placeholder="{{__('Email Address')}}" class="form-control" type="email" required value="{{old('email')}}" data-parsley-required-message="Please enter your email address" data-parsley-type="email" data-parsley-type-message="Ouch, that doesn't look like an email">
                        </div>

                        <!-- Phone Number-->
                        <div class="form-group">
                            <input name="phone" placeholder="{{__('Phone Number')}}" class="form-control" type="text" required  value="{{old('phone')}}" data-parsley-required-message="Please enter your phone number" data-parsley-pattern-message="Ouch, that doesn't look like a phone number" data-parsley-pattern="^[+]?([0-9]*[\.\s\-\(\)]|[0-9]+){6,24}$" >
                        </div>

                        <!-- Text area -->
                        <div class="form-group">
                            <textarea class="form-control" name="message" required placeholder="{{__('Message')}}"  data-parsley-minlength="10" data-msg-minlength="Please enter atleast 10 characters" data-parsley-maxlength="500" data-parsley-required-message="Please enter your message">{{old('message')}}</textarea>
                        </div>
                        <div class="form-group">
                            {!! captcha_html() !!}
                        </div>
                        <button type="submit" class="btn btn-block btn-warning" > {{__('SEND MESSAGE')}} </button>

                        <div id="js-contact-result" data-success-msg="Form submitted successfully." data-error-msg="Oops. Something went wrong."></div>

                    </form>
                </div>

                <div class="col-md-6 contact-map">
                    <h2 class="title-2"> {{__('View Map')}} </h2>
                    <ul class="nav nav-pills" id="map-address">
                       @foreach($locations as $location)
                       <li>
                        <a href="#" data-latitude="{{$location->latitude}}" data-longitude="{{$location->longitude}}" data-map-title="{{$location->{lang_col('country')} }}" data-map-zoom="11" data-toggle="tab">{{$location->{lang_col('country')} }}</a>
                    </li>
                    @endforeach
                </ul>

                            <!-- Google Map will load programatically inside this div. 
                            You may change the Default Latitude and Longitude here. For multiple locations, change above.  -->

                            <div id="google-map" class="google-map" data-latitude="{{count($locations)?$locations->first()->latitude:''}}" data-longitude="{{count($locations)?$location->first()->longitude:''}}" data-map-title="{{count($locations)?$location->first()->{lang_col('country')}:''}}" data-map-zoom="11">
                            </div>

                        </div>
                    </div>

                </section>

            </div>

            
        </div>


    </main>

    <!-- Main Content Section -->
    @endsection


    @section('scripts')
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBLdy2cd1qkrTkZdcG9TV9SOgGHSexFiEM"></script>
    <!--  Map Functions -->
    <script src="{{asset('js/maps.js')}}"></script>
    <!-- parsley JS -->
    <script src="{{asset('js/parsley.min.js')}}"></script>
    @if(LaravelLocalization::getCurrentLocale()=='ar')
    <script src="{{asset('js/parsley/ar.js')}}"></script>
    @endif

    @endsection
