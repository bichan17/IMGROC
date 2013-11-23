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
		$provocation = Provocation::order_by(DB::raw('RAND()'))->get();

		return View::make('provocations.index', compact('provocation'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('provocations.create');
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
			$this->provocation->create($input);

			return Redirect::route('provocations.index');
		}

		return Redirect::route('provocations.create')
			->withInput()
			->withErrors($validation)
			->with('message', 'There were validation errors.');
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
			return Redirect::route('provocations.index');
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
}
