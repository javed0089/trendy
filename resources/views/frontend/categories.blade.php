 @extends('layouts.main')

 @section('title','Categories')


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
                    <span class="child"> {{__('CATEGORIES')}} </span>
                </div>
            </div>

            <div class="container">
                <div class="services-content">
                    <section class="services-company">
                        <div class="row service-list">
                             @foreach($categories->chunk(3) as $categoryChunk)
                                @foreach($categoryChunk as $category)
                                    <div class="col-md-4 col-sm-4">
                                        <a href="{{route('frontend.productlist',$category->slug)}}" class="hover-effect">
                                            @if($category->image)
                                                <img src="{{asset($category->image)}}" alt="{{$category->{lang_col('name')} }}" />
                                            @else
                                                <img src="http://placehold.it/350x235" alt="{{$category->{lang_col('name')} }}" />
                                            @endif
                                        </a>
                                        <h4 class="subtitle services-title-one">{{$category->{lang_col('name')} }}</h4>
                                        <p>{!!$category->{lang_col('desc')}!!} </p>
                                        <a class="link" href="{{route('frontend.productlist',$category->slug)}}"> {{__('Show Products')}} </a>
                                    </div>
                                @endforeach 
                                    <div class="clearfix spacer-50"></div>
                            @endforeach
                       
                        </div>
                    </section>
                </div>
            </div>

        </main>
        <!-- Main Content Section -->

    

@endsection
