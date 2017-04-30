 @extends('layouts.main')

 @if(isset($metatags->{lang_col('meta_title')}))
 @section('title'){{ $metatags->{lang_col('meta_title')} }} @stop
 @endif
 @if(isset($metatags->{lang_col('meta_description')}))
 @section('meta-description'){{ $metatags->{lang_col('meta_description')} }} @stop
 @endif


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
                    <span class="child"> {{__('WHO WE ARE')}} </span>
                </div>
            </div>

            <div class="container">

                <div class="row about-sidebar">

                    <div class="col-md-9 about-content">

                        <section class="about-company">

                            <div class="com"> 
                                <h2 class="company-title color-title"> {{isset($section1->{lang_col('title')})?$section1->{lang_col('title')}:''}} </h2>
                                <h4 class="company-subtitle subtitle"> {{isset($section1->{lang_col('heading1')})?$section1->{lang_col('heading1')}:''}}  </h4>
                                    {!!isset($section1->{lang_col('content')})?$section1->{lang_col('content')}:''!!}
                            </div>
                        </section>

                        <section class="about-cta">

                            <div class="cta">
                                <h2>{!! isset($yellowbox->{lang_col('value')})?nl2br($yellowbox->{lang_col('value')}) : ''!!}</h2>

                            </div>
                        </section>

                        <section class="about-culture">
                            <div class="row culture">
                                <div class="col-sm-6 cul">
                                    <h2 class="culture-title"> {{isset($section2->{lang_col('title')})?$section2->{lang_col('title')}:''}} </h2>
                                    <h4 class="culture-subtitle"> {{isset($section2->{lang_col('heading1')})?$section2->{lang_col('heading1')}:''}} </h4>
                                    {!!isset($section2->{lang_col('content')})?$section2->{lang_col('content')}:''!!}
                                </div>
                                <div class="col-sm-6 culture-video">
                                    <a href="#" class="hover-effect"> 
                                    @if(isset($section2->{lang_col('image')}))
                                        <img src="{{asset($section2->{lang_col('image')})}}" alt="" /> 
                                    @else
                                        <img src="http://placehold.it/380x277" alt="" />
                                    @endif
 
                                    </a>
                                </div>

                            </div>

                        </section>

                        <section class="about-stats">
                            <div class="row stats stats-2">
                                @foreach($stats as $stat)
                                    <div class="col-xs-6">
                                        @if($stat->image)
                                            <img src="{{asset($stat->image)}}" alt="" />
                                        @else
                                            <img src="http://placehold.it/60x48" alt="" />
                                        @endif
                                        <div class="stats-info">
                                            <h4 class="counter">{{$stat->{lang_col('value')} }}</h4>
                                            <p>{{$stat->{lang_col('title')} }}</p>
                                        </div> 
                                    </div> 
                                @endforeach
                            </div>

                        </section>
                        
                        @if(isset($accordians))
                            @if(count($accordians))
                                @if($accordians->first()->page->status)
                                    <section class="about-accordion">
                                                <div class="row publications">
                                                     <div class="panel-group" id="accordion">
                                                        @foreach($accordians as $key=>$accordian)
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <h4 class="panel-title">
                                                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$key}}">{{ $accordian->{lang_col('title')} }}</a>
                                                                    </h4>
                                                                </div>
                                                                <div id="collapse{{$key}}" class="panel-collapse collapse{{$key==0?' in':''}}">
                                                                    <div class="panel-body">
                                                                        <p>{!!$accordian->{lang_col('content')} !!}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach  
                                                    </div>
                                                </div>
                                    </section>
                                @endif
                            @endif
                        @endif
                    </div>

                    <div class="col-md-3 sidebar left">

                        <div class="sidebar-blog-categories">
                            @include('partials._sidebar-menu')
                        </div>
                        <div class="sidebar-fact">

                            <h3 class="about-quick-fact">{{isset($quickfact->{lang_col('title')})?$quickfact->{lang_col('title')}:''}}</h3>
                            <p>{{isset($quickfact->{lang_col('value')})?$quickfact->{lang_col('value')}:''}}</p>
                        </div>

                    </div>

                </div>

            </div>
        </main>
        <!-- Main Content Section -->

   

    

@endsection
