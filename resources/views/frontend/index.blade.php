@extends('layouts.main')
@section('title','Home')

@section('styles')
<link href="{{asset('css/starrr.css')}}" rel="stylesheet">
@endsection

@section('content')
@if($SlidersBlock->first()->page->status)
<section class="home-slider">
    <div class="flexslider">
        <ul class="slides">
            @foreach($SlidersBlock as $SliderBlock)
            <li class="has-overlay">
                @if($SliderBlock->image_en)
                <img src="{{$SliderBlock->{lang_col('image')} }}" alt="{{$SliderBlock->{lang_col('title')} }}" />
                @else
                <img src="http://placehold.it/1246x333" alt="{{$SliderBlock->{lang_col('title')} }}" />
                @endif

                <div class="slider-content">
                    <div class="container">
                        <h2> {!!$SliderBlock->{lang_col('title')} !!}</h2>
                        <p>
                           {!!$SliderBlock->{lang_col('content')} !!}
                       </p>
                       <a class="btn primary-btn"> {{__('KNOW MORE')}} <i class="fa fa-angle-right"></i> </a>
                   </div>
               </div>
           </li>
           @endforeach   

           @if(!$SlidersBlock || count($SlidersBlock)<1)
           <li class="has-overlay">
            <img src="images/slides/slide2.jpg" alt="Slider 2" />
            <div class="slider-content">
                <div class="container">
                    <h2>Default Slide &amp; Transport</h2>
                    <p>
                        Quickly disintermediate collaborative web services via high standards in products.
                        <br> Compellingly fabricate cutting-edge portals through alternative
                        <br> opportunities. Objectively customize.
                    </p>
                    <a class="btn primary-btn"> KNOW MORE <i class="fa fa-angle-right"></i> </a>
                </div>
            </div>
        </li>
        @endif  
    </ul>
</div>
</section>
@endif

<section class="home-services">
    <div class="container">
        <div class="row services">
            @if(count($products)>0)
            @foreach($products as $product)
            <div class="col-md-4">
                <div class="hover-effect">
                    @if(count($product->Images)>0)
                    <img src="{{asset($product->Images->first()->filename)}}" alt="" />
                    @else
                    <img src="http://placehold.it/363x272" alt="" />
                    @endif                                

                </div>
                <h4 class="services-title-one subtitle"><a href="{{route('frontend.product',$product->slug)}}"> {{$product->{lang_col('name')} }}</a></h4>
                <p>{!!str_limit($product->{lang_col('desc')},350)!!}</p>
                <a class="btn btn-danger btn-sm" href="{{route('addToCart',$product->id)}}"> {{__('Add to Quote')}} </a>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</section>


<section class="home-links">
    <div class="container">
        <div class="row links">
            <div class="col-md-2">
                <h4 class="links-title subtitle">{{__('Quick Links')}}</h4>
            </div>
            <div class="col-md-2">
                <a href="{{route('frontend.categories')}}" class="btn btn-primary" role="button">{{__("PRODUCTS")}}</a>
            </div>
            <div class="col-md-2">
                <a href="#" class="btn btn-primary" role="button">{{__('CONTACT')}}</a>
            </div>
            <div class="col-md-2">
                <a href="#" class="btn btn-primary" role="button">{{__('SERVICES')}}</a>
            </div>
            <div class="col-md-2">
                <a href="#" class="btn btn-primary" role="button">{{__('INDUSTRY')}}</a>
            </div>
            <div class="col-md-2">
                <a href="{{route('frontend.news')}}" class="btn btn-primary" role="button">{{__('LATEST NEWS')}}</a>
            </div>
        </div>
    </div>
</section>


<section class="home-services-other">
    <div class="container">
        <div class="section-title text-center">
            <h2 class="title-services-other title-2">{{__('Categories')}}</h2>
            <h4 class="subtitle-services-other subtitle-2">
                @if(count($homepageCategoryText)>0)
                {!!nl2br($homepageCategoryText->first()->{lang_col('value')} )!!}
                @endif
            </h4>
            <div class="spacer-50"> </div>
        </div>
        <div class="row services-other">
            @if(isset($categories))
            @foreach($categories->chunk(3) as $categoryChunk)
            @foreach($categoryChunk as $category)
            <div class="col-sm-4">
                <div class="img-box">
                    @if($category->logo)
                    <img src="{{$category->logo}}" alt="{{$category->{lang_col('name')} }}" />
                    @else
                    <img src="http://placehold.it/50x66" alt="{{$category->{lang_col('name')} }}" />
                    @endif
                </div>
                <div class="services-info">
                    <h4 class="services-title-one subtitle"><a href="{{route('frontend.productlist',$category->slug)}}">{{$category->{lang_col('name')} }}</a></h4>
                    <p>{!! str_limit($category->{lang_col('desc')},50) !!}</p>
                </div>
            </div>
            @endforeach 
            <div class="clearfix spacer-50"></div>
            @endforeach
            @endif

        </div>
    </div>
</section>

