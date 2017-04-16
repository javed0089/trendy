<div class="main-header container-fluid main-menu" style="z-index: 1000">
   <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
                <span class="sr-only"> Main Menu </span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            
    <div class="row mobile--relative">
        <div class="container">
        <div id="smallLogo" class="small-logo">
            <a  class="" href="/"><img src="{{asset('images/logo2.png')}}" width="130" height="45" alt="Gap-Polymers Logo" /></a>
            </div>
            <nav class="nav--primary">
            
                <ul id="menu-main-menu" class="menu">
                    <li id="menu-item-3500" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3500"><a href="/">{{__('Home')}} </a></li> 
                    <li id="menu-item-1505" class="mega-menu menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-1505">
                        <a href="{{route('frontend.categories')}}">{{__('Products')}}</a>
                        <ul class="sub-menu">
                            @if(isset($menuParentCats))
                            @foreach($menuParentCats as $menuParentCat)
                            <li id="menu-item-2987" class="menu-item menu-item-type-post_type menu-item-object-cat_industry menu-item-has-children menu-item-2987">
                                <a href="{{route('frontend.productlist',$menuParentCat->slug)}}">{{$menuParentCat->{lang_col('name')} }}</a>
                                 <ul class="sub-menu">
                                    @if(isset($menuProducts))
                                        <?php $var = '0'; ?>
                                        @foreach($menuProducts as $key=>$menuProduct)
                                            @if ( $menuProduct->category_id == $menuParentCat->id )
                                                @if($var==0)
                                                   <li class="menu-item-type-custom menu-item-object-custom menu-item-2987-1">
                                                    <a href="{{route('frontend.productlist',$menuParentCat->slug)}}">Grades</a>
                                                     <ul class="sub-menu">
                                                @endif
                                                <li id="menu-item-2043" class="menu-item-2043"><a href="{{route('frontend.product',$menuProduct->slug)}}">{{$menuProduct->{lang_col('name')} }}</a></li>
                                                 <?php $var++; ?>
                                            @endif
                                        @endforeach
                                        @if($var>0)
                                            </ul>
                                            </li>
                                       @endif
                                    @endif    
                                    
                                    @if(isset($menuSubCats))
                                    @foreach($menuSubCats as $menuSubCat)
                                         @if ( $menuSubCat->parent_id == $menuParentCat->id )
                                            <li class="menu-item-type-custom menu-item-object-custom menu-item-2987-1">
                                            <a href="{{route('frontend.productlist',$menuSubCat->slug)}}">{{$menuSubCat->{lang_col('name')} }}</a>
                                                <ul class="sub-menu">
                                                     @if(isset($menuProducts))
                                                        @foreach($menuProducts as $menuProduct)
                                                            @if ( $menuProduct->category_id == $menuSubCat->id )
                                                                <li id="menu-item-2" class="menu-item-2"><a href="{{route('frontend.product',$menuProduct->slug)}}">{{$menuProduct->{lang_col('name')} }}

                                                                </a></li>
                                                            @endif
                                                        @endforeach
                                                    @endif    
                                                </ul>
                                                
                                                <!--Level 3 -->
                                                @foreach($menuSubCats as $menuSubCatLevel3)
                                                    @if ( $menuSubCatLevel3->parent_id == $menuSubCat->id )
                                                        <li style="padding-left: 30px;" class="menu-item-type-custom menu-item-object-custom menu-item-2987-1">
                                                            <a href="{{route('frontend.productlist',$menuSubCatLevel3->slug)}}">{{$menuSubCatLevel3->{lang_col('name')} }}</a>
                                                            <ul class="sub-menu">
                                                                @if(isset($menuProducts))
                                                                    @foreach($menuProducts as $menuProduct)
                                                                        @if ( $menuProduct->category_id == $menuSubCatLevel3->id )
                                                                            <li id="menu-item-2" class="menu-item-2">
                                                                                <a href="{{route('frontend.product',$menuProduct->slug)}}">{{$menuProduct->{lang_col('name')} }}
                                                                                    </a>
                                                                             </li>
                                                                        @endif
                                                                    @endforeach
                                                                @endif    
                                                            </ul>
                                                        </li>
                                                    @endif
                                                @endforeach

                                            </li>
                                         @endif
                                    @endforeach
                                    @endif
                                   
                                </ul>
                            </li>
                            @endforeach
                             <li>
                                <a href="{{route('frontend.categories')}}">All Categories >></a>
                            </li>
                            @endif
                           

                        </ul>
                    </li>
                    @if(count($menuServices))
                        <li id="menu-item-3499" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-3499">
                            <a href="#">{{__('Service')}}</a>
                            <ul class="sub-menu">
                                @foreach($menuServices as $service)
                                    <li id="menu-item-3522" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3522"><a href="{{route('frontend.services',$service->slug)}}">{{$service->{lang_col('name')} }}</a></li>
                                @endforeach
                            </ul>
                        </li>
                    @endif

                    <li id="menu-item-3501" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-3501">
                        <a href="{{route('frontend.about')}}">{{__('Who we are')}}</a>
                        <ul class="sub-menu">
                            <li id="menu-item-3502" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3502"><a href="{{route('frontend.about')}}">{{__('The Company')}}</a></li>
                            <li id="menu-item-3503" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3503"><a href="{{route('frontend.industry')}}">{{__('About Industry')}}</a></li>
                            <li id="menu-item-3504" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3504"><a href="{{route('frontend.mission')}}">{{__('Mission & Vision')}}</a></li>
                            <li id="menu-item-3505" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3505"><a href="{{route('frontend.approach')}}">{{__('Our Approach')}}</a></li>
                            <li id="menu-item-3506" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3506"><a href="{{route('frontend.contact')}}">{{__('Locations')}}</a></li>
                            <li id="menu-item-3507" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3507"><a href="{{route('frontend.team')}}">{{__('Our Team')}}</a></li>
                        </ul>
                    </li>
                    <li id="menu-item-3500" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3500"><a href="{{route('frontend.careers')}}">{{__('Career')}}</a></li>
                    <li id="menu-item-3500" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3500"><a href="{{route('frontend.news')}}">{{__('News & Media')}}</a></li>
                    <li id="menu-item-3500" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3500"><a href="{{route('frontend.blogs')}}">{{__('Blog')}}</a></li>
                    <li id="menu-item-3500" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3500"><a href="{{route('frontend.contact')}}">{{__('Contact')}}</a></li>


 <li id="menu-item-3500" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3500 hidden-lg hidden-md"><a href="{{ route('cart')}}"><i class="fa fa-shopping-cart" aria-hidden="true"></i> {{__('Cart')}} <span class="badge">{{ Session::has('cart')? count(Session::get('cart')->items):''}}</span></a></li>

 @if(Sentinel::check())
          <li id="menu-item-3501" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children menu-item-3501 hidden-lg hidden-md">
            <a href="#">{{Sentinel::getUser()->first_name}} {{Sentinel::getUser()->last_name}}</a>
            <ul class="sub-menu">
              <li id="menu-item-3502" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3502"><a href="{{route('user.show',User::getId())}}">{{__('My Account')}}</a></li>
              <li id="menu-item-3502" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3502"><a href="{{route('quotes.index')}}">{{__('My Quote Requests')}}</a></li>
              <li id="menu-item-3502" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3502"><a href="{{route('myorders.index')}}">{{__('My Orders')}}</a></li>
             
              <li id="menu-item-3502" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3502"><a href="#" onclick="document.getElementById('logout-form').submit()" >{{__('Logout')}}</a>
              </li>
            </ul>
            <form action="{{route('frontend.logout')}}" method="post" id="logout-form">
                       {{csrf_field()}}
            </form>
          </li>
         @else
                    <li id="menu-item-3500" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3500 hidden-lg hidden-md"><a href="{{route('frontend.register')}}">{{__('Register')}}</a></li>
                    <li id="menu-item-3500" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3500 hidden-lg hidden-md"><a href="{{route('frontend.login')}}">{{__('Login')}}</a></li>

@endif
                    <li id="menu-item-3500" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3500 hidden-lg hidden-md"><a rel="alternate" hreflang="en" href="{{LaravelLocalization::getLocalizedURL('en') }}">English</a></li>
                    <li id="menu-item-3500" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-3500 hidden-lg hidden-md"><a rel="alternate" hreflang="ar" href="{{LaravelLocalization::getLocalizedURL('ar') }}">العربية</a></li>
                    
                </ul>
            </nav>
        </div>


    </div>
</div>

