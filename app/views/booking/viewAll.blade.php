@include('layouts.master')

<div class="container">
	<h1>My Bookings</h1>

	@if (Session::get('user') == null)
		Must be logged in {{link_to('/login', 'Click Here')}}
	@else
	@if (count($bookings) >0)
	@foreach ($bookings as $booking)
	<div class="row">
		{{ Form::open(array('route' => ['booking.destroy', $booking->id], 'method' => 'delete')) }}
		{{$booking->EventName . " " . $booking->EventDate . " " . $booking->ClassName . " " . $booking->transponder}}
		<button class="btn btn-danger">Cancel Booking</button>
		{{Form::close()}}
	</div>
	@endforeach

	@else
		You have no bookings

	@endif
	@endif
</div>
