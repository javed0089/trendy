@extends('layouts.main')

@if(isset($category))
 @if(isset($category->{lang_col('meta_title')}))
 @section('title'){{ $category->{lang_col('meta_title')} }} @stop
 @endif
 @if(isset($category->{lang_col('meta_description')}))
 @section('meta-description'){{ $category->{lang_col('meta_description')} }} @stop
 @endif
@elseif(isset($brand))
  @if(isset($brand->{lang_col('meta_title')}))
 @section('title'){{ $brand->{lang_col('meta_title')} }} @stop
 @endif
 @if(isset($brand->{lang_col('meta_description')}))
 @section('meta-description'){{ $brand->{lang_col('meta_description')} }} @stop
 @endif
 @endif




@section('content')


  @if(isset($topImage))
  @if($topImage->page->status)
  <div class="page-title text-center" style="background: url({{isset($topImage->{lang_col('image')})?asset($topImage->{lang_col('image')}):'http://placehold.it/1600x268'}});">
    <h2 class="title"> {{isset($topImage->{lang_col('title')})?$topImage->{lang_col('title')}:''}} </h2>
    <p class="description light"> {!!isset($topImage->{lang_col('content')})?$topImage->{lang_col('content')}:''!!} </p>
  </div>
  @endif
  @endif
 
  <!-- Breadcrumbs -->
  <div class="breadcrumbs">
    <div class="container">
      <span class="parent"> <i class="fa fa-home"></i> <a href="index.html"> {{__('Home')}} </a> </span>
      <i class="fa fa-chevron-right"></i>
      <span class="child"> {{__('Products')}} </span>

     <div class="searchbox-container">
    <form method="get" action="{{route('frontend.productlistsearch')}}" class="searchbox">
        <input type="search" placeholder="{{__('Search Products')}}......" name="term" class="searchbox-input" onkeyup="buttonUp();" required value="{{Request::get('term')}}">
        <input type="submit" class="searchbox-submit" value="GO">
        <span class="searchbox-icon"><i class="fa fa-search"></i></span>
    </form>
</div>
    </div>
     
  </div>

  <div class="container">
   <div class="row services-sidebar">

    <div class="col-md-9 services-content">

      <section class="services-company">
        <div class="row"> 
        @if(isset($category) || isset($brand))
        <h2 class="color-title" style="display: block;">{{isset($category)?$category->name_en:''}}</h2>
        <h2 class="color-title" style="display: block;">{{isset($brand)?$brand->name_en:''}}</h2>
         <hr>
         @endif
         @if (isset($products) && count($products) > 0)
         @if(Request::get('term'))
         <div class="alert alert-info">
          {{{Request::get('term')?__('Search results for').' :  '. Request::get('term'):''}}}
         </div>
         @endif
         @foreach($products->sortBy('sort_order')->chunk(3) as $productsChunk)
         @foreach($productsChunk as $product)
         <div id="addToQuote" class="col-md-4 col-sm-4">
           <a href="{{route('frontend.product',$product->slug)}}" class="hover-effect">
             @if($product->Images && count($product->Images))
             <img src="{{asset($product->Images->first()->filename)}}" alt="{{$product->{lang_col('name')} }}" />
             @else
             <img src="http://placehold.it/350x260" alt="{{$product->{lang_col('name')} }}" />
             @endif
           </a>
           <h4 class="subtitle services-title-one"><a href="{{route('frontend.product',$product->slug)}}"> {{$product->{lang_col('name')} }}</a></h4>
           <p>{!!str_limit($product->{lang_col('desc')},180)!!} </p>
           <input type="text" hidden value="{{route('addToCart',$product->id)}}" name="">
           <a  class="btn btn-danger btn-sm quote" href="#"> {{__('Request A Quote')}} <img id="loader" class="pull-right" width="35" style="display: none;" src="{{asset('images/ellipsis.gif')}}" alt="loading"></a>
           <div id="alert" style="display: none; margin-top: 5px;" >
           </div>
         </div>
         @endforeach 
         <div class="clearfix spacer-50"></div>
         @endforeach
         @else
         <div class="alert alert-info">{{isset($category)?__('Stock not available for this product category. Visit again to view this page'):''}}
         {{isset($brand)?__('Stock not available for this product brand. Visit again to view this page'):''}}
          {{Request::get('term')?__('No products found'):''}}
         </div>
         @endif

@if(isset($subCategories))
         @foreach($subCategories as $subCategory)
         <h2 class="color-title" style="display: block;">{{$subCategory->name_en}}</h2>
         <hr>
         @if (count($subCategory->Products) > 0)
         @foreach($subCategory->Products->sortBy('sort_order')->where('discontinued','=','0')->chunk(3) as $productsChunk)
         @foreach($productsChunk as $product)
         <div id="addToQuote" class="col-md-4 col-sm-4">
           <a href="{{route('frontend.product',$product->slug)}}" class="hover-effect">
             @if($product->Images && count($product->Images))
             <img src="{{asset($product->Images->first()->filename)}}" alt="{{$product->{lang_col('name')} }}" />
             @else
             <img src="http://placehold.it/350x260" alt="{{$product->{lang_col('name')} }}" />
             @endif
           </a>
           <h4 class="subtitle services-title-one"><a href="{{route('frontend.product',$product->slug)}}"> {{$product->{lang_col('name')} }}</a></h4>
           <p>{!!str_limit($product->{lang_col('desc')},180)!!} </p>
           <input type="text" hidden value="{{route('addToCart',$product->id)}}" name="">
           <a  class="btn btn-danger btn-sm quote" href="#"> {{__('Request A Quote')}} <img id="loader" class="pull-right" width="35" style="display: none;" src="{{asset('images/ellipsis.gif')}}" alt="loading"></a>
           <div id="alert" style="display: none; margin-top: 5px;" >
           </div>
         </div>
         @endforeach 
         <div class="clearfix spacer-50"></div>
         @endforeach
         @else
         <div class="alert alert-info">{{isset($category)?__('Stock not available for this product category. Visit again to view this page'):''}}
         {{isset($brand)?__('Stock not available for this product brand. Visit again to view this page'):''}}</div>
         <div class="clearfix spacer-50"></div>
         @endif

         @endforeach
 @endif
       </div>
     </section>

   </div>

   <div class="col-md-3 sidebar left" >
    @if (isset($categories) && count($categories) > 0)
    <ul id="tree" class="treeview">
    <li style="font-weight: bold;
    line-height: 28px;
    background: #034694;
    color: #fff;
    font-size: 16px;
    padding: 7px !important;">Categories</li>
      @foreach ($categories->sortBy('sort_order') as $category)
      @include('frontend.category', $category)
      @endforeach
      <li style="font-weight: bold;
    line-height: 28px;
    background: #034694;
    color: #fff;
    font-size: 16px;
    padding: 7px !important;">Brands</li>
      @foreach($brands as $brand)
      <li {{ Request::is('*/brand/'.$brand->slug)?"class=active":'' }}><a href="{{route('frontend.productsByBrand',$brand->slug)}}"><span>{{$brand->name_en}}</span></a></li>
      @endforeach
     
   
    </ul>
    @else
    <span>{{__('No categories')}}</span>
    @endif

    

  </div>

</div>
</div>

@endsection