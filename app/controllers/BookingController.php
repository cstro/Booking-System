<?php

use HMCC\Form\Booking\BookingForm;
use HMCC\Repository\Booking\FrequencyRepository;
use HMCC\Repository\Booking\BookingFrequencyRepository;
use HMCC\Repository\RaceEvent\RaceEventRepository;

class BookingController extends \BaseController {

    /**
     * @var BookingForm
     */
    protected $form;

    /**
     * @var RaceEventRepository
     */
    protected $raceEventRepository;

    /**
     * @var FrequencyRepository
     */
    protected $frequencyRepository;


    /**
    * @var BookingFrequencyRepository
    */
    protected $bookingFrequencyRepository;

    public function __construct(BookingForm $form, RaceEventRepository $raceEventRepository, FrequencyRepository $frequencyRepository, BookingFrequencyRepository $bookingFrequencyRepository)
    {
            $this->form = $form;
            $this->raceEventRepository = $raceEventRepository;
            $this->frequencyRepository = $frequencyRepository;
            $this->bookingFrequencyRepository = $bookingFrequencyRepository;
    }

    public function create($slug) {
        return $this->createWithClassId($slug, null);
    }

    public function createWithClassId($slug, $class_id) {
        $event = $this->raceEventRepository->getEventBySlug($slug);
        $classes = $event->classes;
        $frequencies = $this->frequencyRepository->all();

        return View::make('booking.create')->withEvent($event)->withClasses($classes)->withFrequencies($frequencies)->withSelected($class_id);
    }

    /**
     * Saves a new booking record
     * @returns Redirect redirects the user to the event index page
     */
    public function store() {
        $this->form->store(Input::all());

        return Redirect::route('event.index');
    }

<<<<<<< HEAD
    /**
     * Deletes a booking record using the id given
     * @param   integer       $id The id of the booking to delete
     * @returns Redirect.Back redirects the user back to the previous page
     */
    public function destroy($id) {
        $booking = Booking::find($id);
        $booking->delete();
=======
	/**
		* Deletes a booking record using the id given
		* @param   integer       $id The id of the booking to delete
		* @returns Redirect.Back redirects the user back to the previous page
		*/
	public function destroy($id)
	{
		$booking = Booking::find($id);

		$this->bookingFrequencyRepository->deleteByBookingId($id);

		$booking->delete();
>>>>>>> master

        return Redirect::back();
    }

    public function showUserBookings() {
        if (Auth::check()) {
            $bookings = $this->form->repository->getAllUser(Auth::id());
            return View::make('booking.showUserBookings')->with('bookings', $bookings);
        }
    }

}
