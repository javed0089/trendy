 
@extends('backend.layouts.adminmain')
@section('title', 'Dashboard')

@section('styles')
<!-- bootstrap wysihtml5 - text editor -->
<link rel="stylesheet" href="{{ asset('backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">
<!-- jvectormap -->
<link rel="stylesheet" href="{{ asset('backend/plugins/jvectormap/jquery-jvectormap-1.2.2.css')}}">


@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Dashboard
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3>{{$totalOrders}}</h3>

          <p>Total Orders</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="{{route('orders.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3>{{$totalQuotes}}</h3>

          <p>Total Quote Requests</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="{{route('quote-requests.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3>{{$totalRegistrations}}</h3>

          <p>User Registrations</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="{{route('customers.index')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
            <div class="col-xs-6">
              <h3>{{$analyticsData['visitors']}}</h3>

              <p>Visitors Yesterday</p>
              </div>
              <div class="col-xs-6 text-right">
              <h3>{{$analyticsData['pageViews']}}</h3>

              <p>Page Views Yesterday</p>
              </div>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="https://analytics.google.com" target="_blank" class="small-box-footer">Google Analytics <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
   
    <!-- ./col -->
  </div>

 
  <!-- /.row -->
  <!-- Main row -->
  <div class="row">

  


    <div class="col-md-6">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Latest Quote Requests <span class="small">Last 10 days</span></h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table class="table no-margin">
              <thead>
                <tr>
                  <th>Quote #</th>
                  <th>Customer</th>
                  <th>Status</th>
                  <th>Assigned To</th>
                </tr>
              </thead>
              <tbody>
                @foreach($quotes as $quote)
                <tr>
                  <td><a href="{{route('quote-requests.show',$quote->id)}}">{{$quote->quote_no}}</a></td>
                  <td>{{$quote->User->first_name}} {{$quote->User->last_name}}
                    {!! User::isActivated($quote->user_id)?'<i class="fa fa-flag text-green"></i>':'<i class="fa fa-flag text-red"></i>' !!}</td>
                    <td><span class="label label-{{$quote->status==1?'danger':'success'}}">{{$quote->Status->status_en}}</span></td>
                    <td>
                      {{isset($quote->AssignedTo)?$quote->AssignedTo->first_name:''}} {{isset($quote->AssignedTo)?$quote->AssignedTo->last_name:''}}</td>

                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <div class="box-footer clearfix">
              <a href="{{route('quote-requests.index')}}" class="btn btn-sm btn-info btn-flat pull-left">Show All Requests</a>
            </div>
          </div>

        </div>
        <div class="col-md-6">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Latest Orders <span class="small">Last 10 days</span></h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                    <tr>
                      <th>Order ID</th>
                      <th>Customer</th>
                      <th>Status</th>
                      <th>Assigned To</th>
                    </tr>
                  </thead>
                  <tbody>
                   @foreach($orders as $order)
                   <tr>
                    <td><a href="{{ route('orders.show',$order->id) }}">{{$order->order_no}}</a></td>
                    <td>{{$order->User->first_name}} {{$order->User->last_name}}</td>
                    <td><span class="label label-{{$order->status==1?'danger':'success'}}">{{$order->Status->status_en}}</span></td>
                    <td>
                     {{isset($order->AssignedTo)?$order->AssignedTo->first_name:''}} {{isset($order->AssignedTo)?$order->AssignedTo->last_name:''}}
                   </td>
                 </tr>
                 @endforeach

               </tbody>
             </table>
           </div>
           <!-- /.table-responsive -->
         </div>
         <!-- /.box-body -->
         <div class="box-footer clearfix">
          <a href="{{ route('orders.index') }}" class="btn btn-sm btn-info btn-flat pull-left">Show All Orders</a>
        </div>
        <!-- /.box-footer -->
      </div>

    </div>

