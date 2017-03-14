 @extends('layouts.main')

 @section('title','Careers')


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
                    <i class="fa fa-chevron-right"></i> <span class="child"> {{__('Careers')}} </span>
                </div>
            </div>

            <div class="container">

                <section class="statistics">

                    <div class="container">
                        <div class="row job-stats">
                            @foreach($departments as $department)
                            <div class="col-md-4 col-sm-6">
                                <a href="#careers-open">
                                    <div class="stats-box text-center">
                                        <h4 class="subtitle">{{$department->{lang_col('name')} }}</h4>
                                        <p>{{$department->JobCount($department->id)}} {{__('positions')}}</p>
                                    </div>
                                </a>
                            </div>
                            @endforeach   
                            

                        </div>

                    </div>

                </section>

                <section class="careers-culture">
                    <div class="section-title text-center">
                        <h2 class="title-services-other title-2"> {{ isset($work->{lang_col('title')})?$work->{lang_col('title')} : ''}} </h2>
                        <h4 class="subtitle-services-other subtitle-2">{!! isset($work->{lang_col('value')})?nl2br($work->{lang_col('value')}) : ''!!}</h4>
                        <div class="spacer-50"> </div>
                    </div>

                    <div class="row culture">

                        <div class="col-md-7">
                            <h2 class="culture-title"> {{isset($section1->{lang_col('title')})?$section1->{lang_col('title')}:''}} </h2>
                            <h4 class="culture-subtitle"> {{isset($section1->{lang_col('heading1')})?$section1->{lang_col('heading1')}:''}} </h4>
                            {!!isset($section1->{lang_col('content')})?$section1->{lang_col('content')}:''!!}

                        </div>

                        <div class="col-sm-5 culture-video">
                                    <a href="#" class="hover-effect"> 
                                    @if(isset($section1->{lang_col('image')}))
                                        <img src="{{asset($section1->{lang_col('image')}) }}" alt="" /> 
                                    @else
                                        <img src="http://placehold.it/380x277" alt="" />
                                    @endif
 
                                    </a>
                        </div>
                    </div>
                </section>

            

                <section id="careers-open" class="careers-open-positions">
                    <h2 class="positions-title title-2 text-center"> {{__('OPEN POSITIONS')}} </h2>
                    <div class="spacer-50"> </div>
                    <div class="open-positions">
                        <ul>
                            @foreach($jobs as $job)
                                <li>
                                    <div class="designation">
                                        <h4 class="subtitle"><a href="{{route('frontend.job',$job->slug)}}">{{$job->{lang_col('title')} }} </a> </h4>
                                        <span>{{$job->Department->{lang_col('name')} }}</span>
                                    </div>
                                    <div class="location" >
                                        <p style="line-height: 45px;" class="state">{{$job->{lang_col('location')} }}</p>
                                    </div>
                                    <a href="{{route('frontend.job',$job->slug)}}" class="btn btn-primary" role="button">{{__('VIEW AND APPLY')}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                </section>
            </div>

        </main>
        <!-- Main Content Section -->
   

    

@endsection
