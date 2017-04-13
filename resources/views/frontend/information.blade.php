 @extends('layouts.main')

 @section('title','Information')


 @section('content')

 <main class="main">
   <!-- Page Title -->
    @if(isset($topImage))
                @if($topImage->page->status)
                    <div class="page-title text-center" style="background: url({{isset($topImage->{lang_col('image')})?asset($topImage->{lang_col('image')}):'http://placehold.it/1600x268'}});">
                        <h2 class="title"> {{$information->{lang_col('name')} }} </h2>
                    </div>
                @endif
            @endif
    <!-- Page Title -->

    <!-- Breadcrumbs -->
    <div class="breadcrumbs">
      <div class="container">
        <span class="parent"> <i class="fa fa-home"></i> <a href="/"> {{__('Home')}} </a> </span>
        <i class="fa fa-chevron-right"></i>
        <span class="child"> {{$information->{lang_col('name')} }} </span>
      </div>
    </div>


    <section class="informations-hood">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h4 class="hood-subtitle subtitle-2">{{$information->{lang_col('name')} }}</h4>
            {!!$information->{lang_col('desc')}!!}
          </div>
        </div>
      </div>
    </section>
  </main>
  @endsection


