@extends('layouts.main')
@section('content')
<div class="box-body table-responsive no-padding">
  <img src="{{ asset('/imgs/use-caseV2.png') }}" />
  <table class="table table-hover">
    <thead>
      <td>ID</td>
      <td>Title</td>
      <td>status</td>
      <td>Last updated</td>
    </thead>
    <tbody>
      @foreach($datas as $data)
        <tr>
          <th>{{$data->id}}</th>
          <th><a href="{{action('HomeController@showUseCase', ['id' => $data->id])}}" target="_blank">{{$data->title}}</a></th>
          <th><span class="label label-{{ $data->getCssStatus() }}">{{ $data->getStatus() }}</span></th>
          <th>{{ $data->updated_at }}</th>
        </tr>
      @endforeach
    </tbody>
  </table>
  <a type="submit" name="save" class="btn btn-info pull-left text-left" href="{{action('HomeController@newUseCase')}}">สร้างใหม่</a>
</div>
<!-- /.box-body -->
@endsection