 @extends('layouts.main')

 @section('title','News')


@section('content')

<main class="main">
 <!-- Page Title -->
 <div class="page-title text-center">
  <h2 class="title"> {{$news->{lang_col('title')} }}  </h2>
  <p class="description light"> Holisticly brand sustainable solutions rather than clicks-and-mortar applications.
    <br> Phosfluorescently whiteboard fully tested initiatives. </p>
  </div>
  <!-- Page Title -->

  <!-- Breadcrumbs -->
  <div class="breadcrumbs">
    <div class="container">
      <span class="parent"> <i class="fa fa-home"></i> <a href="/"> {{__('Home')}} </a> </span>
      <i class="fa fa-chevron-right"></i>
       <span class="child"> <a href="{{route('frontend.news')}}">{{__('NEWS')}}</a> </span>
    </div>
  </div>


  <section class="services-hood">
    <div class="container">
      <div class="row">
      @if(isset($news->Photos) && count($news->Photos)>0)
        <div class="col-md-6 hood">
          <div class="service-slider"  style="direction: ltr;">
           <div class="flex-viewport" style="overflow: hidden; position: relative;">
            <ul class="slides" style="width: 800%; transition-duration: 0s; transform: translate3d(-1110px, 0px, 0px);">
                 
              @if(isset($news->Photos) && count($news->Photos)>0)
                @foreach($news->Photos as $Photo)
                <li class="clone" aria-hidden="true" style="width: 555px; margin-right: 0px; float: left; display: block;">
                  <img src="{{asset($Photo->filename)}}" alt="" draggable="false">
                  <div class="slider-caption">
                    <p> {{$news->{lang_col('title')} }}  </p>
                  </div>
                </li>
                @endforeach
             
              @endif
            </ul>
            </div>
            <ul class="flex-direction-nav">
              <li class="flex-nav-prev"><a class="flex-prev" href="#">{{__('Previous')}}</a></li>
              <li class="flex-nav-next"><a class="flex-next" href="#">{{__('Next')}}</a></li>
            </ul>
          </div>
        </div>
          <div class="col-md-6">
            <p>{{ date('M j, Y H:i',strtotime($news->created_at))}}</p>
            <h2 class="hood-title color-title"> {{$news->{lang_col('title')} }}</h2>
            <p>{!!$news->{lang_col('desc')}!!}</p>
          </div>
        @else
            <div class="col-md-12">
                <p>{{ date('M j, Y H:i',strtotime($news->created_at))}}</p>
                <h2 class="hood-title color-title"> {{$news->{lang_col('title')} }}</h2>
                <p>{!!$news->{lang_col('desc')}!!}</p>
          </div>
        @endif
         
    </div>
  </section>
</main>
@endsection


