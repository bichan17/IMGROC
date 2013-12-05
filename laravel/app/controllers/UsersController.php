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
	// admins can specify which user, others can't
	if(User::find(Auth::user()->id)->admin() && Input::has('id')) $user = User::findOrFail(Input::get('id'));
	else $user = Auth::user();
    
	return View::make('admin.account', compact('user'));
    }

    public function editaccount() {
	// get only the stuff we care about
	$input = Input::only('id', 'fullname', 'email', 'username', 'password', 'password_confirmation', 'notes', 'admin_level', 'cancel');

	// load the User we'll be working with
	$user = User::findOrFail($input["id"]);

	// if we are deleting it, don't bother with the rest
	if((Input::has('cancel') && Input::get('cancel') === "Cancel") || (Input::has('delete') && Input::get('delete'))) {
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

	// store the input values
	$user->fullname = $input["fullname"];
	$user->email = $input["email"];
	$user->admin_level = $input["admin_level"];
	if(!empty($input["notes"])) $user->notes = $input["notes"];
	
	// did we get a password? is it valid?
	if(!empty($input["password"]) || !empty($input["password_confirmation"])) {
	    $rules['password'] = 'min:6|confirmed';
	}

	// run the validation rules against our input
	$validator = Validator::make($input, $rules);

	// if the input is valid, save it. otherwise throw errors
	if($validator->fails()) $messages = $validator->messages();
	else {
	    if(!empty($input["password"]) || !empty($input["password_confirmation"])) $user->password = Hash::make($input["password"]);
	    $user->save();
	}

	// if we have errors, show them. otherwise display success
	if(isset($messages)) return Redirect::route('account')->withErrors($validator);
	else Session::flash('message', 'Changes saved successfully');

	return Redirect::route('account', compact('user'));
    }

    // display all users
    public function users() {
	$users = User::all();

	return View::make('admin.users', compact('users'));
    }

    // i wonder what this does...
    public function adduser() {
	// get the highest nr id, so the next User will have that +1
	$id = User::orderBy('id', 'DESC')->first()->pluck('id');

	$user = new User;
	$user->id = ++$id;

	// just a flag to enable the cancel/delete button on the editaccount view
	$delete = true;

	return View::make('admin.account', compact('user', 'delete'));
    }
}
?>
