<?php
class UsersController extends BaseController {
    // if the user is logged in, send to admin dashboard
    // otherwise, prompt for login
    public function dashboard() {
	if(Auth::check()) {
	    //return View::make('admin.index');
	    return Redirect::route('modqueue');
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

    public function account() {
	// get the old input, if exists
	if(Input::has('id')) $input = Input::all();
	else $input = Input::old();

var_dump($input); return;

	// admins can specify which user, others can't
	if(User::find(Auth::user()->id)->admin() && !empty($input["id"])) $user = User::findOrFail($input["id"]);
	else $user = Auth::user();
    
	Session::forget('newUser');
	Session::flash('admin_level', $user["admin_level"]);
	return View::make('admin.account', compact('user'));
    }

    public function editaccount() {
	// get only the stuff we care about
	$input = Input::only('id', 'fullname', 'email', 'username', 'password', 'password_confirmation', 'notes', 'admin_level', 'edit', 'delete', 'cancel');

	// if we're not user, admin_level will be passed securely by session
	if(Session::has('admin_level')) $input['admin_level'] = Session::get('admin_level');

	// load the User we'll be working with, unless this is a new user
	if(Session::get('newUser')) {
	    $user = new User;
	    $user->id = $input['id'];
	    Session::flash('newUser', true);
	} else {
	    $user = User::findOrFail($input["id"]);
	}

	// if we are deleting it, don't bother with the rest
	if((Input::has('cancel') && Input::get('cancel') === "Cancel") || (Input::has('delete') && Input::get('delete') === "true")) {
	    $user->delete();
	    Session::flash('message', 'User deleted successfully');
	    return Redirect::route('users');
	}

	// validation rules
	$rules = array(
	    'fullname'	    => 'min:3|max:50|required',
	    'email'	    => 'min:3|max:50|email|required',
	    'username'	    => 'max:20|in:'.$user->username.'|required',
	    'admin_level'   => 'in:0,1|required'
	);
	
	// did we get a password? is it valid?
	if(!empty($input["password"]) || !empty($input["password_confirmation"]) || Session::get('newUser')) {
	    $rules['password'] = 'min:6|confirmed|required';
	}

	// run the validation rules against our input
	$validator = Validator::make($input, $rules);

	// if we aren't loading the page for editing existing
	if($input["edit"] !== "true") {
	    // if the input is valid, save it. otherwise throw errors
	    if($validator->fails()) {
		// if we're being secure and not admin, pass admin_level by session
		if(Session::has('admin_level') && Auth::user()->id !== "1") {
		    Session::flash('admin_level', Session::get('admin_level'));
		    return Redirect::route('account', compact('user'))->withErrors($validator)->withInput(Input::except('admin_level'));
		} else
		     return Redirect::route('account', compact('user'))->withErrors($validator)->withInput($input);
	    } else {
		// store the input values
		$user->fullname = $input["fullname"];
		$user->email = $input["email"];
		$user->admin_level = $input["admin_level"];

		if(!empty($input["notes"])) $user->notes = $input["notes"];

		if(!empty($input["password"])) $user->password = Hash::make($input["password"]);
		$user->save();

		Session::flash('message', 'Changes saved successfully');
	    }
	}

	return Redirect::route('account', compact('user'));
    }

    // display all users
    public function users() {
	$users = User::all();

	// dump all session data, scary!
	Session::forget('admin_level');
	Session::forget('newUser');

	return View::make('admin.users', compact('users'));
    }

    // i wonder what this does...
    public function adduser() {
	// get the highest nr id, so the next User will have that +1
	$id = User::orderBy('id', 'DESC')->first()->pluck('id');

	$user = new User;
	$user->id = ($id + 1);

	// this is a new user, treat it as such
	Session::flash('newUser', true);

	return View::make('admin.account', compact('user'));
    }
}
?>
