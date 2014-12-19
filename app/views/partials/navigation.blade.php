<nav class="navbar navbar-default" role="navigation">
	<div class="container">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-navbar-collapsable">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/"><img src="/img/logo.svg" alt="Brand"></a>
			</div>

			<div class="collapse navbar-collapse" id="main-navbar-collapsable">
				<ul class="nav navbar-nav">
					<li><a href="{{URL::route('event.index')}}"><i class="fa fa-users fa-lg"></i> Events</a></li>
					<li><a href="{{URL::action('BookingController@viewAll')}}"><i class="fa fa-calendar fa-lg"></i> My Bookings</a></li>

					@if (Auth::check() && Auth::user()->is_admin)
					<li><a href="{{URL::action('HomeController@AdminHome')}}"><i class="fa fa-gears fa-lg"></i> Admin</a></li>
					@endif
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li class="nav-divider"></li>
					@if (Auth::check())
						<li>
							<p class="navbar-text">Logged in as {{ Auth::user()->forename . ' ' .Auth::user()->surname }}</p></li>
						<li><a href="{{URL::action('UserController@signOut')}}" class="navbar-link">Sign Out<i class="fa fa-sign-out fa-lg fa-spacing-left"></i></a>
						</li>
					@else
						<li><a href="{{URL::action('UserController@login')}}"><i class="fa fa-sign-in fa-lg"></i> Login</a></li>

						<li><a href="{{URL::action('UserController@signUp')}}"><i class="fa fa-user fa-lg"></i> Sign Up</a></li>
					@endif
				</ul>
			</div>
		</div>
	</div>
</nav>
