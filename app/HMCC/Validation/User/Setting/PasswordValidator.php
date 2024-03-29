<?php namespace HMCC\Validation\User\Setting;

use HMCC\Validation\Validator;
use Hash;
use Auth;

class PasswordValidator extends Validator
{
  protected $rules = ['new-password' => 'required|min:6|confirmed'];

  public function passes(Array $inputs)
  {
    $passed = parent::passes($inputs);
    $oldPassword = $inputs['old-password'] . Auth::user()->secret;

    if (!Hash::check($oldPassword, Auth::user()->password))
    {
      $this->errors->add('old-password', 'Old password is incorrect');
      $passed = false;
    }
    return $passed;
  }
}
