@extends('layouts.app')
@section('content')
  <div class="panel panel-default myPanel">
      <div class="panel-heading">Dashboard</div>
      <div class="panel-body" style="text-align: center">
          <p>You are logged in as <strong>Admin</strong></p>
          <p><a href="{{ $context->core->url('logout') }}">Logout</a></p>
      </div>
  </div>
@endsection
