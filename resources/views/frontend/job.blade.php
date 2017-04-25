 @extends('layouts.main')

 @section('title','Job')


 @section('content')

 <!-- Main Content Section -->
 <main class="main">
  
    <!-- Page Title -->
    @if(isset($topImage))
    @if($topImage->page->status)
    <div class="page-title text-center" style="background: url({{isset($topImage->{lang_col('image')})?asset($topImage->{lang_col('image')}):'http://placehold.it/1600x268'}});">
        <h2 class="title"> {{$job->{lang_col('title')} }} </h2>
        <p class="description light"> {{$job->Department->{lang_col('name')} }}
            <br> {{$job->{lang_col('location')} }} </p>
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

            <section class="career-single">
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
                            <a href="#" class="btn btn-primary" role="button">{{__('APPLY TO THIS JOB')}}</a>
                        </div>

                    </section>
                </div>

            </div>

        </div>

    </main>
    <!-- Main Content Section -->



    @endsection
