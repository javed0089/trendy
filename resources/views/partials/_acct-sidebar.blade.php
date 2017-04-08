 <div class="panel-div">
    <div class="panel-title"><i class="fa fa-user"> </i> {{Sentinel::check()->first_name . ' ' . Sentinel::check()->last_name}}</div>
<ul>
    <li> <a href="{{route('quotes.index')}}"> My Quotes {!! Request::is('*/myaccount/quotes/*')?'<i class="fa fa-angle-double-right pull-right"></i>':'' !!}  {!! Request::is('*/myaccount/quotes')?'<i class="fa fa-angle-double-right pull-right"></i>':'' !!}</a> </li>
    <li> <a href="{{route('myorders.index')}}"> My Orders  {!! Request::is('*/myaccount/myorders/*')?'<i class="fa fa-angle-double-right pull-right"></i>':'' !!}  {!! Request::is('*/myaccount/myorders')?'<i class="fa fa-angle-double-right pull-right"></i>':'' !!}</a> </li>
    <li> <a href="{{route('user.show',User::getId())}}"> Personal Info {!! Request::is('*/myaccount/user/*')?'<i class="fa fa-angle-double-right pull-right"></i>':'' !!}</a> </li>
</ul>