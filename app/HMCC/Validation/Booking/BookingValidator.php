<?php namespace HMCC\Validation\Booking;

use App;
use Auth;
use Illuminate\Support\MessageBag;
use HMCC\Repository\Booking\BookingRepository;
use HMCC\Repository\RaceEvent\RaceEventClassRepository;
use HMCC\Validation\Validator;

class BookingValidator extends Validator
{
    protected $rules = ['transponder' => 'required|numeric'];

    /**
     * @var RaceEventClassReposistory
     */
    protected $raceEventClassRepository;

    /**
     * @var BookingRepository
     */
    protected $bookingRepository;

    public function __construct(RaceEventClassRepository $raceEventClassRepository, BookingRepository $bookingRepository)
    {
        $this->raceEventClassRepository = $raceEventClassRepository;
        $this->bookingRepository = $bookingRepository;

        parent::__construct(App::make('Illuminate\Validation\Factory'));
    }

    public function passes(Array $input)
    {
        $passes = parent::passes($input);

        $eventId = $input['event_id'];
        $classId = $input['class_id'];

        $hasBooked = !$this->bookingRepository->unique($eventId, $classId, Auth::id());
        if ($hasBooked)
        {
            $this->errors->add('hasbooked', 'You have already created a booking for this class in this event');
            return false;
        }

        $eventClass = $this->raceEventClassRepository->get($eventId, $classId);
        if ($eventClass->locked)
        {
            $this->errors->add('locked', 'This class has been locked by an admin and cannot be entered');
            return false;
        }

        $limit = $eventClass->limit;
        $current = count($this->bookingRepository->getBookingsByEventIdAndClassId($eventId, $classId));
        $isFull = $current >= $limit;
        if ($isFull)
        {
            $this->errors->add('full', 'There are no more spaces in the class you selected');
            return false;
        }

        if (count($input['frequencies']) < 1 || $input['frequencies'][0] == "")
        {
          $this->errors->add('frequencies', 'You must select at least one frequency!');
          return false;
        }


        return $passes;
    }
}
