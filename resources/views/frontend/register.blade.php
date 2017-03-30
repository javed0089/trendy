 @extends('layouts.main')

 @section('title','Register')


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
            <span class="parent"> <i class="fa fa-home"></i> <a href="index.html"> {{__('Home')}} </a> </span>
            <i class="fa fa-chevron-right"></i>
            <span class="child"> {{__('REGISTER')}}</span>
        </div>
    </div>

    <div class="container">



        <div class="spacer-40"></div>
        <div class="row text-center"> 
            <h2 class="title-2"> {{__('Create your Account')}}  </h2>
            <div class="spacer-40"></div>
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                {{__('There were some problems while registering your account.')}}<br><br>
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
        </div>
        <div class="spacer-40"></div>
        <section class="contact-form">
            <div class="row form styled-list">
                @if(isset($benefits))
                @if(count($benefits))
                @if($benefits->first()->page->status)
                <div class="col-md-5">

                    <h3 class="title-2"> {{__('Registering with us will allow you to:')}}   </h3>

                    <div class="spacer-20"></div>
                    <ol class="list-unstyled">
                        @foreach($benefits as $key=>$item)
                        <li><i class="fa fa-dot-circle-o"></i> {{$item->{lang_col('title')} }}</li>
                        @endforeach
                    </ol>
                </div>
                @endif
                @endif
                @endif


                <div class="col-md-7 contact-map">
                    <form id="contact_form" class="form well-form" action="{{route('frontend.signup')}}" method="post" data-parsley-validate>

                        {{csrf_field()}}
                        <!-- Text input-->
                        <div class="form-group inline col-md-6">
                        <label>*{{__('First Name')}}:</label>
                            <input name="first_name" placeholder="{{__('First Name')}}" class="form-control" type="text" required title="Please enter your first name" value="{{old('first_name')}}">
                        </div>
                        <div class="form-group inline col-md-6">
                            <label>*{{__('Last Name')}}:</label>
                            <input name="last_name" placeholder="{{__('Last Name')}}" class="form-control" type="text" required title="Please enter your last name" value="{{old('last_name')}}">
                        </div>



                        <div class="form-group col-md-12">
                            <label>{{__('Address')}}:</label>
                            <input name="address" placeholder="{{__('Address')}}" class="form-control" type="text" value="{{old('address')}}">
                        </div>



                        <div class="form-group inline col-md-6">
                            <label>{{__('City')}}:</label>
                            <input name="city" placeholder="{{__('City')}}" class="form-control" type="text" value="{{old('city')}}">
                        </div>

                        <div class="form-group inline col-md-6">
                            <label>{{__('Country')}}:</label>
                            <input name="country" placeholder="{{__('Country')}}" class="form-control" type="text" value="{{old('country')}}">
                        </div>

                        <div class="form-group  inline col-md-6">
                            <label>{{__('Mobile')}}:</label>
                            <input name="mobile" placeholder="{{__('Mobile')}}" class="form-control" type="text"  value="{{old('mobile')}}">
                        </div>

                        <div class="form-group inline col-md-6">
                            <label>*{{__('Telephone')}}:</label>
                            <input name="telephone" placeholder="{{__('Telephone')}}" class="form-control" type="text" required value="{{old('telephone')}}">
                        </div>
                        <div class="form-group inline col-md-6">
                            <label>*{{__('Company')}}:</label>
                            <input name="company" placeholder="{{__('Company')}}" class="form-control" type="text" required value="{{old('email')}}">
                        </div>
                        <div class="form-group inline col-md-6">
                            <label>{{__('Website')}}:</label>
                            <input name="website" placeholder="{{__('Website')}}" class="form-control" type="text" value="{{old('website')}}">
                        </div>

                        <!-- Email input-->
                        <div class="form-group col-md-12">
                            <label>*{{__('Email')}}:</label>
                            <input name="email" placeholder="{{__('Email')}}" class="form-control" type="email" required value="{{old('email')}}">
                        </div>

                        <div class="form-group inline col-md-6">
                            <label>*{{__('Password')}}:</label>
                            <input name="password" id="password" minlength="6" type="password" placeholder="{{__('Password')}}" class="form-control" type="text" required>
                        </div>


                        <div class="form-group inline col-md-6">
                            <label>*{{__('Confirm Password')}}:</label>
                            <input name="confirmPassword" type="password" placeholder="{{__('Confirm Password')}}" class="form-control" type="text" required minlength="6"  required data-parsley-equalto="#password">
                        </div>


                        <button type="submit" class="btn btn-block btn-primary" > {{__('Register')}} </button>
                    </form>

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
@endsection
