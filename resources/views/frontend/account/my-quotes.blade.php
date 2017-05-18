 @extends('layouts.main')

 @section('title','My Quotes')


 @section('content') 

 <!-- Main Content Section -->
 <main class="main">



  <div class="container">

    <div class="row about-sidebar">
     <div class="spacer-40"></div>
     <div class="col-md-10 about-content">
       <div class="panel-div">
        <div class="panel-title">{{__('My Quote Requests')}}</div>
        <div class="content">
          <table class="table table-striped">
            <thead>
             <tr>
              <th>{{__('Quote No.')}}</th>
              <th>{{__('Date')}}</th>
              <th>{{__('Valid Until')}}</th>
              <th>{{__('Status')}}</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($myquotes as $quote)
            <tr>
              <td>{{$quote->quote_no}}</td>
              <td>{{date('M j, Y H:i',strtotime($quote->created_at))}}</td>
              <td>{{isset($quote->quote_validity)?date('M j, Y H:i',strtotime($quote->quote_validity)):''}}</td>
              <td>{{$quote->Status->status_en}}</td>
              <td><a href="{{route('quotes.show',$quote->id)}}" class="btn btn-xs btn-default">{{__('View')}}</a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <div class="pull-right">
          {{$myquotes->links()}}
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
