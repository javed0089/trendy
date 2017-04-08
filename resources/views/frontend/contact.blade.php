 @extends('layouts.main')

 @section('title','Contact')

 @section('styles')
 <link href="{{asset('css/parsley.css')}}" rel="stylesheet">
 <style type="text/css">


.nav-side-menu {
  overflow: auto;
  font-family: verdana;
  font-size: 12px;
  font-weight: 200;
  background-color: #034694;
  position: fixed;
  top: 30px;
  right: 0px;
  width: 350px;
  height: 100%;
  color: #e1ffff;
  z-index: 2000;
}

.nav-side-menu .toggle-btn {
  display: none;
}


@media (max-width: 767px) {
  .nav-side-menu {
    position: relative;
    width: 100%;
    margin-bottom: 10px;
}
.nav-side-menu .toggle-btn {
    display: block;
    cursor: pointer;
    position: absolute;
    right: 10px;
    top: 10px;
    z-index: 10 !important;
    padding: 3px;
    background-color: #ffffff;
    color: #000;
    width: 40px;
    text-align: center;
}

@media (min-width: 767px) {
  .nav-side-menu .menu-list .menu-content {
    display: block;
}


</style>
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
                        <form id="contact_form" class="form well-form" action="{{route('frontend.comment')}}" method="post" data-parsley-validate>

                           {{csrf_field()}}
                           <!-- Text input-->
                           <div class="form-group">
                            <input name="fullname" placeholder="{{__('Full Name')}}" class="form-control" type="text" required title="Please enter your full name">
                        </div>
                        <!-- Email input-->
                        <div class="form-group">
                            <input name="email" placeholder="{{__('Email Address')}}" class="form-control" type="email" required title="Please enter your email address" data-msg-email="Ouch, that doesn't look like an email">
                        </div>

                        <!-- Phone Number-->
                        <div class="form-group">
                            <input name="phone" placeholder="{{__('Phone Number')}}" class="form-control" type="text" data-rule-phoneUS="false" title="Please enter your phone number" data-msg-phoneUS="Ouch, that doesn't look like a valid phone number" required>
                        </div>

                        <!-- Text area -->
                        <div class="form-group">
                            <textarea class="form-control" name="message" placeholder="{{__('Message')}}" required data-rule-minlength="10" data-msg-minlength="Please enter atleast 10 characters" title="Please enter your message"></textarea>
                        </div>
                        <!-- Button -->
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


            <div class="nav-side-menu">

                <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
                <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title" style="background: #ffd013"> 
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" class="collapsed">CONTACT US</a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                        <div class="panel-body" style="background: #f4f5f8">
                                             <form id="contact_form" class="form well-form1" action="{{route('frontend.comment')}}" method="post" data-parsley-validate>

                           {{csrf_field()}}
                           <!-- Text input-->
                           <div class="form-group">
                            <input name="fullname" placeholder="{{__('Full Name')}}" class="form-control" type="text" required title="Please enter your full name">
                        </div>
                        <!-- Email input-->
                        <div class="form-group">
                            <input name="email" placeholder="{{__('Email Address')}}" class="form-control" type="email" required title="Please enter your email address" data-msg-email="Ouch, that doesn't look like an email">
                        </div>

                        <!-- Phone Number-->
                        <div class="form-group">
                            <input name="phone" placeholder="{{__('Phone Number')}}" class="form-control" type="text" data-rule-phoneUS="false" title="Please enter your phone number" data-msg-phoneUS="Ouch, that doesn't look like a valid phone number" required>
                        </div>

                        <!-- Text area -->
                        <div class="form-group">
                            <textarea class="form-control" name="message" placeholder="{{__('Message')}}" required data-rule-minlength="10" data-msg-minlength="Please enter atleast 10 characters" title="Please enter your message"></textarea>
                        </div>
                        <!-- Button -->
                        <button type="submit" class="btn btn-block btn-warning" > {{__('SEND MESSAGE')}} </button>

                        <div id="js-contact-result" data-success-msg="Form submitted successfully." data-error-msg="Oops. Something went wrong."></div>

                    </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"  style="background: #ffd013">
                                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false">MY CART </a> </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse" aria-expanded="false">
                                        <div class="panel-body"  style="background: #f4f5f8">
                                           
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"  style="background: #ffd013">
                                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false">MY QUOTES</a> </h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse" aria-expanded="false">
                                        <div class="panel-body">
                                           
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"  style="background: #ffd013">
                                            <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false">MY ORDERS</a> </h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse" aria-expanded="false">
                                        <div class="panel-body">
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>

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
    <script type="text/javascript">
        $('#sidebar').affix({
          offset: {
          //  top: $('header').height()
      }
  }); 

</script>
@endsection
