@extends('layouts.app')

@section('content')

@if(auth()->check())
	<a href="{{action('TopicController@create')}}" class="btn btn-success">New topic</a>
@else
	<a href="{{ url('/login') }}" class="btn btn-success">Login เพื่อตั้งกระทู้</a>
@endif
<p></p>
<a href="{{action('TopicController@index')}}" class="btn btn-info">ทั้งหมด</a>
@foreach($category as $cat)
	<a href="{{action('CategoryController@show', ['id' => $cat->id])}}" class="btn btn-info">{{ $cat->title }}</a>
@endforeach
<table class="table table-hover">
	<thead>
	    <tr>
	      <th width="50%">Title</th>
	      <th class="text-center" width="25%">Last post</th>
	      <th class="text-center">Created by</th>
	      <th class="text-center">Category</th>
	    </tr>
    </thead>
	<tbody>
	@foreach($topics as $topic)
		<tr class="{{$topic->isPin() ? 'bg-success' : ''}} {{$topic->isLock() ? 'bg-danger' : ''}}">
			<td><a href="{{ action('TopicController@show', ['id' => $topic->id]) }}">{{ $topic->title }} <span class="glyphicon glyphicon-{{$topic->isPin() ? 'pushpin' : ''}}{{$topic->isLock() ? 'ban-circle' : ''}}" aria-hidden="true"></span></a></td>
			<td class="text-center">{{ $topic->updated_at }}</td>
			<td class="text-center">{{ $topic->user->name }}</td>
			<td class="text-center">{{ $topic->category->title }}</td>
		</tr>
	@endforeach
	</tbody>
	</table>
@endsection

@section('script')
	<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
	<script>tinymce.init({ selector:'textarea#body' });</script>
@endsection