@extends('layouts.default')
@section('title')
    Editar playlist
@endsection
@section('main')
<div class="container p-5">
    <div class="row">
        <div class="col-md-4">
            <h3>Músicas</h3>
            <div class="list-group">
                <a class="list-group-item clearfix" onclick="alert('Action1 -> Details');">
                    Action1
                    <span class="pull-right">
                        <span class="btn btn-xs btn-default" onclick="alert('Action1 -> Play'); event.stopPropagation();">
                            <span class="glyphicon glyphicon-play" aria-hidden="true"></span>
                        </span>
                    </span>
                </a>
                <a class="list-group-item clearfix" onclick="alert('Action2 -> Details');">
                    Action2
                    <span class="pull-right">
                        <span class="btn btn-xs btn-default" onclick="alert('Action2 -> Play'); event.stopPropagation();">
                            <span class="glyphicon glyphicon-play" aria-hidden="true"></span>
                        </span>
                    </span>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-4">
      <div class="list-group" id="list-tab" role="tablist">
        <a class="list-group-item list-group-item-action active" id="list-home-list" data-toggle="list" href="#list-home" role="tab" aria-controls="home">Home</a>
        <a class="list-group-item list-group-item-action" id="list-profile-list" data-toggle="list" href="#list-profile" role="tab" aria-controls="profile">Profile</a>

      </div>
    </div>
    <div class="col-8">
      <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="list-home" role="tabpanel" aria-labelledby="list-home-list">1</div>
        <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-profile-list">2</div>
       
      </div>
    </div>
  </div>
@endsection
@section('footer')
    @include('layouts.footer'){{-- se tiver footer coloca, se não tiver não coloca o include--}}
@endsection