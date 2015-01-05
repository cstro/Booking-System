<?php namespace HMCC\Form;

use HMCC\Validation\UserValidator;
use HMCC\Repository\UserRepository;

class SettingsForm extends Form
{
  public function __construct(UserRepository $repository, UserValidator $validator)
  {
    $this->repository = $repository;
    $this->validator = $validator;
  }
}