@if(!User::isSalesExecutive())
    <div class="col-md-6">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Quotes for Approval</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table class="table no-margin">
              <thead>
                <tr>
                  <th>Quote #</th>
                  <th>Customer</th>
                  <th>Status</th>
                  <th>Assigned To</th>
                </tr>
              </thead>
              <tbody>
                @foreach($quotesForApproval as $quote)
                <tr>
                  <td><a href="{{route('quote-requests.show',$quote->id)}}">{{$quote->quote_no}}</a></td>
                  <td>{{$quote->User->first_name}} {{$quote->User->last_name}}
                    {!! User::isActivated($quote->user_id)?'<span class="label label-success">Activated</span>':'<span class="label label-danger">Not-Activated</span>' !!}</td>
                    <td><span class="label label-{{$quote->status==1?'danger':'success'}}">{{$quote->Status->status_en}}</span></td>
                    <td>
                      {{isset($quote->AssignedTo)?$quote->AssignedTo->first_name:''}} {{isset($quote->AssignedTo)?$quote->AssignedTo->last_name:''}}</td>

                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <div class="box-footer clearfix">
              <a href="{{route('quote-requests.index')}}" class="btn btn-sm btn-info btn-flat pull-left">Show All Quotes</a>
            </div>
          </div>

        </div>
@endif

@if(!User::isSalesExecutive())
    <div class="col-md-6">
      <div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">Orders for Approval</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table class="table no-margin">
              <thead>
                <tr>
                  <th>Order #</th>
                  <th>Customer</th>
                  <th>Status</th>
                  <th>Assigned To</th>
                </tr>
              </thead>
              <tbody>
                @foreach($ordersForApproval as $order)
                <tr>
                  <td><a href="{{route('orders.show',$order->id)}}">{{$order->quote_no}}</a></td>
                  <td>{{$order->User->first_name}} {{$order->User->last_name}}
                    {!! User::isActivated($order->user_id)?'<span class="label label-success">Activated</span>':'<span class="label label-danger">Not-Activated</span>' !!}</td>
                    <td><span class="label label-{{$order->status==1?'danger':'success'}}">{{$order->Status->status_en}}</span></td>
                    <td>
                      {{isset($order->AssignedTo)?$order->AssignedTo->first_name:''}} {{isset($order->AssignedTo)?$order->AssignedTo->last_name:''}}</td>

                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
            <div class="box-footer clearfix">
              <a href="{{route('orders.index')}}" class="btn btn-sm btn-info btn-flat pull-left">Show All orders</a>
            </div>
          </div>

        </div>
