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
            <span class="child"> {{__('Blog')}} </span>
        </div>
    </div>

    <div class="container">
        <div class="row">

            <div class="col-md-9 blog-grid">
                <section class="blog-services">
                    <div class="row news">
                        @if(count($posts)>0)
                        @foreach($posts->chunk(2) as $postsChunk)
                        @foreach($postsChunk as $post)
                        <div class="col-sm-6">
                            <div class="blog-img-box">
                                <div class="blog-date"> <span class="month">{{date('M',strtotime($post->created_at))}} </span> <span class="date">{{date('d',strtotime($post->created_at))}}</span> </div>
                                <a class="hover-effect" href="{{route('frontend.post',$post->slug)}}">
                                 @if($post->image) 
                                 <img src="{{asset($post->image)}}" width="409" height="322" alt="" />
                                 @else
                                 <img src="http://placehold.it/409x322" alt="Fuel" />
                                 
                                 @endif 
                             </a>
                         </div>
                         <div class="blog-content">
                            <h3><a href="{{route('frontend.post',$post->slug)}}">{{str_limit($post->{lang_col('title')},60)}}</a></h3>
                            <p>{{__('By')}} <a href="#">{{$post->{lang_col('author')} }}</a> {{__('in')}} {{$post->BlogCategory->{lang_col('name')} }}</p>
                        </div>
                    </div>
                    @endforeach
                    <div class="clearfix spacer-50"></div>
                    @endforeach
                    @else
                    <span>{{__('No posts')}}..</span>
                    @endif
                    <div class="col-md-12 text-center"> 
                        {{ $posts->links() }}
                    </div>
                    

                    
                </div>
            </section>
        </div>

        <div class="col-md-3 sidebar">

            <div class="sidebar-search-form">
                <input type="text" class="  search-query form-control" placeholder="Search" />
                <button class="btn search-btn" type="button">
                    <span class="fa fa-search"></span>
                </button>
            </div>

            <div class="sidebar-blog-categories">
                <h3 class="sidebar-title">Categories</h3>

                <ul>
                    @foreach($blogCategories as $blogCategory)
                    <li> <a href="{{route('frontend.posts-by-category',$blogCategory->id)}}">{{$blogCategory->{lang_col('name')} }}</a> </li>
                    @endforeach
                </ul>

            </div>

            <div class="sidebar-fact">

                <h3 class="about-quick-fact">{{isset($quickfact->{lang_col('title')})?$quickfact->{lang_col('title')}:''}}</h3>
                <p>{{isset($quickfact->{lang_col('value')})?$quickfact->{lang_col('value')}:''}}</p>  

            </div>

            <div class="sidebar-tags">
                <h3 class="sidebar-title"> Tags </h3>
                @foreach($tags as $tag)
                <a href="{{route('frontend.posts-by-tag',$tag->id)}}"">{{$tag->{lang_col('name')} }}</a>
                @endforeach
            </div>

        </div>

    </div>
</div>
</main>
<!-- Main Content Section -->


@endsection
