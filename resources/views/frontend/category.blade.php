

@if (count($category['Children']) > 0)

<li {{ Request::is('*/category/'.$category->slug)?"class=active":'' }}> <a  href="{{route('frontend.productlist',$category->slug)}}"><span>{{ $category->{lang_col('name')} }}</span></a>
	 @else
	    <li {{ Request::is('*/category/'.$category->slug)?"class=active":'' }}> <a  href="{{route('frontend.productlist',$category->slug)}}"><span>{{ $category->{lang_col('name')} }}</span> </a> 
@endif
	@if (count($category['Children']) > 0)
	    <ul>
	    @foreach($category['Children'] as $category)
	        @include('frontend.category', $category)
	    @endforeach
	    </ul>
	    </li>
	 @else
	     </li>
	@endif
		