@endif
    <!-- Left col -->
    <section class="col-lg-7 connectedSortable">

      <!-- /.nav-tabs-custom -->


      <div class="box box-solid">
        <div class="box-header with-border">
          <h3 class="box-title">Overall Ratings</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">



          <div class="clearfix">
            <span class="pull-left">Excellent</span>
            <small class="pull-right">{{$ratings->excellent()}}%</small>
          </div>
          <div class="progress">
            <div class="progress-bar progress-bar-green" role="progressbar" aria-valuenow="{{$ratings->excellent()}}" aria-valuemin="0" aria-valuemax="100" >
              <span class="sr-only">40% Complete (success)</span>
            </div>
          </div>
          <div class="clearfix">
            <span class="pull-left">Good</span>
            <small class="pull-right">{{$ratings->good()}}%</small>
          </div>
          <div class="progress">
            <div class="progress-bar progress-bar-aqua" role="progressbar" aria-valuenow="{{$ratings->good()}}" aria-valuemin="0" aria-valuemax="100" >
              <span class="sr-only">90% Complete</span>
            </div>
          </div>
          <div class="clearfix">
            <span class="pull-left">Average</span>
            <small class="pull-right">{{$ratings->average()}}%</small>
          </div>
          <div class="progress">
            <div class="progress-bar progress-bar-yellow" role="progressbar" aria-valuenow="{{$ratings->average()}}" aria-valuemin="0" aria-valuemax="100">
              <span class="sr-only">60% Complete (warning)</span>
            </div>
          </div>
          <div class="clearfix">
            <span class="pull-left">Poor</span>
            <small class="pull-right">{{$ratings->poor()}}%</small>
          </div>
          <div class="progress">
            <div class="progress-bar progress-bar-red" role="progressbar" aria-valuenow="{{$ratings->poor()}}" aria-valuemin="0" aria-valuemax="100" >
              <span class="sr-only">80% Complete</span>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->





    </section>
    <!-- /.Left col -->
    <!-- right col (We are only adding the ID to make the widgets sortable)-->
    <section class="col-lg-5 connectedSortable">





      <!-- Calendar -->
      <div class="box box-solid bg-green-gradient">
        <div class="box-header">
          <i class="fa fa-calendar"></i>

          <h3 class="box-title">Calendar</h3>
          <!-- tools box -->
          <div class="pull-right box-tools">
            <!-- button with a dropdown -->
            <div class="btn-group">
              <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-bars"></i></button>
                <ul class="dropdown-menu pull-right" role="menu">
                  <li><a href="#">Add new event</a></li>
                  <li><a href="#">Clear events</a></li>
                  <li class="divider"></li>
                  <li><a href="#">View calendar</a></li>
                </ul>
              </div>
              <button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
              </button>
            </div>
            <!-- /. tools -->
          </div>
          <!-- /.box-header -->
          <div class="box-body no-padding">
            <!--The calendar -->
            <div id="calendar" style="width: 100%"></div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer text-black">
            <div class="row">
              <div class="col-sm-6">
                <!-- Progress bars -->
                <div class="clearfix">
                  <span class="pull-left">Task #1</span>
                  <small class="pull-right">90%</small>
                </div>
                <div class="progress xs">
                  <div class="progress-bar progress-bar-green" style="width: 90%;"></div>
                </div>

                <div class="clearfix">
                  <span class="pull-left">Task #2</span>
                  <small class="pull-right">70%</small>
                </div>
                <div class="progress xs">
                  <div class="progress-bar progress-bar-green" style="width: 70%;"></div>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-sm-6">
                <div class="clearfix">
                  <span class="pull-left">Task #3</span>
                  <small class="pull-right">60%</small>
                </div>
                <div class="progress xs">
                  <div class="progress-bar progress-bar-green" style="width: 60%;"></div>
                </div>

                <div class="clearfix">
                  <span class="pull-left">Task #4</span>
                  <small class="pull-right">40%</small>
                </div>
                <div class="progress xs">
                  <div class="progress-bar progress-bar-green" style="width: 40%;"></div>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
        </div>
        <!-- /.box -->

      </section>


       <div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="ion ion-cube"></i></span>
        <div class="info-box-content">
          <span class="info-box-text">Total Products</span>
          <span class="info-box-number">{{$totalProducts}}</span>
        </div>
      </div>
    </div>

    @foreach ($prodcount as $category) 
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon" style="background: #fff">
          @if($category['logo'])
          <img src="{{asset($category['logo'])}}">
          @else
          <img src="http://placehold.it/50x66">

          @endif 
        </span>
        <div class="info-box-content">
          <span class="info-box-text">{{$category['name']}}</span>
          <span class="info-box-number">{{$category['prodCount']}}</span>
        </div>
      </div>
    </div>
    @endforeach
  </div>
      <!-- right col -->
    </div>
    <!-- /.row (main row) -->

  </section>
  <!-- /.content -->
  @endsection

  @section('scripts')
  <!-- Morris.js charts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>

  <!-- Sparkline -->
  <script src="{{ asset('backend/plugins/sparkline/jquery.sparkline.min.js')}}"></script>


  <!-- jvectormap -->
  <script src="{{ asset('backend/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
  <script src="{{ asset('backend/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{ asset('backend/plugins/knob/jquery.knob.js')}}"></script>
  <!-- Bootstrap WYSIHTML5 -->
  <script src="{{ asset('backend/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('.progress .progress-bar').css("width",
        function() {
          return $(this).attr("aria-valuenow") + "%";
        }
        )
    });

  </script>

  <!-- AdminLTE App -->
  <script src="{{ asset('backend/dist/js/app.min.js')}}"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="{{ asset('backend/dist/js/pages/dashboard.js')}}"></script>
  @endsection