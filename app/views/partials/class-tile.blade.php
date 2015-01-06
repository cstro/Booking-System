<div class="col-xs-12">
  <div class="tile">
    <div class="tile-head">
      <a href="#" class="fold">
        <div class="col-xs-12 col-sm-6">
          <h1><i class="fa fa-angle-double-up icon-spacing-right"></i>{{ $class->name }}</h1>
        </div>
        <div class="col-xs-12 col-sm-6">
          <h1 class="date">{{ count($class->bookings) }} / {{ $class->maxEntrants }}</h1>
        </div>
      </a>
    </div>
    <div class="tile-body">
      <div class="tile-body-content bookings">
        <div class="col-xs-12 col-sm-3 col-sm-offset-9 booking-controls">
          <a href="{{ route('booking.create.class', [ 'slug' => $slug, 'class_id' => $class->id ]) }}" class="btn btn-simple btn-lg">Book<i class="fa fa-arrow-right icon-spacing-left"></i></a>

          @if ($class->locked)
            {{ Form::open(['route' => ['event.unlock', 'event_id' => $event->id, 'class_id' => $class->id], 'role' => 'form', 'id' => 'form', 'method' => 'POST' ] ) }}
              <button type="submit" class="btn btn-simple btn-lg">Unlock<i class="fa fa-unlock-alt icon-spacing-left"></i></button>
            {{ Form::close() }}
          @else
            {{ Form::open(['route' => ['event.lock', 'event_id' => $event->id, 'class_id' => $class->id], 'role' => 'form', 'id' => 'form', 'method' => 'POST' ] ) }}
              <button type="submit" class="btn btn-simple btn-lg">Lock<i class="fa fa-lock icon-spacing-left"></i></button>
            {{ Form::close() }}
          @endif

          </div>
        @foreach ($class->bookings as $booking)
          <div class="booking">
            <div class="col-xs-12 col-sm-3">
              <p>Name</p>
              <div class="field class-field">
                <p>{{ $booking->user->forename }} {{ $booking->user->surname }}</p>
              </div>
            </div>
            <div class="col-xs-12 col-sm-3">
              <p>BRCA</p>
              <div class="field class-field">
                <p>#{{ $booking->user->brca }}</p>
              </div>
            </div>
            <div class="col-xs-12 col-sm-3">
              <p>Transponder</p>
              <div class="field class-field">
                <p>#{{ $booking->transponder }}</p>
              </div>
            </div>
            <div class="col-xs-12 col-sm-3">
              <p>Skill Level</p>
              <div class="field class-field">
                <p>{{ $booking->skill_level }} / 10</p>
              </div>
            </div>
            <div class="col-xs-12">
              <p>Frequencies</p>
              @foreach ($booking->frequencies as $frequency)
                <div class="col-xs-12 col-sm-4">
                  <div class="field class-field">
                    <p>{{ $frequency->name }}</p>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
