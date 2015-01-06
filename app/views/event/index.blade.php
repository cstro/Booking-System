@extends('layouts.master')

@section('content')
<div class="tiles-container">
    <div class="container">
        @if (Auth::check() && Auth::user()->is_admin)
          <div>{{ link_to_route('event.create', 'Create New Event', null, ['class="btn btn-primary create-class"']) }}</div>
        @endif

        <h2>Available to book</h2>

        <div class="tiles">
            @foreach($events as $event)
                @include('partials.event-tile', ['event' => $event])
            @endforeach
        </div>
    </div>
</div>
@stop


