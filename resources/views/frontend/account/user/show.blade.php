 @extends('layouts.main')

 @section('title','Personal Information')
 @section('styles')
 <link rel="stylesheet" href="{{asset('backend/dist/css/vertical-tab.css')}}">
 <link href="{{asset('css/parsley.css')}}" rel="stylesheet">
 @endsection


 @section('content') 

 <!-- Main Content Section -->
 <main class="main">



  <div class="container">

    <div class="row about-sidebar">
     <div class="spacer-40"></div>
     <div class="col-md-10 about-content">
       <div class="panel-div">
        <div class="panel-title">{{__('Personal Info')}}</div>
        <div class="content">
          <div class="row">
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
           <div class="col-xs-3"> 
            <ul class="nav nav-tabs tabs-left">
              <li class=active><a href="#personalInfo" data-toggle="tab"><i class="fa fa-user-circle"></i> {{__('Personal Info')}}
              </a></li>
              <li><a href="#changepassword" data-toggle="tab"><i class="fa fa-lock"></i> {{__('Change Password')}}
              </a></li>
            </ul>
          </div>
          <div class="col-xs-9">
            <div class="tab-content">
              <div class="tab-pane active userinfo" id="personalInfo">
                <div class="col-xs-6">
                  <h4>{{__('Full Name')}}: <span>{{$user->first_name}} {{$user->last_name}}</span></h4>
                  <h4>{{__('Address')}}: <span>{{$user->address}}</span></h4>
                  <h4>{{__('City')}}: <span>{{$user->city}}</span></h4>
                  <h4>{{__('Country')}}: <span>{{$user->country}}</span></h4>
                  <h4>{{__('Address')}}: <span>{{$user->address}}</span></h4>
                  

                </div>
                <div class="col-xs-6">
                  <h4>{{__('Company')}}: <span>{{$user->company}}</span></h4>
                  <h4>{{__('Telephone')}}: <span>{{$user->telephone}}</span></h4>
                  <h4>{{__('Mobile')}}: <span>{{$user->mobile}}</span></h4>
                  <h4>{{__('Website')}}: <span>{{$user->website}}</span></h4>
                  <h4>{{__('Email')}}: <span>{{$user->email}}</span></h4>


                </div>
              </div>
              <div class="tab-pane" id="changepassword">
                <h3 class="title-2" style="text-align: center;"> {{__('Change Password')}} </h3>
                <div class="col-md-8 col-md-offset-2">
                  <form id="contact_form" class="form well-form" action="{{route('user.update', User::getId())}}" method="post" data-parsley-validate>
                   {{csrf_field()}}
                    {{ method_field('PATCH') }}
                  

                   <div class="form-group">

                  <input name="oldPassword" id="oldpassword" minlength="6" type="Password" placeholder="{{__('Old Password')}}" class="form-control" type="text" required>
                  </div>



                  <div class="form-group">

                  <input name="newPassword" id="newPassword" minlength="6" type="Password" placeholder="{{__('New Password')}}" class="form-control" type="text" required>
                  </div>


                  <div class="form-group">

                    <input name="confirmPassword" type="password" placeholder="{{__('Confirm Password')}}" class="form-control" type="text" required minlength="6"  required data-parsley-equalto="#newPassword">
                  </div>



                  <!-- Button -->
                  <button type="submit" class="btn btn-block btn-warning" id="js-contact-btn"> {{__('Change Password')}} </button>
                  <div class="spacer-30"> </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="spacer-20"></div>
</div>

<div class="col-md-2 sidebar left" style="padding:0;">
  <div class="sidebar-blog-categories">
    @include('partials._acct-sidebar')
  </div>
</div>
</div>

</div>

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
