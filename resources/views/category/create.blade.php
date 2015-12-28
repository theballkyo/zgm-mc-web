@extends('layouts.app')

@section('content')

<div class="panel panel-default">
	<div class="panel-heading">Create new category</div>

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
		<form class="form-horizontal" method="post" action="{{action('CategoryController@store')}}">
			<div class="form-group">
				<div class="col-sm-12">
		    		<input type="text" class="form-control" id="title" name="title" placeholder="Title">
		    	</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12">
		    		<input type="text" class="form-control" id="description" name="description" placeholder="Description">
		    	</div>
			</div>
			<div class="form-group">
				<div class="col-sm-12">
					<button type="submit" class="btn btn-default">Create</button>
				</div>
			</div>	
			{!! csrf_field() !!}		
		</form>
	</div>
</div>

@endsection
