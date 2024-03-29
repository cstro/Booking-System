<?php namespace HMCC\Validation\User\Setting;

use HMCC\Validation\Validator;

class ProfileValidator extends Validator
{
  protected $rules = ['forename' => 'sometimes|required',
                      'surname'  => 'sometimes|required',
                      'email'    => 'sometimes|required|email|unique:users',
                      'brca'     => 'sometimes|required|numeric',
                      'skill'    => 'sometimes|required|numeric|between:1,10'];
}
