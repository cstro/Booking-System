<?php

use HMCC\Form\User\UserForm;

class UserController extends \BaseController {

  /**
   * @var UserForm
   */
  protected $form;

  public function __construct(UserForm $form)
  {
    $this->form = $form;
  }

  /**
   * Stores the new user record
   * @returns Redirect Returns a laravel redirect object
   */
  public function store()
  {
    $this->form->store(Input::all());
    return $this->attemptLogin();
  }

  public function signUp()
  {
    // return user sign up page
    return View::make('user.create');
  }

  public function login()
  {
    // return user login page
    return View::make('user.login');
  }

  public function attemptLogin()
  {
    $email = Input::get('email');
    $password = Input::get('password');

    $this->form->checkLogin($email, $password);

    return Redirect::route('event.index');
  }

  public function logOut()
  {
    Auth::logout();

    return Redirect::back()->withInput();
  }

  public function show($id)
  {
    $user = $this->form->repository->find($id);


    return View::make('user.show')->with('user', $user);
  }
}
