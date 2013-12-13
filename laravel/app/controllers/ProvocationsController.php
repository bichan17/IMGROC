<?php

class ProvocationsController extends BaseController {

	/**
	 * Provocation Repository
	 *
	 * @var Provocation
	 */
	protected $provocation;

	public function __construct(Provocation $provocation)
	{
		$this->provocation = $provocation;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
	    // if a provocation is specified, get that one
	    if(Input::has('provocation'))
		$provocation = Provocation::findOrFail(Input::get('provocation'));
	    else
		$provocation = Provocation::whereModStatus('1')->orderBy(DB::raw('RAND()'))->first();

	    return View::make('imgroc.index', compact('provocation'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('imgroc.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input = Input::all();
		$validation = Validator::make($input, Provocation::$rules);

		if ($validation->passes())
		{
		    // store the uploaded file on our server
		    if (Input::hasFile('img')) {
			$file = Input::file('img');

			// the file will be stored in something like
			// imgroc.com/img/123456_mypic.jpg
			$destinationPath = '/uploads/';
			$filename = str_random(6) . '_' . $file->getClientOriginalName();
			$file->move(public_path().$destinationPath, $filename);

			$input["img"] = $destinationPath . $filename;
		    }

		    $this->provocation->create($input);

		    return Redirect::route('index')->with('message', 'Your submission has been sent!');
		}

		return Redirect::route('submit')
			->withInput()
			->withErrors($validation);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$provocation = $this->provocation->findOrFail($id);

		return View::make('provocations.show', compact('provocation'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$provocation = $this->provocation->find($id);

		if (is_null($provocation))
		{
			return Redirect::route('admin.index');
		}

		return View::make('provocations.edit', compact('provocation'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$input = array_except(Input::all(), '_method');
		$validation = Validator::make($input, Provocation::$rules);

		if ($validation->passes())
		{
			$provocation = $this->provocation->find($id);
			$provocation->update($input);

			return Redirect::route('provocations.show', $id);
		}

		return Redirect::route('provocations.edit', $id)
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
	}

	/**
	 * Remove the specified resource from being used.
	 *
	 * NOTE: this performs a soft delete, use destroy() to permanently remove
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function trash($id)
	{
		$this->provocation->find($id)->delete();

		return Redirect::route('provocations.index');
	}

	/**
	 * Permanently remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$this->provocation->find($id)->forceDelete();

		return Redirect::route('provocations.index');
	}

    // display all the provocations in the mod queue
    public function modqueue() {
	// get every provocation with mod_status 0
	$provocations = Provocation::whereModStatus('0')->orderBy('created_at',     'DESC')->get();

	return View::make('admin.modqueue', compact('provocations'));
    }   
     
    // delete, approve, reject from the mod queue
    public function editprov() {
	// check for ID, are you 21?
	if(Input::has('provocation')) $id = Input::get('provocation');
	else return Redirect::route('allprovs')->with('error', 'No provocation specified');

	$prov = Provocation::withTrashed()->findOrFail($id);

	// if we're coming from the modqueue, return back there
	if(isset($_SERVER["HTTP_REFERER"]) && parse_url($_SERVER["HTTP_REFERER"], PHP_URL_PATH) == URL::route('modqueue', array(), false))
	    $redirect = 'modqueue';
	else
	    $redirect = 'allprovs';

	// are we deleting it, changing the moderation status, or what?
	if(Input::has('delete')) {
	    $prov->delete();
	    $change = 'trashed';
	} elseif(Input::has('destroy')) {
	    $prov->forceDelete();
	    $change = 'deleted permanently';
	    $redirect = 'trashedprovs';
	} elseif(Input::has('restore')) {
	    $prov->restore();
	    $change = 'restored';
	} elseif(Input::has('status')) {
	    $status = Input::get('status');
	    $change = 'modified';
	} else 
	    return Redirect::route('allprovs')->with('error', 'No action specified');

	// if we're changing the status
	if(isset($status)) {
	    $prov->mod_status = $status;
	    $prov->save();
	}   

	return Redirect::route($redirect)->with('message', 'Provocation '.$prov->title.' has been '.$change);
    }

    // show all the provocations
    public function allprovs() {
	$provocations = Provocation::orderBy('created_at', 'DESC')->get();

	return View::make('admin.provocations', compact('provocations'));
    }

    // show thrashed provocations
    public function trashedprovs() {
	$trash = true;
	$provocations = Provocation::onlyTrashed()->orderBy('deleted_at', 'DESC')->get();

	return View::make('admin.provocations', compact('provocations', 'trash'));
    }
}
