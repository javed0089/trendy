 @extends('layouts.main')

 @section('title','My Orders')


 @section('content') 

 <!-- Main Content Section -->
 <main class="main">



  <div class="container">

    <div class="row about-sidebar">
     <div class="spacer-40"></div>
     <div class="col-md-10 about-content">
       <div class="panel-div">
        <div class="panel-title">{{__('My Orders')}}</div>
        <div class="content">
          <table class="table table-striped">
            <thead>
             <tr>
              <th>{{__('Order No.')}}</th>
              <th>{{__('Date')}}</th>
              <th>{{__('Status')}}</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($orders as $order)
            <tr>
              <td>{{$order->order_no}}</td>
              <td>{{date('M j, Y H:i',strtotime($order->created_at))}}</td>
              <td>{{$order->Status->status_en}}</td>
              <td><a href="{{route('myorders.show',$order->id)}}" class="btn btn-xs btn-default">{{__('View')}}</a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <div class="pull-right">
          {{$orders->links()}}
        </div>
      </div>
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