@if($CompBlock->page->status)
<section class="home-company">
    <div class="container">
        <div class="row company">
            <div class="col-md-5 col-sm-8">
                <div class="company-details">
                    <h2 class="company-title color-title"> {{$CompBlock?$CompBlock->{lang_col('title')}:'No data'}} </h2>
                    <h4 class="company-subtitle subtitle">{{$CompBlock?$CompBlock->{lang_col('heading1')}:'No data'}} </h4>
                    <p> {!!$CompBlock?$CompBlock->{lang_col('content')}:'No data'!!}</p>
                    <a href="{{route('frontend.mission')}}" class="btn btn-primary" role="button"> {{__('READ OUR MISSION')}} </a>
                </div>
            </div>
            <div class="col-md-7 col-sm-12">
                <div class="company-image">
                    <div class="img-left hover-effect">
                        @if($CompBlock->{lang_col('image')})
                        <img src="{{$CompBlock->{lang_col('image')} }}" alt="" />
                        @else
                        <img src="http://placehold.it/555x368" alt="" />
                        @endif

                    </div>
                    <div class="img-right hover-effect">
                       @if($CompBlock->{lang_col('image')})
                       <img src="{{$CompBlock->{lang_col('image')} }}" alt="" />
                       @else
                       <img src="http://placehold.it/555x368" alt="" />
                       @endif
                   </div>
               </div>
           </div>
       </div>
   </div>
</section>
@endif

@if(isset($ServBlock))
@if($ServBlock->page->status)
<section class="home-process">
    <div class="container">
        <div class="row process">
            <div class="col-sm-6">
                <h2 class="process-title title-2"> {{$ServBlock?$ServBlock->{lang_col('title')}:'No data'}} </h2>
                <h4 class="process-subtitle subtitle-2"> {{$ServBlock?$ServBlock->{lang_col('heading1')}:'No data'}} </h4>
                <p> {!!$ServBlock?$ServBlock->{lang_col('content')}:'No data'!!} </p>
                <button type="button" class="btn btn-primary" role="button" data-toggle="modal" data-target="#rateService">{{__('RATE OUR SERVICE')}} </button>
            </div>
            <div class="col-sm-6">
                <div id="skills" class="process-bar">
                    <div class="skillbar-title"> Excellent </div>
                    <div class="skillbar" data-percent="{{$ratings->excellent()}}%">
                        <div class="skillbar-bar"> </div>
                        <div class="skill-bar-percent">{{$ratings->excellent()}}%</div>
                    </div>
                    <div class="skillbar-title"> Good</div>
                    <div class="skillbar" data-percent="{{$ratings->good()}}%">
                        <div class="skillbar-bar"> </div>
                        <div class="skill-bar-percent">{{$ratings->good()}}%</div>
                    </div>
                    <div class="skillbar-title"> Average </div>
                    <div class="skillbar" data-percent="{{$ratings->average()}}%">
                        <div class="skillbar-bar"> </div>
                        <div class="skill-bar-percent">{{$ratings->average()}}%</div>
                    </div>
                    <div class="skillbar-title">Poor </div>
                    <div class="skillbar" data-percent="{{$ratings->poor()}}%">
                        <div class="skillbar-bar"> </div>
                        <div class="skill-bar-percent">{{$ratings->poor()}}%</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="rateService" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="panel-div">
                <div class="panel-title">RATE OUR SERVICE
                    <span class="pull-right"><a class="btn btn-xs btn-primary" data-dismiss="modal">x</a></span>
                </div>
                <div class="content">
                    <div class="row">

                        <div class="spacer-50"></div>
                        <div class="col-md-6 col-md-offset-3 text-center"> 
                        <form  role="form"  method="Post"  action="{{route('frontend.rateservice')}}">
                        {{csrf_field()}}
                       
                            <div id='star' class="star"></div>
                            <input id="rating" hidden type="text" required  name="rating" value="">
                        </div>
                        <div class="spacer-60"></div>
                        <div class="col-md-4 col-md-offset-4">
                            <button type="submit" class="btn btn-md btn-block btn-primary">RATE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endif
@endif




<section class="home-stats">
    <div class="container">
        <div class="row stats">
            @foreach($stats as $stat)
            <div class="col-md-3 col-xs-6">
                @if($stat->image)
                <img src="{{asset($stat->image)}}" alt="" />
                @else
                <img src="http://placehold.it/60x48" alt="" />
                @endif
                <div class="stats-info">
                    <h4 class="counter">{{$stat->{lang_col('value')} }}</h4>
                    <p>{{$stat->{lang_col("title")} }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>


@if(isset($PubBlocks))
@if(count($PubBlocks))
@if($PubBlocks->first()->page->status)
<section class="home-publications">
    <div class="container">
        <div class="row publications">
            <div class="col-md-7 col-sm-6">
                <div class="panel-group" id="accordion">
                    @foreach($PubBlocks as $key=>$PubBlock)
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$key}}">{{ $PubBlock->{lang_col('title')} }}</a>
                            </h4>
                        </div>
                        <div id="collapse{{$key}}" class="panel-collapse collapse{{$key==0?' in':''}}">
                            <div class="panel-body">
                                <p>{!!$PubBlock->{lang_col('content')} !!}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach  
                </div>
            </div>
            <div class="col-md-5 col-sm-6">
                <div class="plubication-downloads">
                    <h2 class="publish">{{__('Our Profile & Contacts')}}</h2>
                    <div class="download-file">
                        <a href="downloads/profile.pdf" target="_blank"> <i class="fa fa-file-pdf-o" aria-hidden="true"></i> {{__('Download PDF')}} <span>1.5 MB</span> </a>
                    </div>
                    <div class="download-file">
                        <a href="#"> <i class="fa fa-qrcode " aria-hidden="true"></i> {{__('Sales Contact Details')}} </a>
                    </div>
                    <div class="contact-map">

                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
