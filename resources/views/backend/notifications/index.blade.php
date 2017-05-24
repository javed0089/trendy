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

        <a href="{{route('notifications.evaluate',$notification->id)}}"> <span class="{{$notification->read_at?'text-info':'text'}}">{{$notification->data['Title']}}</span>


        <a href="{{route('notifications.deletenotification',$notification->id)}}" class="btn btn-danger btn-xs pull-right"><i class="fa fa-trash-o"></i></a>
          <span  style="font-size: 12px;margin-left: 30px;" class="text-info"><i class="fa fa-clock-o"></i> {{date('M j, Y H:i',strtotime($notification->created_at))}}</span>

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

