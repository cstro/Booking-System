<?php

class RaceEvent extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'events';

	protected $fillable = array('name', 'slug', 'start_time', 'close_time', 'cancelled');
}

