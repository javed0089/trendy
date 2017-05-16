@extends('backend.layouts.adminmain')
@section('title','Notifications')

@section('content')

<section class="content-header">
	<h1>
		Notifications
	</h1>
	
	
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
	<div class="box box-primary">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
              <i class="ion ion-clipboard"></i>

             All Notifications

           
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="todo-list ui-sortable">
               @foreach (User::getUser()->notifications as $notification) 
                <li>
                   <span class="handle ui-sortable-handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      
                 <a href="{{route($notification->data['route-name'],$notification->data['Id'])}}"> <span class="text">{{$notification->data['Title']}}</span></a><button style="margin-left: 30px;" class="btn btn-primary btn-xs"><i class="fa fa-check"></i>Mark as read</button>
                 
                  <span  style="font-size: 12px;" class="label label-warning pull-right"><i class="fa fa-clock-o"></i> {{date('M j, Y H:i',strtotime($notification->created_at))}}</span>
                 
                </li>
            @endforeach
              
              
               
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix no-border">
              <button type="button" class="btn btn-primary pull-right"><i class="fa fa-check"></i> Mark all as read</button>
            </div>
          </div>
	</div>
</section>
@endsection

