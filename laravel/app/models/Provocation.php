<?php

class Provocation extends Eloquent {
	protected $guarded = array();

	public static $rules = array(
		'title' => 'required',
		'source' => 'required',
		'img' => 'required',
		'caption' => 'required',
		'submitted_by' => 'required',
		'mod_status' => 'required'
	);
}
