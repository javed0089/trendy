@extends('backend.layouts.adminmain')
@section('title','Ratings')

@section('styles')
 <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('backend/plugins/datatables/dataTables.bootstrap.css')}}">
  <style type="text/css">
  	     .star{
     	height: 30px;
     }

    .star i{
    	font-size:20px;

    }
  </style>

@endsection

@section('content')

<section class="content-header">
	<h1>
		Ratings
	</h1>
	
	
</section>

<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				@if ($message = Session::get('success'))
					<div class="alert alert-success alert-block">
						<button type="button" class="close" data-dismiss="alert">×</button>
				        <strong>{{ $message }}</strong>
					</div>
				@endif
				<div class="box box-success">
					<div class="box-header" style="padding: 5px 15px; height: 32px; "> 
						<h3 class="box-title" style="line-height: 25px;" >All Ratings</h3> 
					</div>
						<div class="box-body">
							<table id="example2" class="table table-bordered table-hover">
								<thead>
									<tr>
										
										<th>Rating Type</th>
										<th>User</th>
										<th>Order</th>
										<th>Rating</th>
										<th>Dated</th>
										<th>Last Updated</th>
										
									</tr>
								</thead>
								<tbody>

									@foreach($ratings as $rating)
									<tr>
										
										<td>{{$rating->rating_type == 1?'Overall':'Order'}}</td>
										<td>{{$rating->User->first_name}} {{$rating->User->last_name}}</td>
										<td>@if($rating->order_id != 0)
											<a href={{route('orders.show',$rating->order_id)}}>{{$rating->order_id}}</a> 
											@endif 
											</td>
										<td>
 <div id='{{$loop->index}}star' class="star" ></div>
              <input id="{{$loop->index}}tb" hidden type="text"  name="rating" value="{{count($rating)>0? $rating->rating:''}}">

										</td>
										<td>{{ date('M j, Y H:i',strtotime($rating->created_at))}}</td>
										<td>{{ date('M j, Y H:i',strtotime($rating->updated_at))}}</td>
										
									</tr>
									@endforeach

								</tbody>
								<tfoot>

								</tfoot>
							</table>
						</div>
					</div>
				</div>
			</div>
		</section>
@endsection

@section('scripts')
 

!-- DataTables -->
<script src="{{asset('backend/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>

 <!-- page script -->
<script>
  $(function () {
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
       "order": [[ 1, "desc" ]]
    });

    $("#delbutton").on("click", function(){
	    return confirm("Are you sure, you want to delete it?");
	});

  });
</script>

<script src="{{asset('js/stars.min.js')}}"></script>
<script type="text/javascript">
@foreach($ratings as $rating)
 $('#{{$loop->index}}star').stars({
  stars: 4,
  value:$('#{{$loop->index}}tb').val(),
  text: ['Poor', 'Average', 'Good','Excellent'],
  color: '#ffda44',
  starClass  : 'star',
  click: function(index) {
  }
});
 @endforeach
</script>
@endsection

