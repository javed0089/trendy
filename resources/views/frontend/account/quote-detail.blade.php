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
                            <div class="col-md-6">
                              <h4>Quote # : <span >{{$myquote->id}}</span></h4>
                              <h4>Status : <span>{{$myquote->Status->status}}</span></h4>
                            
                            </div>
                            <div class="col-md-6 pull-right text-right">
                              <h4>Dated : <span>{{date('M j, Y',strtotime($myquote->created_at))}}</span></h4>
                             
                               <h4>Valid until :<span>{{isset($myquote->quote_validity)?date('M j, Y H:i',strtotime($myquote->quote_validity)):''}}</span></h4>
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
                              @foreach($myquote->QuoteDetails()->get() as $quote)
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
                                      <td>{{$quote->Status->status}}</td>
                                  </tr>
                                @endforeach
                              </tbody>
                          </table>
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
