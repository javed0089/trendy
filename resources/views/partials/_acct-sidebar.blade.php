 <div class="panel-div">
    <div class="panel-title"><i class="fa fa-user"> </i> {{Sentinel::check()->first_name . ' ' . Sentinel::check()->last_name}}</div>
<ul>
    <li> <a href="{{route('quotes.index')}}"> My Quotes </a> </li>
    <li> <a href="{{route('myorders.index')}}"> My Orders </a> </li>
    <li> <a href="#"> Personal Info </a> </li>
</ul>