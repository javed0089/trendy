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
            <span class="child"> {{__('TESTIMONIALS')}} </span>
        </div>
    </div>

    <div class="container">
        <div class="row">

            <div class="col-md-12 blog-grid">
                <section class="blog-services">
                    <div class="row home-testimonials">
                        @if(count($testimonials)>0)
                        
                        @foreach($testimonials->chunk(3) as $testimonialsChunk)
                        @foreach($testimonialsChunk as $testimonial)


                        <div class="col-md-4">
                            <blockquote style="box-shadow: 16px 27px 49px 0px rgba( 0, 0, 0, 0.1);">{{strip_tags($testimonial->{lang_col('quote')})}}</blockquote>
                            <h4 class="client-name">{!!$testimonial->{lang_col('client_name')} !!}</h4>
                            <p class="designation">{!!$testimonial->{lang_col('location')} !!}</p>
                        </div>


                        @endforeach
                        <div class="clearfix spacer-50"></div>
                        @endforeach
                        @else
                        <span>{{__('No news')}}..</span>
                        @endif

                        <div class="col-md-12 text-center"> 
                            {{ $testimonials->links() }}
                        </div>
                    </div>
                </section>
            </div>



        </div>
    </div>
</main>
<!-- Main Content Section -->


@endsection
