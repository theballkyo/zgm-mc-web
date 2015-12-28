@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">Reply - {{ $topic->title }}</div>

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
		<form class="form-horizontal" method="post" action="{{action('TopicController@storeReply')}}">
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
	</div>
</div>
@endsection

@section('script')
	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
	<script>tinymce.init({ selector:'textarea#body' });</script>
@endsection