<?php
use chriskacerguis\RestServer\RestController;
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/RestController.php';
require APPPATH . 'libraries/Format.php';

class B_blogs_api extends RestController {

	public function blogs_get()
	{

		$id = $this->get('blg_slug');

		if ($id === null) {
			$data = $this->b_blogs_api_m->get_blogs();
		} else {
			$data = $this->b_blogs_api_m->get_blogs($id);
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
