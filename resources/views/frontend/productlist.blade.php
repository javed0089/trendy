 @extends('layouts.main')

 @section('title','Product List - '.count($products)>0?$products->first()->Category->{lang_col('name')}:'')


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
								 @foreach($products->chunk(3) as $productsChunk)
	                                @foreach($productsChunk as $product)
	                                    <div class="col-md-4 col-sm-4">
	                                        <a href="{{route('frontend.product',$product->slug)}}" class="hover-effect">
	                                            @if($product->Images && count($product->Images))
	                                                <img src="{{asset($product->Images->first()->filename)}}" alt="{{$product->{lang_col('name')} }}" />
	                                            @else
	                                                <img src="http://placehold.it/350x260" alt="{{$product->{lang_col('name')} }}" />
	                                            @endif
	                                        </a>
	                                        <h4 class="subtitle services-title-one">{{$product->{lang_col('name')} }}</h4>
	                                        <p>{!!str_limit($product->{lang_col('desc')},180)!!} </p>
	                                      <!--  <a class="link" href="{{route('frontend.product',$product->slug)}}"> Read more </a>-->
                                            
                                            <a class="btn btn-danger btn-sm" href="{{route('addToCart',$product->id)}}"> {{__('Add to Quote')}} </a>
	                                    </div>
	                                @endforeach 
	                                    <div class="clearfix spacer-50"></div>
	                            @endforeach
	                        @else
	                        	<span>{{__('No Products')}}</span>
	                        @endif



                            


                            </div>
                        </section>

                    </div>

                    <div class="col-md-3 sidebar left">
                    
                        <h3 class="sidebar-title">{{__('Categories')}}</h3>

					 			@if (isset($categories) && count($categories) > 0)
						 			<ul id="tree" class="treeview">
						 				@foreach ($categories as $category)
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
$(document).ready(function() {                                                               
  jQuery("#tree ul").hide();                                                       

  jQuery("#tree li").each(function() {                                                  
    var handleSpan = jQuery("<span></span>");
    handleSpan.addClass("handle");                                       
    handleSpan.prependTo(this);                                          

    if(jQuery(this).has("ul").size() > 0) {                              
      handleSpan.addClass("collapsed");                        
      handleSpan.click(function() {                            
        var clicked = jQuery(this);                  
        clicked.toggleClass("collapsed expanded");   
        clicked.siblings("ul").toggle();             
      });                                                      
    }                                                                    
  });     

    var li = $('#tree li.active');
    //li.parents("li").each(function() {
    // This should iterate through all parent <li>s and the current one too
   //jQuery(this).siblings("span:first").toggleClass("collapsed expanded");
  //this.closest("ul:first").show();
      
//});
//    li.parents().siblings("span:first").toggleClass("collapsed expanded");
  //  li.parent("ul:first").show();
  li.parents("ul").show();
  li.parents().siblings("span").toggleClass("collapsed expanded");;
                                                                           
})                                                                                            










$.fn.extend({
    treed: function (o) {
      
      var openedClass = 'glyphicon-minus-sign';
      var closedClass = 'glyphicon-plus-sign';
      
      if (typeof o != 'undefined'){
        if (typeof o.openedClass != 'undefined'){
        openedClass = o.openedClass;
        }
        if (typeof o.closedClass != 'undefined'){
        closedClass = o.closedClass;
        }
      };
      
        /* initialize each of the top levels */
        var tree = $(this);
        tree.addClass("tree");
        tree.find('li').has("ul").each(function () {
            var branch = $(this);
            branch.prepend("");
            branch.addClass('branch');
            branch.on('click', function (e) {
                if (this == e.target) {
                    var icon = $(this).children('i:first');
                    icon.toggleClass(openedClass + " " + closedClass);
                    $(this).children().children().toggle();
                }
            })
            branch.children().children().toggle();
        });
        /* fire event from the dynamically added icon */
        tree.find('.branch .indicator').each(function(){
            $(this).on('click', function () {
                $(this).closest('li').click();
            });
        });
        /* fire event to open branch if the li contains an anchor instead of text */
        tree.find('.branch>a').each(function () {
            $(this).on('click', function (e) {
                $(this).closest('li').click();
                e.preventDefault();
            });
        });
        /* fire event to open branch if the li contains a button instead of text */
        tree.find('.branch>button').each(function () {
            $(this).on('click', function (e) {
                $(this).closest('li').click();
                e.preventDefault();
            });
        });
    }
});
/* Initialization of treeviews */
$('#tree1').treed();
</script>       
@endsection


