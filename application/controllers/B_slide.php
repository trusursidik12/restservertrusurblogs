<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class B_slide extends CI_Controller {

	function __construct(){
		parent::__construct();		
		check_not_login();
		check_bukan_level_staff();
	}

	public function index(){
		$data['slides'] 		= $this->b_slide_m->get_slide();
		$data['users'] 			= $this->b_slide_m->get_users();
		$data['title_header'] 	= "Slide List";
		$data['title_menu'] 	= "Add Slide";
		$data['controllers'] 	= "slide";
		$this->temp_backend->load('backend/theme/template', 'backend/slide/slide_list', $data);
	}

	public function add(){
		$data['title_header'] 	= "Add Slide";
		$data['title_menu'] 	= "Slide List";
		$data['controllers'] 	= "slide";

		$this->form_validation->set_rules('sld_name', 'Slide Name', 'required|is_unique[slide.sld_name]');
		$this->form_validation->set_rules('sld_image', 'Slide Image', 'callback_validate_image');
		$this->form_validation->set_rules('sld_tags[]', 'Slide Tags', 'required');
		
		$this->form_validation->set_message('required', '%s Empty..!');
		$this->form_validation->set_message('is_unique', '%s Already Exist, Please Input Another Slide Name..');

		if($this->form_validation->run() === FALSE){
			$this->temp_backend->load('backend/theme/template', 'backend/slide/slide_form_add', $data);
		} else {
			$config['upload_path'] = './assets/img/slide';
			$config['allowed_types'] = 'png|jpg|jpeg|gif';

			date_default_timezone_set('Asia/Jakarta');
			$rename = date('d-m-Y His ').strtolower($this->input->post('sld_name'));
			$config['file_name'] = $rename;

			$this->load->library('upload', $config);

			if(!$this->upload->do_upload('sld_image')){
				$errors = array('error' => $this->upload->display_errors());
				$images = 'noimageslide.png';
			} else {
				$dataslidehomepage = $this->upload->data();
				$images = $dataslidehomepage['file_name'];
			}

			$this->b_slide_m->add_slide($images);
			redirect('backoffice/slide/list');
		}
	}

	public function edit($slug = NULL){
		$data['slides'] 		= $this->b_slide_m->get_slideview($slug);
		$data['title_header'] 	= "Edit slide";
		$data['title_menu'] 	= "slide";
		$data['controllers'] 	= "slide";

		if(empty($data['slides'])){
			show_404();
		}

		$this->form_validation->set_rules('sld_name', 'Slide Name', 'required|callback_slide_name_check');
		$this->form_validation->set_rules('sld_image', 'Slide Image', 'callback_validate_image_edit');
		$this->form_validation->set_rules('sld_tags[]', 'Slide Tags', 'required');

		$this->form_validation->set_message('required', '%s Empty, Please Input..');

		if($this->form_validation->run() === FALSE){
			$this->temp_backend->load('backend/theme/template', 'backend/slide/slide_form_edit', $data);
		} else {
			$id = $this->input->post('sld_id');
			$config['upload_path'] = './assets/img/slide';
			$config['allowed_types'] = 'png|jpg|jpeg|gif';			

			date_default_timezone_set('Asia/Jakarta');
			$rename = date('dmY His').strtolower($this->input->post('sld_name'));
			$config['file_name'] = $rename;

			$this->load->library('upload', $config);

			if(!$this->upload->do_upload('sld_image')){
				$errors = array('error' => $this->upload->display_errors());
				$images = $this->input->post('photos');
			} else {
				$data = $this->b_slide_m->ambil_id_gambar($id);
				$path = './assets/img/slide/';
				$nama = $path.$data->sld_image;

				if(file_exists($nama) && unlink($nama)){
					$dataphotos = $this->upload->data();
					$images = $dataphotos['file_name'];
				}
					$dataphotos = $this->upload->data();
					$images = $dataphotos['file_name'];
			}
			$this->b_slide_m->update_slide($images);
			redirect('backoffice/slide/list');
		}
	}

	public function validate_image() {
    $check = TRUE;
    if ((!isset($_FILES['sld_image'])) || $_FILES['sld_image']['size'] == 0) {
        $this->form_validation->set_message('validate_image', '{field} Empty ..!');
        $check = FALSE;
    }
    else if (isset($_FILES['sld_image']) && $_FILES['sld_image']['size'] != 0) {
        $allowedExts = array("png", "PNG", "jpg", "JPG", "jpeg", "JPEG", "gif", "GIF");
        $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
        $extension = pathinfo($_FILES["sld_image"]["name"], PATHINFO_EXTENSION);
        $detectedType = exif_imagetype($_FILES['sld_image']['tmp_name']);
        $type = $_FILES['sld_image']['type'];
        if (!in_array($detectedType, $allowedTypes)) {
            $this->form_validation->set_message('validate_image', 'Invalid Image Content!');
            $check = FALSE;
        }
        if(filesize($_FILES['sld_image']['tmp_name']) > '5000000') {
            $this->form_validation->set_message('validate_image', 'The Image file size shoud not exceed 5MB!');
            $check = FALSE;
        }
        if(!in_array($extension, $allowedExts)) {
            $this->form_validation->set_message('validate_image', "Invalid file extension .{$extension}, Only .png format is allowed");
            $check = FALSE;
        }
    }
    return $check;
	}

	public function validate_image_edit() {
    $check = TRUE;
    if (isset($_FILES['sld_image']) && $_FILES['sld_image']['size'] != 0) {
        $allowedExts = array("png", "PNG", "jpg", "JPG", "jpeg", "JPEG", "gif", "GIF");
        $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
        $extension = pathinfo($_FILES["sld_image"]["name"], PATHINFO_EXTENSION);
        $detectedType = exif_imagetype($_FILES['sld_image']['tmp_name']);
        $type = $_FILES['sld_image']['type'];
        if (!in_array($detectedType, $allowedTypes)) {
            $this->form_validation->set_message('validate_image_edit', 'Invalid Image Content!');
            $check = FALSE;
        }
        if(filesize($_FILES['sld_image']['tmp_name']) > '5000000') {
            $this->form_validation->set_message('validate_image_edit', 'The Image file size shoud not exceed 5MB!');
            $check = FALSE;
        }
        if(!in_array($extension, $allowedExts)) {
            $this->form_validation->set_message('validate_image_edit', "Invalid file extension .{$extension}, Only .png format is allowed");
            $check = FALSE;
        }
    }
    return $check;
	}

	public function slide_name_check()
	{
		$post = $this->input->post(null, TRUE);
		$query = $this->db->query("SELECT * FROM slide WHERE sld_name = '$post[sld_name]' AND sld_id != '$post[sld_id]'");
		if($query->num_rows() > 0){
			$this->form_validation->set_message('sld_check', '{field} Already Exist, Please Input Another Slide Name');
			return FALSE;
		}
			return TRUE;
	}

	public function delete($id){
		$id = decrypt_url($id);
		$data = $this->b_slide_m->ambil_id_gambar($id);//ambil id gambar	  
		$path = './assets/img/slide/';// lokasi gambar berada
		unlink($path.$data->sld_image);// hapus data di folder dimana data tersimpan
		$this->b_slide_m->delete_slide($id);
		redirect('backoffice/slide/list');
	}

}
