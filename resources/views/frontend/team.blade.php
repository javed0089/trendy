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
            <div class="page-title text-center" style="background: url({{isset($topImage->{lang_col('image')})?asset($topImage->{lang_col('image')}):'http://placehold.it/1600x268'}});">
                <h2 class="title"> {{isset($topImage->{lang_col('title')})?$topImage->{lang_col('title')}:''}} </h2>
                <p class="description light"> {!!isset($topImage->{lang_col('content')})?$topImage->{lang_col('content')}:''!!} </p>
            </div>
            <!-- Page Title -->
            <!-- Breadcrumbs -->
            <div class="breadcrumbs">
                <div class="container">
                    <span class="parent"> <i class="fa fa-home"></i> <a href="index.html"> Home </a> </span>
                    <i class="fa fa-chevron-right"></i>
                    <span class="child"> <a href="about.html"> About </a> </span>
                    <i class="fa fa-chevron-right"></i>
                    <span class="child"> COMPANY OVERVIEW </span>
                </div>
            </div>

            <div class="container">

                <div class="row about-sidebar">

                    <div class="col-md-9 about-content">
                        @if(isset($section1))
                            @if($section1->first()->page->status)
                                <section class="about-company">

                                    <div class="com">
                                        <h2 class="company-title color-title"> {{isset($section1->{lang_col('title')})?$section1->{lang_col('title')}:''}} </h2>
                                        <h4 class="company-subtitle subtitle"> {{isset($section1->{lang_col('heading1')})?$section1->{lang_col('heading1')}:''}}  </h4>
                                        {!!isset($section1->{lang_col('content')})?$section1->{lang_col('content')}:''!!}

                                    </div>
                                </section>
                            @endif
                        @endif

                        <section class="about-leaders">
                            <div class="section-title text-center">
                                <h2 class="title-services-other title-2"> {{isset($leaders->{lang_col('title')})?$leaders->{lang_col('title')}:''}} </h2>
                                <h4 class="subtitle-services-other subtitle-2">{!! isset($leaders->{lang_col('value')})?nl2br($leaders->{lang_col('value')}) : ''!!}</h4>
                                <div class="spacer-50"> </div>
                            </div>

                            <div class="row leaders text-center">
                            @foreach($members->chunk(3) as $membersChunk)
                                @foreach($membersChunk as $member)
                                    <div class="col-sm-4">
                                        <div class="img-hover-effect">
                                            @if($member->image)
                                                <img src="{{asset($member->image)}}" alt="{{$member->{lang_col('name')} }}">
                                            @else
                                                <img src="http://placehold.it/260x286" alt="">
                                            @endif
                                            <div class="social-links">
                                                <a href="{{$member->facebook}}" target="_blank"> <i class="fa fa-facebook"></i> </a>
                                                <a href="{{$member->twitter}}" target="_blank"> <i class="fa fa-twitter"></i> </a>
                                                <a href="{{$member->linkedin}}"" target="_blank"> <i class="fa fa-linkedin"></i> </a>
                                            </div>
                                        </div>
                                        <h4 class="subtitle">{{$member->{lang_col('name')} }}</h4>
                                        <p>{{$member->{lang_col('designation')} }}</p>
                                    </div>
                                @endforeach
                                <div class="clearfix spacer-50"></div>
                            @endforeach

                               

                               
                            </div>

                        </section>

                    </div>

                    <div class="col-md-3 sidebar left">

                        <div class="sidebar-blog-categories">
                            @include('partials._sidebar-menu')
                        </div>

                        <div class="sidebar-fact">
                            <h3 class="about-quick-fact">{{isset($quickfact->title_en)?$quickfact->title_en:''}}</h3>
                            <p>{{isset($quickfact->value_en)?$quickfact->value_en:''}}</p>  
                        </div>

                    </div>

                </div>

            </div>
        </main>
        <!-- Main Content Section -->

    

@endsection
