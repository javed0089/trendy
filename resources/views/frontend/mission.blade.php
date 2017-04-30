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
                    <span class="parent"> <i class="fa fa-home"></i> <a href="/"> {{__('Home')}} </a> </span>
                    <i class="fa fa-chevron-right"></i>
                    <span class="child"> {{__('MISSION')}} </span>
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

                        <section class="about-vision">
                            <div class="row vision">
                                @if(isset($vision))
                                    @if(count($vision))
                                        @if($vision->first()->page->status)
                                            <div class="col-sm-6">
                                                <h2 class="title-2"> {{__('OUR VISION')}} </h2>
                                                <ul>
                                                    @foreach($vision as $item)
                                                        <li><i class="fa fa-dot-circle-o" aria-hidden="true"></i>{{$item->{lang_col('title')} }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    @endif
                                @endif
                                @if(isset($mission))
                                    @if(count($mission))
                                        @if($mission->first()->page->status)
                                            <div class="col-sm-6">
                                                <h2 class="title-2"> {{__('OUR MISSION')}} </h2>
                                                <ul>
                                                    @foreach($mission as $key=>$item)
                                                        <li><i class="fa fa-dot-circle-o" aria-hidden="true"></i>{{$item->{lang_col('title')} }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    @endif
                                @endif
                            </div>
                        </section>

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
