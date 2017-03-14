 @extends('layouts.main')

 @section('title','Reset your password')


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
           

            <div class="container">
              
                <section class="contact-form">
                    <div class="row form">
                    <div class="spacer-80"></div>
                        <div class="col-md-12">
                            <div class="col-md-6 col-md-offset-3">

                                <h2 class="title-2" style="text-align: center;"> {{__('Reset your password.')}} </h2>
                                <form id="contact_form" class="form well-form" action="" method="post">
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
                                   
                                    <!-- Password-->
                                    <div class="form-group">
                                        <input name="password" placeholder="{{__('Password')}}" class="form-control" type="password" required title="Please enter new password">
                                    </div>

                                     <!-- Confirm Password-->
                                    <div class="form-group">
                                        <input name="password_confirmation" placeholder="{{__('Confirm Password')}}" class="form-control" type="password" required title="Please enter new password">
                                    </div>


                                    <!-- Button -->
                                    <button type="submit" class="btn btn-block btn-warning" id="js-contact-btn"> {{__('Change Password')}} </button>
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
