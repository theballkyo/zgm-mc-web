@extends('layouts.app')
@section('style')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/s/bs-3.3.5/jq-2.1.4,dt-1.10.10,r-2.0.0/datatables.min.css"/>
@endsection
@section('content')
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId=776272905731034";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div class="panel panel-default">
    <div class="panel-heading">ข่าวประกาศ</div>

    <div class="panel-body">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="false">
        @foreach($topics as $topic)
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="heading{{$topic->id}}">
                  <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$topic->id}}" aria-expanded="false" aria-controls="collapse{{$topic->id}}">
                      {{$topic->title}} - <small>{{ $topic->updated_at }}</small>
                    </a>
                  </h4>
                </div>
                <div id="collapse{{$topic->id}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$topic->id}}">
                  <div class="panel-body">
                    {!!$topic->body!!}
                  </div>
                </div>
            </div>
        @endforeach
        </div>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">Chat room</div>

    <div class="panel-body">
        <iframe frameborder="0" width="100%" height="550" src="https://chat.sukson.com/minecraftzgm"></iframe>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">Player stat</div>

    <div class="panel-body">
        <table data-order='[[ 2, "desc" ]]' id="player" class="table table-hover">
        <thead>
            <tr>
              <th class="text-center">Name</th> 
              <th class="text-center">Money</th> 
              <th class="text-center">Last login</th>
            </tr>
        </thead>
        <tbody>
        @foreach($authme as $user)
            <tr>
    @if($mc_status)
        <td class="text-center">{{ in_array($user->username, array_map('strtolower', (array)$mc_status->GetPlayers())) ? '[Online] '.$user->username : ($user->username === 'theballkyo' ? '[ADMIN] theballkyo' : $user->username) }}</td>
    @else
        <td class="text-center">{{ $user->username }}</td>
    @endif
            <td class="text-center">{{ !empty($user->fe->money) ? $user->fe->money : 0.00 }}</td>
                <td class="text-center">{{ date("Y-m-d H:i:s", $user->lastlogin / 1000) }}</td>
            </tr>
        @endforeach
        </tbody>
        </table>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript" src="https://cdn.datatables.net/s/bs-3.3.5/jq-2.1.4,dt-1.10.10,r-2.0.0/datatables.min.js"></script>
<script>
  $(document).ready(function(){
      $('#player').DataTable();
  });
</script>
@endsection