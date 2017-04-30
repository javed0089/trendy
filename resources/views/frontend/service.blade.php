 @extends('layouts.main')

 @if(isset($service->{lang_col('meta_title')}))
 @section('title'){{ $service->{lang_col('meta_title')} }} @stop
 @endif
 @if(isset($service->{lang_col('meta_description')}))
 @section('meta-description'){{ $service->{lang_col('meta_description')} }} @stop
 @endif


 @section('content')

 <main class="main">
   <!-- Page Title -->
    @if(isset($topImage))
                @if($topImage->page->status)
                    <div class="page-title text-center" style="background: url({{isset($topImage->{lang_col('image')})?asset($topImage->{lang_col('image')}):'http://placehold.it/1600x268'}});">
                        <h2 class="title"> {{$service->{lang_col('name')} }} </h2>
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
        <span class="child"> {{$service->{lang_col('name')} }} </span>
      </div>
    </div>


    <section class="services-hood">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h4 class="hood-subtitle subtitle-2">{{$service->{lang_col('name')} }}</h4>
            {!!$service->{lang_col('desc')}!!}
          </div>
        </div>
      </div>
    </section>
  </main>
  @endsection


