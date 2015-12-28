@extends('layouts.app')

@section('content')

<div class="panel panel-default">
	<div class="panel-heading">Delete topic - {{ $topic->title }}</div>

	<div class="panel-body">
		@if (count($errors) > 0)
		    <div class="alert alert-danger">
		        <ul>
		            @foreach ($errors->all() as $error)
		                <li>{{ $error }}</li>
		            @endforeach
		        </ul>
		    </div>
		@endif
		<form class="form-horizontal" method="post" action="{{action('TopicController@destroy', ['id' => $topic->id])}}">
			<h3>ต้องการจะลบกระทู้ "<a href="{{action('TopicController@show', ['id' => $topic->id])}}">{{ $topic->title }}</a>" หรือไม่</h3>
			<div class="form-group">
				<div class="col-sm-12">
					<button type="submit" class="btn btn-danger">ลบกระทู้</button>
					<a class="btn btn-success" href="{{ action('TopicController@show', ['id' => $topic->id]) }}">ยกเลิก</a>
				</div>
			</div>	
			{!! csrf_field() !!}
			<input type="hidden" name="_method" value="delete" />	
		</form>
	</div>
</div>

@endsection

@section('script')
	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
	<script>tinymce.init({ selector:'textarea#body' });</script>
@endsection