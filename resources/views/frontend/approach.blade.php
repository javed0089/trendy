 @extends('layouts.main')

 @section('title','Approach')


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
                    <span class="child"> {{__('APPROACH')}} </span>
                </div>
            </div>
            <div class="container">
                <div class="row about-sidebar">
                    <div class="col-md-9 about-content">
                        <section class="about-employees">
                            @if(isset($section1))
                                @if($section1->first()->page->status)
                                    <div class="row employees">
                                        <div class="col-sm-6 text-left">
                                            @if($section1->{lang_col('image')})
                                                <img src="{{asset($section1->{lang_col('image')})}}" alt="" /> 
                                            @else
                                                <img src="http://placehold.it/380x312" alt="" />
                                            @endif
                                        </div>
                                        <div class="col-sm-6">
                                            <h4 class="subtitle">{{isset($section1->{lang_col('title')})?$section1->{lang_col('title')}:''}} </h4>
                                            {!!isset($section1->{lang_col('content')})?$section1->{lang_col('content')}:''!!}
                                        </div>
                                    </div>
                                @endif
                            @endif
                            @if(isset($section2))
                                @if($section2->first()->page->status)
                                    <div class="row employees">
                                        <div class="col-sm-6">
                                            <h4 class="subtitle">{{isset($section2->{lang_col('title')})?$section2->{lang_col('title')}:''}} </h4>
                                            {!!isset($section2->{lang_col('content')})?$section2->{lang_col('content')}:''!!}
                                        </div>
                                        <div class="col-sm-6 text-right">
                                            @if($section2->{lang_col('image')})
                                                <img src="{{asset($section2->{lang_col('image')})}}" alt="" /> 
                                            @else
                                                <img src="http://placehold.it/380x312" alt="" />
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endif
                            <div class="spacer-80"> </div>
                        </section>
                        <section class="about-cta">
                            <div class="cta">
                                <h2>{!! isset($yellowbox->{lang_col('value')})?nl2br($yellowbox->{lang_col('value')}) : ''!!}</h2>
                            </div>
                        </section>
                       
                        <section class="about-vision">
                            <div class="row vision">
                                @if(isset($quality))
                                    @if(count($quality))
                                        @if($quality->first()->page->status)
                                            <div class="col-sm-6">
                                                <h2 class="title-2"> {{__('QUALITY POLICY')}} </h2>
                                                <ul>
                                                    @foreach($quality as $item)
                                                        <li><i class="fa fa-dot-circle-o" aria-hidden="true"></i>{{$item->{lang_col('title')} }}</li>
                                                     @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                    @endif
                                @endif
                                @if(isset($advantages))
                                    @if(count($advantages))
                                        @if($advantages->first()->page->status)
                                            <div class="col-sm-6">
                                                <h2 class="title-2"> {{__('ADVANTAGES')}} </h2>
                                                <ul>
                                                    @foreach($advantages as $item)
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
