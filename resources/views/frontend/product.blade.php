 @extends('layouts.main')

 @section('title','Product')


 @section('content')

 <main class="main">
   <!-- Page Title -->
    @if(isset($topImage))
      @if($topImage->page->status)
        <div class="page-title text-center" style="background: url({{isset($topImage->{lang_col('image')})?asset($topImage->{lang_col('image')}):'http://placehold.it/1600x268'}});">
          <h2 class="title"> {{$product->{lang_col('name')} }} </h2>
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
        <span class="child"> <a href="{{route('frontend.productlist',$product->Category->slug)}}">{{$product->Category->{lang_col('name')} }}</a> </span>
        <i class="fa fa-chevron-right"></i>
        <span class="child"> {{$product->{lang_col('name')} }} </span>
      </div>
    </div>


    <section class="services-hood">
      <div class="container">
        <div class="row">
          <div class="col-md-6 hood">
            <div class="service-slider"  style="direction: ltr;">
             <div class="flex-viewport" style="overflow: hidden; position: relative;">
              <ul class="slides" style="width: 800%; transition-duration: 0s; transform: translate3d(-1110px, 0px, 0px);">

                @if(isset($product->Images) && count($product->Images)>0)
                @foreach($product->Images as $image)
                <li class="clone" aria-hidden="true" style="width: 555px; margin-right: 0px; float: left; display: block;">
                  <img src="{{asset($image->filename)}}" alt="" draggable="false">
                  <div class="slider-caption">
                    <p> {{$product->{lang_col('name')} }}  </p>
                  </div>
                </li>
                @endforeach
                @else
                <li class="clone" aria-hidden="true" style="width: 555px; margin-right: 0px; float: left; display: block;">
                  <img src="http://placehold.it/555x407" alt="" draggable="false">
                  <div class="slider-caption">
                    <p> Image title </p>
                  </div>
                </li>
                @endif
              </ul>
            </div>
            <ul class="flex-direction-nav">
              <li class="flex-nav-prev"><a class="flex-prev" href="#">{{__('Previous')}}</a></li>
              <li class="flex-nav-next"><a class="flex-next" href="#">{{__('Next')}}</a></li>
            </ul>
          </div>
        </div>
        <div id="addToQuote" class="col-md-6">
          <h2 class="hood-title color-title"> {{$product->Category->{lang_col('name')} }}</h2>
          <h4 class="hood-subtitle subtitle"> {{$product->Brand->{lang_col('name')} }} - {{$product->{lang_col('name')} }} </h4>
           <input type="text" hidden value="{{route('addToCart',$product->id)}}" name="">
          <a class="btn btn-danger btn-md quote quote" href="#"> {{__('Request A Quote')}} <img id="loader" class="pull-right" width="35" style="display: none;" src="{{asset('images/ellipsis.gif')}}" alt="loading"></a>
               <div id="alert" style="display: none; margin-top: 5px;" >
               </div>
          <div class="spacer-40"></div> 
          @if($product->{lang_col('desc')})
          {!!$product->{lang_col('desc')}!!}
          @endif 
          <h4 class="hood-subtitle subtitle-2">{{__('Product Data Sheets')}} </h4>
          <div class="row styled-list">
            <ul class="list-unstyled">
              @foreach($product->Files as $file)
              <li> <a href="{{asset($file->filename)}}" target="blank">{{$file->original_filename}}</a></li>
              @endforeach
            </ul>
          </div>

        </div>
        <div class="spacer-50"></div>
         <div class="col-md-6">
         <h4 class="hood-subtitle subtitle-2">{{__('Related Products')}} </h4>
          @foreach($relatedProds as $relatedProd)
            <div class="col-md-4 col-sm-4">
           <a href="{{route('frontend.product',$relatedProd->slug)}}" class="hover-effect">
             @if($relatedProd->Images && count($relatedProd->Images))
             <img src="{{asset($relatedProd->Images->first()->filename)}}" alt="{{$relatedProd->{lang_col('name')} }}" />
             @else
             <img src="http://placehold.it/350x260" alt="{{$relatedProd->{lang_col('name')} }}" />
             @endif
           </a>
           <h5 class="subtitle services-title-one"><a href="{{route('frontend.product',$relatedProd->slug)}}"> {{$relatedProd->{lang_col('name')} }}</a></h5>
          
          
          
          
         </div>
          @endforeach
         </div>
        @if(!empty($product->{lang_col('specs')}))
        <div class="col-md-6">
          <h4 class="hood-subtitle subtitle-2">{{__('Product Applications')}}</h4>
          {!!$product->{lang_col('specs')}!!}
        </div>
        @endif
      </div>
    </div>
  </section>
</main>
@endsection


