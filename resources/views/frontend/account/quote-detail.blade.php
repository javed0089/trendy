 @extends('layouts.main')

 @section('title','My Quotes')

 @section('styles')
 <link href="{{asset('css/parsley.css')}}" rel="stylesheet">
 @endsection
 @section('content') 

 <!-- Main Content Section -->
 <main class="main">



  <div class="container">

    <div class="row about-sidebar">
      <div class="spacer-40"></div>
      <div class="col-md-10 about-content">
       @if ($message = Session::get('success'))
       <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
      </div>
      @endif
      @if ($error = Session::get('error'))
      <div class="alert alert-danger">
        <strong>{{ $error }}</strong>
      </div>
      @endif
      @if (count($errors) > 0)
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
      <div class="panel-div">
        <div class="panel-title">{{__('Quotation')}}</div>
        <div class="content">
          <div class="row">
            <div class="col-md-4">
              <h4>{{__('Quote No.')}} : <span >{{$myquote->quote_no}}</span></h4>
              <h4>{{__('Status')}} : <span>{{$myquote->Status->status_en}}</span></h4>

            </div>

            <div class="col-md-4">
              <h4>{{__('Dated')}} : <span>{{date('M j, Y',strtotime($myquote->created_at))}}</span></h4>

              <h4>{{__('Valid Until')}} :<span>{{isset($myquote->quote_validity)?date('M j, Y H:i',strtotime($myquote->quote_validity)):''}}</span></h4>
            </div>
            <div class="col-md-2 pull-right">
             <div style="margin-bottom: 3px;">
              @if(count($myquote->Order)==0 && $myquote->status == 3)
              <form action="{{route('myorders.makeOrder',$myquote->id)}}" class="single-click-form" method="Post" data-parsley-validate>
                {{csrf_field()}}
                <button class="btn btn-success btn-sm btn-block">{{__('Make Order')}}</button>
              </form>
              @endif
            </div>
            @if($myquote->status == 3)
            <a target="_blank" href="{{route('quotes.download',$myquote->id)}}" class="btn btn-primary btn-sm btn-block"><i class="fa fa-file-pdf-o"></i>  {{__('Download')}}</a>
            @endif

          </div>
        </div>

      </div>

      <div class="table-responsive"> 
        <table class="table table-striped">
          <thead>
           <tr>
            <th>{{__('Product')}}</th>
            <th>{{__('Qty.')}}</th>
            <th>{{__('Unit')}}</th>
            <th>{{__('Price')}}</th>
            <th>{{__('Currency')}}</th>
            <th>{{__('P.O.D.')}}</th>
            <th>{{__('D.T.')}}</th>
            <th>{{__('P.M.')}}</th>
            <th>{{__('S.D.')}}</th>
            <th>{{__('Status')}}</th>

          </tr>
        </thead>
        <tbody>
          @foreach($myquote->QuoteDetails as $quote)
          <tr>
            <td>{{$quote->Product->name_en}}</td>
            <td>{{$quote->quantity}}</td>
            <td>{{$quote->unit}}</td>
            <td> @if($myquote->status == 3)
              {{isset($quote->price)?$quote->price:'n/a'}}
              @endif
            </td>
            <td>@if($myquote->status == 3) {{$quote->currency}} @endif</td>
            <td>{{$quote->port_of_delivery}}</td>
            <td>{{$quote->delivery_terms}}</td>
            <td>{{$quote->payment_method}}</td>
            <td>
              {{$quote->shipping_doc_invoice=='1'?'Invoice,':''}}
              {{$quote->shipping_doc_packing_list=='1'?'Packing List,':''}}
              {{$quote->shipping_doc_co=='1'?'CO,':''}}
              {{$quote->shipping_doc_others=='1'?'Others,':''}}
              {{$quote->shipping_doc_others_text}}

            </td>
            <td>{{$quote->Status->status_en}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <div class="spacer-40"></div>
  <div class="comments1">

    <h3 class="title-2 text-center"> {{count($myquote->QuoteComments->where('is_private','==','0'))}} {{__('Comments')}}</h3>
    <div class="message-box" >
      @foreach($myquote->QuoteComments->sortByDesc('created_at')->where('is_private','==','0') as $quoteComment)
      <div class="{{$quoteComment->User->UserRole($quoteComment->User->id) == 'Subscriber'?'message1':'message2'}}">
        <i class="fa fa-user-circle"></i>
        <h3>{{$quoteComment->User->first_name}} {{$quoteComment->User->last_name}} <span {{$quoteComment->User->UserRole($quoteComment->User->id) == 'Subscriber'?'dir="rtl"':''}}>{{date('M j, Y H:i',strtotime($quoteComment->created_at))}}</span> </h3>
        <p>{{$quoteComment->comment}}</p>
      </div>
      @endforeach
    </div>

  </div>

  <div class="comment-box">
    <h2 class="title-2 text-center"> {{__('Add Comment')}} </h2>

    <form  action="{{route('quotes.update',$myquote->id)}}" method="POST"  class="commentform single-click-form" data-parsley-validate>
      {{csrf_field()}}
      {{ method_field('PATCH') }}
      <div class='row'>
        <div id="comment-message" class="col-md-12">
          <textarea id="comment" required class="form-control" name="comment" placeholder="{{__("Message")}}" ></textarea>
        </div>
        <div class="comment-btn col-md-12">
          <button  type="submit" name="submit" value="addComment" class="btn btn-block btn-warning"> {{__("ADD COMMENT")}} </button>
        </div>
      </div>
    </form>

  </div>

</div>

<div class="col-md-2 sidebar left" style="padding:0;">
  <div class="sidebar-blog-categories">
    @include('partials._acct-sidebar')
  </div>

</div>

</div>

</div>
</main>
<!-- Main Content Section -->





@endsection


@section('scripts')
<!-- parsley JS -->
<script src="{{asset('js/parsley.min.js')}}"></script>
@if(LaravelLocalization::getCurrentLocale()=='ar')
<script src="{{asset('js/parsley/ar.js')}}"></script>
@endif

@endsection
