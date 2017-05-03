 @extends('layouts.main')

 @section('title','Post')


 @section('content')

   <!-- Main Content Section -->
    <main class="main">
        <!-- Page Title -->
    
        @if(isset($topImage))
                @if($topImage->page->status)
                    <div class="page-title text-center" style="background: url({{isset($topImage->{lang_col('image')})?asset($topImage->{lang_col('image')}):'http://placehold.it/1600x268'}});">
                        <h2 class="title"> {{str_limit($post->{lang_col('title')},50)}} </h2>
            <p class="description light"> {{__('By')}} <a href="#"> {{$post->{lang_col('author')} }} </a> {{ date('M j, Y H:i',strtotime($post->created_at))}} {{__('in')}} {{$post->BlogCategory->{lang_col('name')} }}. </p>
                    </div>
                @endif
            @endif
            <!-- Page Title -->
            <!-- Breadcrumbs -->
            <div class="breadcrumbs">
                <div class="container">
                    <span class="parent"> <i class="fa fa-home"></i> <a href="/"> {{__('Home')}} </a> </span>
                    <i class="fa fa-chevron-right"></i>
                    <span class="child"> {{__('BLOG POST')}} </span>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-md-9 blog-info">
                        <section class="blog-single">
                            <div class="blog-slide"  style="direction: ltr;">
                                <ul class="slides">
                                    <li>
                                        

                                        @if($post->image) 
                                            <img src="{{asset($post->image)}}" alt="blog-image" />
                                        @else
                                            <img src="http://placehold.it/848x402" alt="Fuel" />
                                               
                                        @endif 
                                    </li>
                                </ul>
                            </div>

                            <div class="single-post">
                                {!!$post->{lang_col('body')}!!}

                                
                            <div class="social-share text-center">
                                <a class="fb-share" href="#"> <i class="fa fa-facebook" aria-hidden="true"></i>{{__('Share on Facebook')}} </a>
                                <a class="tweet-share" href="#"> <i class="fa fa-twitter" aria-hidden="true"></i>{{__('Share on Twitter')}} </a>
                            </div>

                            <div class="author-box">
                                
                                <div class="author-details">
                                    <h4 class="subtitle">{{__('Author')}}: {{$post->{lang_col('author')} }}</h4>
                                </div>
                            </div>

                            <div class="comments">

                                <h2 class="title-2 text-center">  {{__('Comments')}}</h2>

                              
                              
                            </div>

                            <div class="comment-box">
                                <h2 class="title-2 text-center"> Add Comment </h2>

                                <form action="comment-form.php" method="POST" id="commentform" class="commentform">
                                    <div class='row'>
                                        <div id="comment-name" class="col-md-4">
                                            <input type="text" id="comm-name" class="form-control" placeholder="Name" name="comm-name">
                                        </div>
                                        <div id="comment-email" class="col-md-4">
                                            <input type="email" id="comm-email" class="form-control" placeholder="Email Address" name="comm-email">
                                        </div>
                                        <div id="comment-url" class="col-md-4">
                                            <input type="url" id="comm-url" class="form-control" placeholder="Website (optional)" name="comm-url">
                                        </div>
                                        <div id="comment-message" class="col-md-12">
                                            <textarea id="comment" class="form-control" name="comment" placeholder="Message"></textarea>
                                        </div>
                                        <div class="comment-btn col-md-12">
                                            <button type="submit" class="btn btn-block btn-warning"> ADD COMMENT </button>
                                        </div>
                                    </div>
                                </form>

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
                                    <li> <a href="#">{{$blogCategory->name_en}}</a> </li>
                                @endforeach
                            </ul>

                        </div>

                        <div class="sidebar-tags">
                            <h3 class="sidebar-title"> Tags </h3>
                            @foreach($post->tags as $tag)
                                <a href="#">{{$tag->name_en}}</a>
                            @endforeach

                        </div>

                    </div>

                </div>
            </div>

        </main>
        <!-- Main Content Section -->
    

@endsection
