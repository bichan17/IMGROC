<?php
class UsersController extends BaseController {
    // if the user is logged in, send to admin dashboard
    // otherwise, prompt for login
    public function dashboard() {
	if(Auth::check()) {
	    return View::make('admin.index');
	} else {
	    return Redirect::route('login')->withInput();
	}
    }

    // log the user in 
    public function login() {
	if(Auth::check()) {
	    Session::flash('message', 'You are already logged in!');
	    return Redirect::route('admin');
	}

	if (Auth::attempt(array('username'=>Input::get('username'), 'password'=>Input::get('password')))) {
	    Session::flash('message', 'You are now logged in!');
	    return Redirect::route('admin');
	}
	
	if(Input::has('username') || Input::has('password')) {
	    Session::flash('message', 'Your username/password combination was incorrect');
	}
	return View::make('admin.login');
    }

    public function logout() {
	Auth::logout();
	Session::flash('message', 'Your are now logged out!');
	return Redirect::route('index');
    }
}
?>
