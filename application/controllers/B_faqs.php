<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class B_faqs extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		check_not_login();
	}

	public function index()
	{
		$data['faqs'] 			= $this->b_faqs_m->get_faqs();
		$data['users'] 			= $this->b_faqs_m->get_users();
		$data['title_header'] 	= "Faqs List";
		$data['title_menu'] 	= "Add Faq";
		$data['controllers'] 	= "faqs";
		
		$this->temp_backend->load('backend/theme/template', 'backend/faqs/faqs_list', $data);
	}

	public function edit($id = NULL){
		$id = decrypt_url($id);
		$data['faqs'] 			= $this->b_faqs_m->get_faqs($id);
		$data['title_header'] 	= 'Edit Faq';
		$data['title_menu'] 	= "Faqs List";
		$data['controllers'] 	= "faqs";

		if(empty($data['faqs'])){
			show_404();
		}
		
		$this->form_validation->set_rules('faq_desc', 'Description', 'required');
		$this->form_validation->set_rules('faq_tags[]', 'Tags', 'required');

		$this->form_validation->set_message('required', '%s Empty, Please Input..');

		if($this->form_validation->run() === FALSE){
			$this->temp_backend->load('backend/theme/template', 'backend/faqs/faqs_form_edit', $data);
		} else {
			$this->b_faqs_m->update_faqs();
			redirect('backoffice/faqs/list');
		}
	}
}
