<?php

use HMCC\Form\RaceEventForm;
use HMCC\Repository\RaceClassRepository;
use HMCC\Repository\RaceEventClassRepository;
use HMCC\Repository\BookingRepository;

class RaceEventController extends \BaseController {

	protected $layout = 'layouts.master';

	/**
	 * @var RaceEventForm
	 */
	protected $form;

	/**
	 * @var RaceEventClassRepository
	 */
	protected $raceEventClassRepository;

	/**
	 * @var RaceClassRepository
	 */
	protected $raceClassRepository;

	/**
	 * @var BookingRepository
	 */
	protected $bookingRepository;

	public function __construct(
		RaceEventForm $form,
		RaceEventClassRepository $raceEventClassRepository,
		RaceClassRepository $raceClassRepository,
		BookingRepository $bookingRepository)
	{
		$this->form = $form;
		$this->raceClassRepository = $raceClassRepository;
		$this->raceEventClassRepository = $raceEventClassRepository;
		$this->bookingRepository = $bookingRepository;
	}

	/**
	 * Shows all of the events
	 * @returns Event.Index View
	 */
	public function index()
	{
		$timestamp = time();

		$events = $this->form->repository->getEventsBeforeClose($timestamp);

		$oldevents = $this->form->repository->getEventsAfterClose($timestamp);

		return $this->layout->content = View::make('event.index')->with('events', $events)->with('old_events', $oldevents);
	}

	/**
	 * Creates the view for a new event
	 * @returns Event.Create View
	 */
	public function create()
	{
		$classes = $this->raceClassRepository->getAllActive();

		return $this->layout->content = View::make('event.create')->withOptions($classes);
	}

	/**
	 * Stores a new event using form inputs
	 * @returns Event.Index View
	 */
	public function store()
	{
		$this->form->store(Input::all());

		return Redirect::route('event.index');
	}

	/**
	 * Gets event information using slug
	 * @param integer $slug The   slug of the event
	 * @returns Event.View View
	 */
	public function show($slug)
	{
		$event = $this->form->repository->getEventBySlug($slug);
		$classes = $event->classes;

		foreach ($classes as $class)
		{
			$class->bookings = $this->bookingRepository->getBookingsByEventIdAndClassId($event->id, $class->id);
		}

		return $this->layout->content = View::make('event.view')->with('classes', $classes)->with('event', $event);
	}

	/**
	 * Deletes the event using the id
	 * @param integer $id The id of the evnt to delete
	 */
	public function destroy($id)
	{
		$event = RaceEvent::find($id);
		$event->delete();
	}

	/**
	 * Locks the event class
	 * @param   integer  $classId The id of the class
	 * @param   integer  $eventId The id of the event
	 * @returns Laravel redirect back
	 */
	public function lock($classId, $eventId)
	{
		$this->eventClassRepository->lock($eventId, $classId);

		return Redirect::back();
	}

	/**
	 * Unlocks the event class
	 * @param   integer  $classId The id of the class
	 * @param   integer  $eventId The id of the event
	 * @returns Laravel redirect back
	 */
	public function unlock($classId, $eventId)
	{
		$this->eventClassRepository->unlock($eventId, $classId);

		return Redirect::back();
	}
}
