<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class B_message extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		check_not_login();
	}

	public function index()
	{
		$data['message'] 		= $this->b_message_m->get_message();
		$data['title_header'] 	= "Message List";
		$data['controllers'] 	= "message";
		
		$this->temp_backend->load('backend/theme/template', 'backend/message/message_list', $data);
	}

	public function delete($id){
		check_bukan_level_staff();
		$id 	= decrypt_url($id);
		$this->b_message_m->delete_message($id);
		redirect('backoffice/message/list');
	}
}
