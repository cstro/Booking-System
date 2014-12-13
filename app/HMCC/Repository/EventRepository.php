<?php namespace HMCC\Repository;

use Event;

class EventRepository extends Repository
{
	protected $eventClassRepository;

	public function __construct(Event $event, EventClassRepository $eventClassRepository)
	{
		$this->model = $event;
		$this->eventClassRepository = $eventClassRepository;
	}

	public function store($data)
	{
		parent::store($data);

		foreach($data['classes'] as $class)
		{
			$this->eventClassRepository->store($class);
		}
	}
}
