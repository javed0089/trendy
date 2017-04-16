@extends('backend.layouts.adminmain')
@section('title','Blog Post')

@section('content')

<section class="content-header">
	<h1>
		Blog Post
	</h1>
</section>

<!-- Main content -->
<section class="content">
	@if ($message = Session::get('success'))
	<div class="alert alert-success alert-block">
		<button type="button" class="close" data-dismiss="alert">×</button>
		<strong>{{ $message }}</strong>
	</div>
	@endif



	<div class="col-md-12">
		<div class="nav-tabs-custom">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#tab_1" data-toggle="tab">English</a></li>
				<li><a href="#tab_2" data-toggle="tab">Arabic</a></li>

				<li class="pull-right"><a href="#" class="text-muted"><i class="fa fa-gear"></i></a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="tab_1">
					<div class="box-header with-border">
						<h3 class="box-title">{{$post->title_en}}</h3>
					</div>
					<div class="box-body">
						<div class="col-md-8">
							
							@if(isset($post->image))
								<p><img class="display-block" src="{{asset($post->image)}}" width="380" height="220"></p>

							@endif	
							
							<p>{!!$post->body_en!!}</p>
							<hr>
							<div class="tags">
								<h4>Tags</h4>
				                @foreach($post->tags as $tag)
									<span class="label label-default">  {{$tag->name_en}}</span>
				                @endforeach
				                </div>
						</div>
						<div class="col-md-4">
							<div class="callout ">
								
								<h4>Category</h4>
				                <p>{{isset($post->BlogCategory)?$post->BlogCategory->name_en:''}}</p>
			        	        <h4>Created at</h4>
				                <p>{{date('M j, Y H:i',strtotime($post->created_at))}}</p>
				                <h4>Last updated at</h4>
				                <p>{{date('M j, Y H:i',strtotime($post->updated_at))}}</p>
				                <h4>Post link</h4>
				                <p><a style="color: blue;" href="{{url($post->slug)}}">{{url($post->slug)}}</a></p>
				                <a class="btn btn-primary bt-md" href="{{ route('posts.edit',$post->id) }}">Edit Post</a>
			              </div>
		              </div>
					</div>

				</div>
				<!-- /.tab-pane -->
				<div class="tab-pane" id="tab_2">
					<div class="box-header with-border">
						<h3 class="box-title">{{$post->title_ar}}</h3>


					</div>
					<div class="box-body">
						<div class="col-md-8">
							<p>{!!$post->body_ar!!}</p>
						</div>
						<div class="col-md-4">
							<div class="callout ">
								<h4>Category</h4>
				                <p>{{isset($post->BlogCategory)?$post->BlogCategory->name_en:''}}</p>
			        	        <h4>Created at</h4>
				                <p>{{date('M j, Y H:i',strtotime($post->created_at))}}</p>
				                <h4>Last updated at</h4>
				                <p>{{date('M j, Y H:i',strtotime($post->updated_at))}}</p>
				                <h4>Post link</h4>
				                <p><a style="color: blue;" href="{{url($post->slug)}}">{{url($post->slug)}}</a></p>
				                <a class="btn btn-primary bt-md" href="{{ route('posts.edit',$post->id) }}">Edit Post</a>
			              </div>
		              </div>


					</div>

				</div>

				<div class="box-footer">
					
				</div>
			</div>

		</div>
	</div>

</section>
@endsection