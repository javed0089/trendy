
<!DOCTYPE html>
<html lang="ar">
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
  .row{
    margin:0;
    padding: 0;
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

      height: auto;
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
  color: #000000;
  background: #FFFFFF; 
  font-family: Arial, sans-serif; 
  font-size: 13px; 
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
  color: #0359c1;
}
#company h4 {
  font-weight: bold;
  margin: 0;
}
#company span{
 font-size:13px;
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
  border-spacing: 1;
  margin-bottom: 20px;
}
table th{
 /*border-bottom: 1px solid #000;
 border-top: 1px solid #000;*/
 padding: 4px 0;

}
table td {
  padding: 10px;
  background: #fff;
  text-align: center;
  /*border-bottom: 1px solid #FFFFFF;*/
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
  font-weight: bold;
  font-size: 14px;
  /*border: 1px solid black;*/
}

table td {
  text-align: right;
}

table td h3{
  color: #ff0000;
  font-size: 1.2em;
  font-weight: normal;
  margin: 0 0 0.2em 0;
}

table .no {
  text-align: center;
}

table .desc {
  text-align: left;
  color: #ff0000;
}

table .unit {
  text-align: center;
}

table .qty {
  text-align: center;

}

table .price {
  text-align: right;
  color: #ff0000;

}
table .total {
  text-align: right;
}



table tbody tr:last-child td {
  /*border: none;*/
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
    <div class="row">
      <div id="logo" class="col-xs-6">
        <img src="{{ public_path().'/images/logo.png' }}" width="300" height="50">



      </div>
      <div id="company" class="col-xs-6">
        <!--<h2 class="name" style="font-weight: bold;">شـركــــة الشـامــل الحد يثـــة للبـــلاستيــــك</h2>-->
        <h4>GLOBAL ADVANCE POLYMERS LLC</h4>
        <span>Captain Baraq Tower - Ibrahem Al Raqi St.<br>
          Bagdadiah West - P.O. Box: 24237<br>
          Jeddah 21449 - Kingdom of Saudi Arabia.<br>
          Tel: +966 12 6491516 - Fax: +966 126495242<br>
          Email: info@gap-polymers.com</span>
        </div>
      </div>
      <div class="row" style="margin-top: 10px;" >
        <div style="font-weight: bold; color:#ff0000; padding-left: 15px;" class="col-xs-6" >{{$myquote->quote_no}}</div>

        <div style="font-weight: bold;padding-right: 15px;" class="col-xs-6 text-right" >Dated: <span style="font-weight: bold; color:#ff0000;padding-left: 10px;">{{date('M j, Y',strtotime($myquote->created_at))}}</span></div>
      </div>
      <div class="row">
       <div class="col-xs-offset-4 col-xs-4 text-center">
        <h4 style="margin: 0"><u>Sales Quotation</u></h4>
      </div>
    </div>
  </header>
  <div style="position: relative;">
    <main>
      <div class="col-xs-12">
       <div class="col-xs-1">
        <div class="to">Attn:</div>
        <div class="to">C.I</div>
       </div>
        <div class="col-xs-11">
          <h4 style="margin: 0;color:#ff0000;">MR. {{$myquote->User->first_name}} {{$myquote->User->last_name}}</h4>
          <div style="color:#ff0000;">{{$myquote->User->address}}</div>
          <div style="color:#ff0000;">{{$myquote->User->city}},{{$myquote->User->country}}</div>
          <div style="color:#ff0000;">{{$myquote->User->email}}</div>
          <div style="color:#ff0000;"> {{$myquote->User->telephone}}</a> </div>
        </div>


      </div>
      <div class="row">
        <div  class="col-xs-12">
          <table  border="1" cellspacing="1" cellpadding="1" >
            <thead>
              <tr>
                <th class="col-xs-10">Description</th>

                <th class="col-xs-2">Unit Price /M. Ton</th>
              </tr>
            </thead>
            <tbody>
             @foreach($quoteProducts as $quote)

             <tr>

              <td class="desc">{{$quote->Product->Brand->name_en}} - {{$quote->Product->Category->name_en}} - {{$quote->Product->name_en}} ({{$quote->delivery_terms}} - {{$quote->port_of_delivery}})
              </td>



              <td class="price">{{number_format(floatval($quote->price),2)}} {{$quote->currency}}

              </td>
            </tr>
            @endforeach
          </tbody>

        </table>
      </div>
    </div>
     <div class="row" style="padding-left: 15px;">
    <div>1. Price Valid Till: <span style="color: #ff0000">{{date('M j, Y',strtotime($myquote->quote_validity))}}</span></div>
    <div>2. Deliery of Material is subject to avaliability</div>

    <div style="margin-top: 160px">For: Global Advanced Polymers LLC</div>

    <div style="margin-top: 50px">Authorised Signature </div>
</div>

  </main>

</div>
</body>
</html>