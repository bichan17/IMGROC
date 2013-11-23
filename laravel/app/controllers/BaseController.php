<?php

class BaseController extends Controller {

        /**
         * Constructor that sets up Assets
         *
         */
        public function __construct() {
            Asset::add('jquery', 'js/jquery.min.js');
            Asset::add('bootstrap-css', 'css/bootstrap.min.css');
	    Asset::add('bootstra-theme-css', 'css/bootstrap-theme.min.css');
            Asset::add('bootstrap-js', 'js/bootstrap.min.js');
	    Asset::add('stylesheet', 'css/imgroc.css');
	    
	    // continue
	    parent::__construct();
        }

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
