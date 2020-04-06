<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class B_dashboard extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		check_not_login();
	}

	public function index()
	{
		$data['content_header'] = "Dashboard";
		$data['title_header'] 	= "Dashboard";
		
		$this->temp_backend->load('backend/theme/template', 'backend/dashboard/dashboard', $data);
	}
}
