@extends('layouts.app')

@section('content')

<div class="panel panel-default">
	<div class="panel-heading">Create new topic</div>

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
		<form class="form-horizontal" method="post" action="{{action('TopicController@update', ['id' => $topic->id])}}">
			<div class="form-group">
				<div class="col-sm-12">
		    		<input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ $topic->title }}">
		    	</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-12">
		    		<textarea id="body" name="body">{!! $topic->body !!}</textarea>
		    	</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12">
					<button type="submit" class="btn btn-default">Edit</button>
				</div>
			</div>	
			{!! csrf_field() !!}	
			<input type="hidden" name="_method" value="put" />	
		</form>
	</div>
</div>

@endsection

@section('script')
	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
	<script>tinymce.init({ selector:'textarea#body' });</script>
@endsection