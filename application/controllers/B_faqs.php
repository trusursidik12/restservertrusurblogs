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

	public function add(){
		$data['title_header'] 	= 'Add Faq';
		$data['title_menu'] 	= "Faqs List";
		$data['controllers'] 	= "faqs";

		$this->form_validation->set_rules('faq_question', 'Question', 'required');
		$this->form_validation->set_rules('faq_tags[]', 'Tags', 'required');

		$this->form_validation->set_message('required', '%s Empty, Please Input..');

		if($this->form_validation->run() === FALSE){
			$this->temp_backend->load('backend/theme/template', 'backend/faqs/faqs_form_add', $data);
		} else {
			$this->b_faqs_m->add_faqs();
			redirect('backoffice/faqs/list');
		}
	}

	public function edit($slug = NULL){
		$data['faqs'] 			= $this->b_faqs_m->get_faqs($slug);
		$data['title_header'] 	= 'Edit Faq';
		$data['title_menu'] 	= "Faqs List";
		$data['controllers'] 	= "faqs";

		if(empty($data['faqs'])){
			show_404();
		}
		
		$this->form_validation->set_rules('faq_question', 'Question', 'required');
		$this->form_validation->set_rules('faq_tags[]', 'Tags', 'required');

		$this->form_validation->set_message('required', '%s Empty, Please Input..');

		if($this->form_validation->run() === FALSE){
			$this->temp_backend->load('backend/theme/template', 'backend/faqs/faqs_form_edit', $data);
		} else {
			$this->b_faqs_m->update_faqs();
			redirect('backoffice/faqs/list');
		}
	}

	public function delete($id){
		check_bukan_level_staff();
		$id 	= decrypt_url($id);
		$this->b_faqs_m->delete_faqs($id);
		redirect('backoffice/faqs/list');
	}
}
