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
                    <span class="child"> {{__('NEWS')}} </span>
                </div>
            </div>

            <div class="container">
                <div class="row">

                    <div class="col-md-12 blog-grid">
                        <section class="blog-services">
                            <div class="row news">
                                @if(count($newsCol)>0)
                                @foreach($newsCol as $news)
                                    @if(count($news->Photos))
                                    <div class="col-sm-6">
                                        <div class="blog-img-box">
                                            <div class="blog-date"> <span class="month">{{date('M',strtotime($news->created_at))}} </span> <span class="date">{{date('d',strtotime($news->created_at))}}</span> </div>
                                            <a class="hover-effect" href="{{route('frontend.news',$news->id)}}">
                                               @if($news->Photos->first()) 
                                                <img src="{{asset($news->Photos->first()->filename)}}" alt="{{$news->{lang_col('title')} }}" />
                                               @else
                                                <img src="http://placehold.it/409x308" alt="Fuel" />
                                               
                                               @endif 
                                            </a>
                                        </div>
                                        <div class="blog-content">
                                            <h3><a href="{{route('frontend.news.show',$news->id)}}">{{str_limit($news->{lang_col('title')},60)}}</a></h3>
                                             <a href="{{route('frontend.news.show',$news->id)}}" class="btn btn-default btn-sm">{{__('Read More')}}</a>
                                        </div>
                                    </div>
                                    @else
                                    <div class="col-sm-6">
                                        <div class="blog-date"> <span class="month">{{date('M',strtotime($news->created_at))}} </span> <span class="date">{{date('d',strtotime($news->created_at))}}</span> </div>
                                        <div class="blog-content">
                                            <h3><a href="{{route('frontend.news.show',$news->id)}}">{{str_limit($news->{lang_col('title')},60)}}</a></h3>
                                            <p>{!!str_limit($news->{lang_col('desc')},300)!!}</p>
                                        
                                            <a href="{{route('frontend.news.show',$news->id)}}" class="btn btn-default btn-sm">{{__('Read More')}}</a>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                                @else
                                <span>{{__('No news')}}..</span>
                                @endif

                                

                                
                            </div>
                        </section>
                    </div>

                   

                </div>
            </div>
        </main>
        <!-- Main Content Section -->
    

@endsection
