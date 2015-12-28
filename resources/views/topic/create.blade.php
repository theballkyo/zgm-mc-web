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
		<form class="form-horizontal" method="post" action="{{action('TopicController@store')}}">
			<div class="form-group">
				<div class="col-sm-12">
		    		<input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{ old('title') }}">
		    	</div>
			</div>
			<div class="form-group">
				<label for="category" class="col-sm-2 control-label">หมวดหมู่</label>
				<div class="col-sm-10">
					<select class="form-control" name="category" id="category">
						<option value="-1">กรุณาเลือกหมวดหมู่</option>
						@foreach($category as $cat)
						<option value="{{ $cat->id }}" {{ old('category') == $cat->id ? 'selected' : '' }}>{{$cat->title}}</option>
						@endforeach
					</select>
				</div>
			</div>
			
			<div class="form-group">
				<div class="col-sm-12">
		    		<textarea id="body" name="body">{{ old('body') }}</textarea>
		    	</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12">
					<button type="submit" class="btn btn-default">Post</button>
				</div>
			</div>	
			{!! csrf_field() !!}		
		</form>
	</div>
</div>

@endsection

@section('script')
	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
	<script>tinymce.init({ selector:'textarea#body' });</script>
@endsection