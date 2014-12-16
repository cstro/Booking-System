<?php namespace HMCC\Repository;

use User;
use Hash;

class UserRepository extends Repository
{
	public function __construct(User $user)
	{
		$this->model = $user;
	}

	public function store($data)
	{
		$record = new $this->model;
		$record->forename = $data['forename'];
		$record->surname = $data['surname'];
		$record->email = $data['email'];
		$record->password = Hash::make($data['password'] . $data['secret']);
		$record->secret = $data['secret'];
		$record->brca = $data['brca'];

		return $record->save();
	}

	public function getSecret($email)
	{
		$user =  $this->model->where('email', '=', $email)->first();

		if($user == null)
			return '';

		return $user->secret;
	}
}