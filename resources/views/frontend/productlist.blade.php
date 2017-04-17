 @extends('layouts.main')

 @section('title','Product List')


 @section('content')

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
      <span class="parent"> <i class="fa fa-home"></i> <a href="index.html"> {{__('Home')}} </a> </span>
      <i class="fa fa-chevron-right"></i>
      <span class="child"> {{__('Products')}} </span>
    </div>
  </div>

  <div class="container">
   <div class="row services-sidebar">

    <div class="col-md-9 services-content">

      <section class="services-company">
        <div class="row">
         @if (isset($products) && count($products) > 0)
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
           <!--  <a class="link" href="{{route('frontend.product',$product->slug)}}"> Read more </a>-->
           <input type="text" hidden value="{{route('addToCart',$product->id)}}" name="">
           <a  class="btn btn-danger btn-sm quote" href="#"> {{__('Request A Quote')}} <img id="loader" class="pull-right" width="35" style="display: none;" src="{{asset('images/ellipsis.gif')}}" alt="loading"></a>
           <div id="alert" style="display: none; margin-top: 5px;" >
           </div>
         </div>
         @endforeach 
         <div class="clearfix spacer-50"></div>
         @endforeach
         @endif
         

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
           <!--  <a class="link" href="{{route('frontend.product',$product->slug)}}"> Read more </a>-->
           <input type="text" hidden value="{{route('addToCart',$product->id)}}" name="">
           <a  class="btn btn-danger btn-sm quote" href="#"> {{__('Request A Quote')}} <img id="loader" class="pull-right" width="35" style="display: none;" src="{{asset('images/ellipsis.gif')}}" alt="loading"></a>
           <div id="alert" style="display: none; margin-top: 5px;" >
           </div>
         </div>
         @endforeach 
         <div class="clearfix spacer-50"></div>
         @endforeach
         @else
         <span>No Products</span>
         <div class="clearfix spacer-50"></div>
         @endif

         @endforeach
         







       </div>
     </section>

   </div>

   <div class="col-md-3 sidebar left">

    <h3 class="sidebar-title">{{__('Categories')}}</h3>

    @if (isset($categories) && count($categories) > 0)
    <ul id="tree" class="treeview">
     @foreach ($categories->sortBy('sort_order') as $category)
     @include('frontend.category', $category)
     @endforeach
   </ul>
   @else
   <span>No categories</span>
   @endif






 </div>
</div>
</div>



</div>
<div class="spacer-50"></div>

</main>
@endsection

@section('scripts')
<script>                                                                               





</script>       
@endsection


