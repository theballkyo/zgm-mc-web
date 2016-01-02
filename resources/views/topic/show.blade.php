@extends('layouts.app')

@section('content')
<div id="fb-root"></div>{{--
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=776272905731034";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>--}}
<div class="panel panel-default">
	@if (count($errors) > 0)
		<div class="alert alert-danger">
			<ul>
				@foreach ($errors->all() as $error)
					<li>{{ $error }}</li>
				@endforeach
			</ul>
		</div>
	@endif
	<div class="panel-heading">{{ $topic->title }}</div>
	<div class="panel-body">
		<div class="media">
	  <div class="media-left">
		<a href="#">
		  <img class="media-object" src="https://avatar.yourminecraftservers.com/avatar/source/minecraft/background/starburst/bgParams/%23111111,%23cccccc/notFound/steve/figure/classic/figureSize/60/borderSize/4/borderColor/%23000000/canvasSize/128/{{$topic->user->name}}.png" alt="...">
		</a>
	  </div>
	  <div class="media-body">
		<h4 class="media-heading">Created by {{ $topic->user->name }}</h4>
		<p>
			Time :: {{ $topic->created_at }}
		</p>
		@if (auth()->check())
				@if (auth()->user()->isMod())
					<a class="btn btn-success" href="{{ action('TopicController@pin', ['id' => $topic->id]) }}">{{ $topic->isPin() ? 'Unpin' : 'Pin' }}</a>
					<a class="btn btn-danger" href="{{ action('TopicController@lock', ['id' => $topic->id]) }}">{{ $topic->isLock() ? 'Unlock' : 'Lock' }}</a>
				@endif
				@if ($topic->canEdit())
					<a class="btn btn-danger" href="{{ action('TopicController@deleteConfirm', ['id' => $topic->id]) }}">Delete</a>
					<a class="btn btn-info" href="{{action('TopicController@edit', ['id' => $topic->id])}}">Edit</a>
				@endif
			@endif
			<a class="btn btn-success">Reply</a>
	  </div>
	</div>
		<hr>
		{!! $topic->body !!}
		{{--
		<p>
			<div class="fb-comments" data-href="{{ url()->current() }}" data-numposts="5" data-width="100%"></div>
		</p>
		--}}
		<div class="infomation">
			<small>Created by {{ $topic->user->name }} :: {{ $topic->created_at }}</small>
		</div>
	</div>
</div>

@foreach ($topic->comment as $comment)
	<hr>
	<div class="media">
	  <div class="media-left">
		<a href="#">
		  <img class="media-object" src="https://avatar.yourminecraftservers.com/avatar/source/minecraft/background/starburst/bgParams/%23111111,%23cccccc/notFound/steve/figure/classic/figureSize/60/borderSize/4/borderColor/%23000000/canvasSize/128/{{$comment->user->name}}.png" alt="...">
		</a>
	  </div>
	  <div class="media-body">
		<h4 class="media-heading">{{ $comment->user->name }}<small> Say - {{ $comment->updated_at }}</small></h4>
		<p></p>
		{!! $comment->body !!}
	  </div>
	</div>
@endforeach
<hr>
@if(Auth::guest())
<a class="btn btn-default" href="{{ url('/login') }}">Login เพื่อตอบกระทู้</a>
@elseif(!$topic->canReply())
@else
<form name="reply" class="form-horizontal" method="post" action="{{action('TopicController@storeReply')}}">
	<div class="form-group">
		<div class="col-sm-12">
			<textarea id="body" name="body"></textarea>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-12">
			<button type="submit" class="btn btn-default">Reply</button>
		</div>
	</div>
	<input type="hidden" name="id" value="{{ $topic->id }}">
	{!! csrf_field() !!}
</form>
@section('script')
	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
	<script>tinymce.init({ selector:'textarea#body' });</script>
@endsection
@endif
@endsection