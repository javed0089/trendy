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
                        <div class="panel-title">Quotation</div>
                        <div class="content">
                          <div class="row">
                            <div class="col-md-4">
                              <h4>Quote # : <span >{{$myquote->id}}</span></h4>
                              <h4>Status : <span>{{$myquote->Status->status_en}}</span></h4>
                            
                            </div>

                            <div class="col-md-4 text-right">
                              <h4>Dated : <span>{{date('M j, Y',strtotime($myquote->created_at))}}</span></h4>
                             
                               <h4>Valid until :<span>{{isset($myquote->quote_validity)?date('M j, Y H:i',strtotime($myquote->quote_validity)):''}}</span></h4>
                             </div>
                              <div class="col-md-2 pull-right text-right">
                             <div style="margin-bottom: 3px;">
                              @if(count($myquote->Order)==0 && $myquote->status == 3)
                              <form action="{{route('myorders.makeOrder',$myquote->id)}}" method="Post">
                                {{csrf_field()}}
                                <button class="btn btn-success btn-sm btn-block">Make Order</button>
                             </form>
                             @endif
                             </div>
                              @if($myquote->status == 3)
                             <a  href="{{route('quotes.download',$myquote->id)}}" class="btn btn-primary btn-sm btn-block">Download</a>
                             @endif

                            </div>
                           </div>

                        </div>
                       
                       
                        <table class="table table-striped">
                              <thead>
                                 <tr>
                                    <th>Product</th>
                                    <th>Qty.</th>
                                    <th>Unit</th>
                                    <th>Price</th>
                                    <th>P.O.D.</th>
                                    <th>D.T.</th>
                                    <th>P.M.</th>
                                    <th>S.D.</th>
                                    <th>Validity</th>
                                    <th>Status</th>
                                    
                                 </tr>
                              </thead>
                              <tbody>
                              @foreach($myquote->QuoteDetails as $quote)
                                  <tr>
                                      <td>{{$quote->Product->name_en}}</td>
                                      <td>{{$quote->quantity}}</td>
                                      <td>{{$quote->unit}}</td>
                                      <td>{{isset($quote->price)?$quote->price:'n/a'}}</td>
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
                                      <td>{{isset($quote->quote_validity)?date('M j, Y H:i',strtotime($quote->quote_validity)):''}}</td>
                                      <td>{{$quote->Status->status_en}}</td>
                                  </tr>
                                @endforeach
                              </tbody>
                          </table>
                         </div>

                            <div class="spacer-40"></div>
                             <div class="comments">

                                <h3 class="title-2 text-center"> {{count($myquote->QuoteComments)}} Comments</h3>
                                @foreach($myquote->QuoteComments->sortByDesc('created_at') as $quoteComment)
                                <div class="comments-single">
                                    <i class="fa fa-user-circle"></i>
                                    <h3>{{$quoteComment->User->first_name}} {{$quoteComment->User->last_name}} <span>{{date('M j, Y H:i',strtotime($quoteComment->created_at))}}</span> </h3>
                                    <p>{{$quoteComment->comment}}</p>
                                </div>
                                 @endforeach

                               
                            </div>

                            <div class="comment-box">
                                <h2 class="title-2 text-center"> Add Comment </h2>

                                <form action="{{route('quotes.update',$myquote->id)}}" method="POST"  class="commentform">
                                  {{csrf_field()}}
                                  {{ method_field('PATCH') }}
                                    <div class='row'>
                                        <div id="comment-message" class="col-md-12">
                                            <textarea id="comment" class="form-control" name="comment" placeholder="Message" required></textarea>
                                        </div>
                                        <div class="comment-btn col-md-12">
                                            <button type="submit" name="submit" value="addComment" class="btn btn-block btn-warning"> ADD COMMENT </button>
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
