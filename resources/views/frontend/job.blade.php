 @extends('layouts.main')

 @if(isset($job->{lang_col('meta_title')}))
 @section('title'){{ $job->{lang_col('meta_title')} }} @stop
 @endif
 @if(isset($job->{lang_col('meta_description')}))
 @section('meta-description'){{ $job->{lang_col('meta_description')} }} @stop
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
        <h2 class="title"> {{$job->{lang_col('title')} }} </h2>
        <p class="description light"> {{$job->Department->{lang_col('name')} }}
            , {{$job->{lang_col('location')} }} </p>
        </div>
        @endif
        @endif
        <!-- Page Title -->


        <!-- Breadcrumbs -->
        <div class="breadcrumbs">
            <div class="container">
                <span class="parent"> <i class="fa fa-home"></i> <a href="\"> {{__('Home')}} </a> </span>
                <i class="fa fa-chevron-right"></i>
                <span class="child"> <a href="{{route('frontend.careers')}}"> {{__('Careers')}} </a> </span>
                <i class="fa fa-chevron-right"></i>
                <span class="child"> {{__('JOB')}} </span>
            </div>
        </div>
        <!-- Breadcrumbs -->

        <div class="container">

        <section class="career-single"> @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
              <button type="button" class="close" data-dismiss="alert">×</button>
              <strong>{{ $message }}</strong>
          </div>
          @endif
          @if (count($errors) > 0)
          <div class="alert alert-danger">
              <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
            <div class="row career-info">

                <div class="col-md-3 col-sm-6">
                    <div class="career-box">
                        <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                        <h4>{{__("DEPARTMENT")}}</h4>
                        <p>{{$job->Department->{lang_col('name')} }}</p>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="career-box">
                        <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                        <h4>{{__('LOCATION')}}</h4>
                        <p>{{$job->{lang_col('location')} }}</p>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="career-box">
                        <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                        <h4>{{__('EDUCATION')}}</h4>
                        <p>{{$job->{lang_col('education')} }}</p>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="career-box">
                        <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                        <h4>{{__('EXPERIENCE')}}</h4>
                        <p>{{$job->{lang_col('experience')} }}</p>
                    </div>
                </div>
            </div>
        </section>

        <div class="row single-job">
            <div class="col-md-12 job-info">

                <section class="career-single-job">
                    <h2 class="job-title title-2"> {{__('JOB DESCRIPTION')}}</h2>
                    {!!$job->{lang_col('job_description')} !!}
                </section>

                <section class="career-response">
                    <div class="response">
                        <h2 class="title-2"> {{__('RESPONSIBILITIES')}}</h2>
                        {!!$job->{lang_col('responsibilities')} !!}
                    </div>
                    <div class="text-center response-btn">
                        <button type="button" class="btn btn-primary" role="button" data-toggle="modal" data-target="#applyJob">{{__('APPLY TO THIS JOB')}} </button>
                    </div>

                </section>
            </div>

        </div>

    </div>

</main>
<!-- Main Content Section -->

<div id="applyJob" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md" >
        <div class="modal-content">
            <div class="panel-div">
                <div class="panel-title">{{__('Apply Now')}}
                    <span class="pull-right"><a class="btn btn-xs btn-primary" data-dismiss="modal">x</a></span>
                </div>
                <div class="content">
                    <div class="row">

                        <div class="spacer-50"></div>
                        <div class="col-md-12"> 
                        <form  role="form" class="form well-form" method="Post"  enctype="multipart/form-data" action="{{route('frontend.applyjob')}}" data-parsley-validate>
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label>*{{__('Your Full Name')}}:</label>
                                    <input name="applicant_name" placeholder="{{__('Your Full Name')}}" class="form-control" type="text" required data-parsley-required-message="Please enter your Full Name">
                                </div>
                                <div class="form-group">
                                    <label>*{{__('Email Address')}}:</label>
                                    <input name="email" placeholder="{{__('Email Address')}}" class="form-control" type="email" required data-parsley-required-message="Please enter your email address">
                                </div>
                                <div class="form-group">
                                    <label>*{{__('Your Resume')}}(pdf):</label>
                                    <input name="resume" class="form-control" type="file" required data-parsley-required-message="Please add your resume ">
                                </div>
                                <input type="text" hidden name="jobId" value="{{$job->id}}">
                            </div>
                            <div class="spacer-60"></div>
                            <div class="col-md-4 col-md-offset-4">
                                <button type="submit" class="btn btn-md btn-block btn-primary">{{__('Submit')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<!-- parsley JS -->
<script src="{{asset('js/parsley.min.js')}}"></script>
@endsection
