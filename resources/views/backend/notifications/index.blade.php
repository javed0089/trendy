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

             
{{Request::is('backoffice/notifications')?'All Unread Notifications':"All Notifications"}}
           
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="todo-list ui-sortable">
               @foreach ($notifications as $notification) 
                <li>
                   <span class="handle ui-sortable-handle">
                        <i class="fa fa-ellipsis-v"></i>
                        <i class="fa fa-ellipsis-v"></i>
                      </span>
                      
                 <a href="{{route($notification->data['route-name'],$notification->data['Id'])}}"> <span class="{{$notification->read_at?'text-info':'text'}}">{{$notification->data['Title']}}</span></a>
@if(!$notification->read_at)
                 <a href="{{route('notifications.markasread',$notification->id)}}" style="margin-left: 30px;" class="btn btn-primary btn-xs"><i class="fa fa-check"></i>Mark as read</a>
    @endif             
                  <span  style="font-size: 12px;" class="label label-warning pull-right"><i class="fa fa-clock-o"></i> {{date('M j, Y H:i',strtotime($notification->created_at))}}</span>
                 
                </li>
            @endforeach
              
              
               
              </ul>
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix no-border">
               <a href="{{route('notifications.allnotifications')}}" type="button" class="btn btn-info pull-left"><i class="fa fa-check"></i> Show all</a>
               <a href="{{route('notifications.index')}}" type="button" class="btn btn-info pull-left"><i class="fa fa-check"></i> Unread</a>
              <a href="{{route('notifications.delete')}}" type="button" class="btn btn-danger pull-right"><i class="fa fa-check"></i> Delete all read</a>
              <a href="{{route('notifications.markallasread')}}" type="button" class="btn btn-primary pull-right"><i class="fa fa-check"></i> Mark all as read</a>
            </div>
          </div>
	</div>
</section>
@endsection