@endif
@endif
@endif

<section class="home-testimonials">
    <div class="container">
        <div class="section-title text-center">
            <h2 class="title-testimonials color-title">{{__('DON’T TAKE OUR WORD')}}</h2>
            <h2 class="subtitle-testimonials title-2">{{__('CLIENT TESTIMONIALS')}}</h2>
            <div class="spacer-50"> </div>
        </div>
        <div class="row">
            @if(isset($testimonials))
            @foreach($testimonials as $testimonial)
            <div class="col-md-4">
                <blockquote>{{strip_tags($testimonial->{lang_col('quote')})}}</blockquote>
                <h4 class="client-name">{!!$testimonial->{lang_col('client_name')} !!}</h4>
                <p class="designation">{!!$testimonial->{lang_col('location')} !!}</p>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</section>


<section class="home-news">
    <div class="container">
        <div class="section-title text-center">
            <h2 class="title-blog color-title"> {{__('NEWS AND MEDIA')}} </h2>
            <h2 class="subtitle-blog title-2"> {{__('LATEST FROM BLOG')}} </h2>
            <div class="spacer-50"> </div>
        </div>
        <div class="row news">
            @foreach($posts as $post)
            <div class="col-md-4">
                <div class="blog-img-box">
                    <div class="blog-date"> <span class="month">{{date('M',strtotime($post->created_at))}} </span> <span class="date">{{date('d',strtotime($post->created_at))}}</span> </div>
                    <a class="hover-effect" href="{{route('frontend.post',$post->slug)}}">
                        @if($post->image) 
                        <img src="{{asset($post->image)}}" width="362" height="292" alt="" />
                        @else
                        <img src="http://placehold.it/360x292" alt="" />
                        @endif 
                    </a>
                </div>
                <div class="blog-content">
                    <h3><a href="{{route('frontend.post',$post->slug)}}"> {{$post->title_en}} </a> </h3>
                    <p>{{__('By')}} <a href="#">{{$post->{lang_col('author')} }}</a> {{__('in')}} {{$post->BlogCategory->{lang_col('name')} }}</p>
                </div>
            </div>
            @endforeach

        </div>
        <div class="blog-btn text-center">
            <a href="{{route('frontend.blogs')}}" class="btn btn-primary" role="button">{{__('READ THE BLOG')}}</a>
        </div>
    </div>
</section>


<section class="home-partners">
    <div class="container" dir="ltr">
        <div class="section-title text-center">
            <h2 class="subtitle-testimonials title-2"> {{__('OUR BRANDS')}} </h2>
            <div class="spacer-20"> </div>
        </div>
        <div class="row partners">
            <div class="logo-slides slides owl-carousel">
                @foreach($brands as $brand)
                <div class="item">
                    <div class="partner-images">
                        @if($brand->logo)
                        <img src="{{asset($brand->logo)}}" height="80" width="180" alt="{{$brand->{lang_col('name')} }}">
                        @else
                        <img src="http://placehold.it/180x80" height="80" width="180" alt="{{$brand->{lang_col('name')} }}">
                        @endif
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</section>

@if(isset($CeoBlock))
@if($CeoBlock->page->status)
<section class="home-ceo">
    <div class="container">
        <div class="row ceo">
            <div class="col-md-6">
                <div class="ceo-photo">
                    @if($CeoBlock->{lang_col('image')})
                    <img src="{{ $CeoBlock->{lang_col('image')} }}" alt="" />
                    @else
                    <img src="http://placehold.it/474x474" alt="" />
                    @endif
                </div>
            </div>
            <div class="col-md-6">
                <div class="ceo-details">
                    <h2 class="ceo-title color-title">{{$CeoBlock?$CeoBlock->{lang_col('title')}:'No data'}}  </h2>
                    <h4 class="ceo-subtitle subtitle"> {{$CeoBlock?$CeoBlock->{lang_col('heading1')}:'No data'}} </h4>
                    <p>
                       {!! $CeoBlock?$CeoBlock->{lang_col('content')}:'No data' !!}</p>
                   </div>
               </div>
           </div>
       </div>
   </section>
   @endif
   @endif

   @endsection
   @section('scripts')

   <script src="{{asset('js/stars.min.js')}}"></script>
   <script type="text/javascript">

     $('#star').stars({
      stars: 4,
      text: ['Poor', 'Average', 'Good','Excellent'],
      color: '#ffda44',
      starClass  : 'star',
      click: function(index) {
        $('#rating').val(index);
}
});
</script>
@endsection