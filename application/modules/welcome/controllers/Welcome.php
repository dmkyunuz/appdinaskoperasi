<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MX_Controller  {

	function __construct()
    {
        parent::__construct();
      
    }

	public function index()
	{
		Web::setTitle('asd');
		return Web::render('index');
	}
}
