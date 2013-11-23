<?php

class Provocation extends Eloquent {
	protected $softDelete = true;

	protected $guarded = array();

	public static $rules = array(
		'title' => 'required',
		'source' => 'required|active_url',
		'img' => 'image'
	);
}
