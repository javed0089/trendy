 @extends('layouts.main')

 @if(isset($post->{lang_col('meta_title')}))
 @section('title'){{ $post->{lang_col('meta_title')} }} @stop
 @endif
 @if(isset($post->{lang_col('meta_description')}))
 @section('meta-description'){{ $post->{lang_col('meta_description')} }} @stop



 @endif

 @section('styles')
 <link href="{{asset('css/parsley.css')}}" rel="stylesheet">
 @endsection

 @section('content')

 <script type="text/javascript">
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.9";
      fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>
</script>
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
                @if ($message = Session::get('success'))
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

                        <div class="col-md-6 text-right">
                            <div class="fb-share-button" 
                            data-href="{{url()->current()}}" 
                            data-layout="button_count" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fdevelopers.facebook.com%2Fdocs%2Fplugins%2F&amp;src=sdkpreparse">{{__('Share')}}</a></div>
                        </div>

                        <div class="col-md-6 text-left">
                            <a href="https://twitter.com/share"  class="twitter-share-button" data-size="large" data-show-count="false">{{__('Tweet')}}</a><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
                        </div>
                    </div>

                    <div class="author-box">

                        <div class="author-details">
                            <h4 class="subtitle">{{__('Author')}}: {{$post->{lang_col('author')} }}</h4>
                        </div>
                    </div>

                    <div class="spacer-20"></div>
                    <div class="comments">

                        <h3 class="title-2 text-center"> {{count($post->PostComments)}} {{__('Comments')}}</h3>
            @foreach($post->PostComments->sortByDesc('created_at') as $postComment)
                        <div class="comments-single" >
                          <div class="message">
                            <i class="fa fa-user-circle"></i>
                            <h3>{{$postComment->name}} <span>{{date('M j, Y H:i',strtotime($postComment->created_at))}}</span> </h3>
                            <p>{{$postComment->message}}</p>
                        </div>
                    </div>
                        @endforeach

                </div>

                <div class="comment-box">
                    <h2 class="title-2 text-center"> {{__('Add Comment')}} </h2>

                    <form action="{{route('frontend.post-comment',$post->id)}}" method="POST" id="commentform" class="commentform single-click-form" data-parsley-validate>
                       {{csrf_field()}}
                       <div class='row'>
                        <div id="comment-name" class="col-md-4">
                            <input type="text" id="comm-name" class="form-control" placeholder="{{__('Name')}}" required name="name" value="{{old('name')}}">
                        </div>
                        <div id="comment-email" class="col-md-4">
                            <input type="email" id="comm-email" class="form-control" placeholder="{{__('Email Address')}}" name="email" required  value="{{old('email')}}">
                        </div>
                        <div id="comment-url" class="col-md-4">
                            <input type="url" id="comm-url" class="form-control" placeholder="{{__('Website optional')}}" name="website"  value="{{old('website')}}">
                        </div>
                        <div id="comment-message" class="col-md-12">
                            <textarea id="comment" class="form-control" name="message" placeholder="{{__('Message')}}" required minlength="10"> {{old('message')}}</textarea>
                        </div>
                        <div class="comment-btn col-md-12">
                            <button type="submit" class="btn btn-block btn-warning"> {{__('ADD COMMENT')}} </button>
                        </div>
                    </div>
                </form>

            </div>

        </section>
    </div>

    <div class="col-md-3 sidebar">



        <div class="sidebar-blog-categories">
            <h3 class="sidebar-title">Categories</h3>

            <ul>
                @foreach($blogCategories as $blogCategory)
                <li> <a href="{{route('frontend.postsbycategory',$blogCategory->slug)}}">{{$blogCategory->{lang_col('name')} }}</a> </li>
                @endforeach
            </ul>

        </div>

        <div class="sidebar-tags">
            <h3 class="sidebar-title"> Tags </h3>
            @foreach($post->tags as $tag)
            <a href="{{route('frontend.posts-by-tag',$tag->slug)}}"">{{$tag->{lang_col('name')} }}</a>
            @endforeach

        </div>

    </div>

</div>
</div>

</main>
<!-- Main Content Section -->


@endsection


@section('scripts')

<!-- parsley JS -->
<script src="{{asset('js/parsley.min.js')}}"></script>
@if(LaravelLocalization::getCurrentLocale()=='ar')
<script src="{{asset('js/parsley/ar.js')}}"></script>
@endif

@endsection
