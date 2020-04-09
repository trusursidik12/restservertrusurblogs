<?php
use chriskacerguis\RestServer\RestController;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';

class B_faqs_api extends RestController {

	public function faqs_get()
	{

		$id = $this->get('faq_id');

		if ($id === null) {
			$data = $this->b_faqs_api_m->get_faqs();
		} else {
			$data = $this->b_faqs_api_m->get_faqs($id);
		}

		if ($data) {
			$this->response([
                    'status' 	=> true,
                    'data' 		=> $data
                ], 200);
		} else {
			$this->response([
                    'status' 	=> false,
                    'message' 	=> 'Data Tidak Ditemukan'
                ], 404);
		}
	}
}
