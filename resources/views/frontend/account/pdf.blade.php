
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Gap-Polymers - Quotation</title>
  <link href="{{public_path('css/bootstrap.min.css')}}" rel="stylesheet">
  <style type="text/css">
    @font-face {
      font-family: "Georgia, serif";
    }

    .clearfix:after {
      content: "";
      display: table;
      clear: both;
    }

    a {
      color: #0087C3;
      text-decoration: none;
    }

html, body {
  height: 100%;
}

#wrap {
  min-height: 100%;
}

#main {
  overflow:auto;
  padding-bottom:150px; /* this needs to be bigger than footer height*/
}
footer {
  border-top: 1px solid #AAAAAA;
  padding: 8px 0;
  text-align: center;
  
  height: 150px;
  clear:both;
  padding-top:20px;
  position:absolute;
  bottom:0;
  width:100%;
}

    body {
 /* position: relative;
  width: 21cm;  
  height: 29.7cm;*/
  margin: 0 auto; 
  color: #555555;
  background: #FFFFFF; 
  font-family: Arial, sans-serif; 
  font-size: 14px; 
  font-family:"Arial";
}

header {
  padding: 10px 0;
  margin-bottom: 20px;
}

#logo {
  float: left;
  margin-top: 8px;
}

#logo img {
  height: 70px;
}

#company {
  float: right;
  text-align: right;
}


#details {
  margin-bottom: 50px;
}

#client {
  padding-left: 6px;
  border-left: 6px solid #0087C3;
  float: left;
  width: 30%;
}

#client .to {
  color: #777777;
}

h2.name {
  font-size: 1.4em;
  font-weight: normal;
  margin: 0;
}
#invoice {
  float: right;
  text-align: right;
  width: 30%;
}

#invoice h1 {
  color: #0087C3;
  font-size: 1.4em;
  line-height: 1em;
  font-weight: normal;
  margin: 0  0 10px 0;
}

#invoice .date {
  font-size: 1.1em;
  color: #777777;
}

table {
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
}
table th{
 border-bottom: 1px solid #000;
 border-top: 1px solid #000;
 padding: 4px 0;

}
table td {
  padding: 10px;
  background: #fff;
  text-align: center;
  border-bottom: 1px solid #FFFFFF;
}
table td span{
  display: block;
  font-weight: bold;
}
table td i{
  font-weight: normal;
}
table th {
  white-space: nowrap;        
  font-weight: normal;
  border: 1px solid black;
}

table td {
  text-align: right;
}

table td h3{
  color: #57B223;
  font-size: 1.2em;
  font-weight: normal;
  margin: 0 0 0.2em 0;
}

table .no {
  text-align: center;
}

table .desc {
  text-align: left;
}

table .unit {
  text-align: center;
}

table .qty {
  text-align: center;

}

table .price {
  text-align: right;

}
table .total {
  text-align: right;
}



table tbody tr:last-child td {
  border: none;
}

table tfoot td {
  padding: 10px 20px;
  background: #FFFFFF;
  border-bottom: none;
  font-size: 1.2em;
  white-space: nowrap; 
  border-top: 1px solid #AAAAAA; 
}

table tfoot tr:first-child td {
  border-top: none; 
}

table tfoot tr:last-child td {
  color: #57B223;
  font-size: 1.4em;
  border-top: 1px solid #57B223; 

}

table tfoot tr td:first-child {
  border: none;
}

#thanks{
  font-size: 2em;
  margin-bottom: 50px;
}

#notices{
  padding-left: 6px;
  border-left: 6px solid #0087C3;  
}

#notices .notice {
  font-size: 1.2em;
}


</style>
</head>
<body>
  <header class="clearfix">
    <div id="logo" class="col-xs-6">
      <img src="{{ public_path().'/images/logo.png' }}" width="220" height="20">
    </div>
    <div id="company" class="col-xs-offset-3 col-xs-3 text-right">
      <h2 class="name">Gap Polymers</h2>
      {{$location->address_en}},{{$location->country_en}}
      <div>{{$location->phone}}</div>
      <div><a href="mailto:{{$location->email}}">{{$location->email}}</a></div>
    </div>
  </div>
</header>
<main>
  <div id="details" class="clearfix col-xs-12">
    <div id="client" class="col-xs-4">
      <div class="to">TO:</div>
      <h2 class="name">{{$myquote->User->first_name}} {{$myquote->User->last_name}}</h2>
      <div class="address">796 Silver Harbour, TX 79273, US</div>
      <div class="email"><a href="mailto:john@example.com">{{$myquote->User->email}}</a></div>
    </div>
    <div class="col-xs-4 text-center">
      <h3>Sales Quotation</h3>
    </div>
    <div id="invoice" class="col-xs-4">
      <h1>Quotation #: {{$myquote->id}}</h1>
      <div class="date">Valid Until: {{$myquote->quote_validity}}</div>
    </div>
  </div>
  <div class="row">
    <div  class="col-xs-12">
      <table  border="0" cellspacing="0" cellpadding="0" >
        <thead>
          <tr>
            <th class="no  col-xs-1">#</th>
            <th class="desc col-xs-6">Product</th>
            <th class="qty  col-xs-1">Quantity</th>
            <th class="unit  col-xs-1">Unit</th>
            <th class="price  col-xs-1">Price</th>
            <th class="total  col-xs-2">Total</th>
          </tr>
        </thead>
        <tbody>
         @foreach($quoteProducts as $quote)

         <tr>
          <td class="no">{{$loop->iteration}}</td>
          <td class="desc"><h3>{{$quote->Product->name_en}}</h3>
            <span><i>Remarks: </i>{{$quote->remarks}}</span>
            <span><i>Port Of Delivery: </i>{{$quote->port_of_delivery}}</span>
            <span><i>Delivery Terms: </i>{{$quote->delivery_terms  }}</span>
            <span><i>Payment Method: </i>{{$quote->payment_method  }}</span>
            <span><i>Shipping Documents: </i>{{isset($quote->shipping_doc_invoice)?'Invoice':'' }},
            {{isset($quote->shipping_doc_packing_list)?'Packing List':'' }},
            {{isset($quote->shipping_doc_co)?'CO':'' }},
            {{isset($quote->shipping_doc_others)?'Others':'' }},
            {{$quote->shipping_doc_others_text}},
            
            </span>
            
          </td>
          <td class="qty">{{$quote->quantity}}</td>
          <td class="unit">{{$quote->unit}}</td>
          <td class="price">{{number_format(floatval($quote->price),2)}}</td>
          <td class="total">{{number_format(floatval($quote->price * $quote->quantity),2)}}
          
          </td>
        </tr>
        @endforeach
      </tbody>
      <tfoot>
        <tr>
          <td colspan="3"></td>
          <td colspan="2">GRAND TOTAL</td>
          <td>{{number_format(floatval($total),2)}}</td>
        </tr>
      </tfoot>
    </table>
  </div></div>
  <div id="thanks">Thank you!</div>
  
  <div id="notices">
    <div>NOTICE:</div>
    <div class="notice">Quotation is only valid before the validty date.</div>
  </div>
</main>
<footer>
  Quotation was created on a computer and is valid without the signature and seal.
</footer>
</body>
</html>