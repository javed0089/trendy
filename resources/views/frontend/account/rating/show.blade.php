 @extends('layouts.main')

 @section('title','Personal Information')
 @section('styles')
 <link href="{{asset('css/starrr.css')}}" rel="stylesheet">
 @endsection


 @section('content') 

 <!-- Main Content Section -->
 <main class="main">



  <div class="container">

    <div class="row about-sidebar">
     <div class="spacer-40"></div>
     <div class="col-md-10 about-content">
       <div class="panel-div">
        <div class="panel-title">{{__('Overall Service Rating')}}</div>
        <div class="content">
          <div class="row">
           @if(session('error'))
           <div class="alert alert-danger">

            {{session('error')}}

          </div>
          @endif
          @if(session('success'))
          <div class="alert alert-success">

            {{session('success')}}

          </div>
          @endif


          <div class="spacer-30"></div>
          <div class="col-md-6 col-md-offset-3 text-center"> 
            <form  role="form"  method="Post"  action="{{route('rating.update2','0')}}">
              {{csrf_field()}}
              <h4>{{__('Overall Service Rating')}}</h4>
              <div id='star' class="star"></div>
              <input id="rating" hidden type="text"  name="rating" value="{{count($rating)>0? $rating->rating:''}}">
            </div>
            <div class="spacer-30"></div>
            <div class="col-md-4 col-md-offset-4">
              <button type="submit" class="btn btn-md btn-block btn-primary">{{__('RATE')}}</button>
            </div>
          </form>
          




        </div>
      </div>
      <div class="spacer-20"></div>
    </div>
  </div>

  <div class="col-md-2 sidebar left" style="padding:0;">
    <div class="sidebar-blog-categories">
      @include('partials._acct-sidebar')
    </div>
  </div>
</div>

</div>

</div>
</main>
<!-- Main Content Section -->





@endsection

@section('scripts')
<script src="{{asset('js/stars.min.js')}}"></script>
<script type="text/javascript">

 $('#star').stars({
  stars: 4,
  value:$('#rating').val(),
  text: ['Poor', 'Average', 'Good','Excellent'],
  color: '#ffda44',
  starClass  : 'star',
  click: function(index) {
    $('#rating').val(index);
  }
});
</script>
@endsection
