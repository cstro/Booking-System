@extends('layouts.master')

@section('content')
<div class="bg-lightgray">
  <div class="container settings">
    <h2>Settings</h2>
    @include('partials.errors')

    @if (isset($success))
      <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <p>{{ $success }}</p>
      </div>
    @endif

    <div class="list-group col-sm-3 col-md-2 sidebar">
      @yield('sidebar')
    </div>
    <div class="col-xs-12 col-sm-9 col-md-10" id="settings-content">
      @yield('settings-content')
    </div>
  </div>


</div>

@stop
