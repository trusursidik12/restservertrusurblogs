<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class B_clients extends CI_Controller {

	function __construct(){
		parent::__construct();		
		check_not_login();
		check_bukan_level_staff();
	}

	public function index(){
		$data['clients'] 		= $this->b_clients_m->get_clients();
		$data['users'] 			= $this->b_clients_m->get_users();
		$data['title_header'] 	= "Clients List";
		$data['title_menu'] 	= "Add Clients";
		$data['controllers'] 	= "clients";
		$this->temp_backend->load('backend/theme/template', 'backend/clients/clients_list', $data);
	}

	public function add(){
		$data['title_header'] 	= "Add Clients";
		$data['title_menu'] 	= "Clients List";
		$data['controllers'] 	= "clients";

		$this->form_validation->set_rules('cln_name', 'Clients Name', 'required|is_unique[clients.cln_name]');
		$this->form_validation->set_rules('cln_image', 'Clients Image', 'callback_validate_image');
		$this->form_validation->set_rules('cln_tags[]', 'Clients Tags', 'required');
		
		$this->form_validation->set_message('required', '%s Empty..!');
		$this->form_validation->set_message('is_unique', '%s Already Exist, Please Input Another Clients Name..');

		if($this->form_validation->run() === FALSE){
			$this->temp_backend->load('backend/theme/template', 'backend/clients/clients_form_add', $data);
		} else {
			$config['upload_path'] = './assets/img/clients';
			$config['allowed_types'] = 'png|jpg|jpeg|gif';

			date_default_timezone_set('Asia/Jakarta');
			$rename = date('d-m-Y His ').strtolower($this->input->post('cln_name'));
			$config['file_name'] = $rename;

			$this->load->library('upload', $config);

			if(!$this->upload->do_upload('cln_image')){
				$errors = array('error' => $this->upload->display_errors());
				$images = 'noimageclients.png';
			} else {
				$dataclientshomepage = $this->upload->data();
				$images = $dataclientshomepage['file_name'];
			}

			$this->b_clients_m->add_clients($images);
			redirect('backoffice/clients/list');
		}
	}

	public function edit($slug = NULL){
		$data['clients'] 		= $this->b_clients_m->get_clientsview($slug);
		$data['title_header'] 	= "Edit Clients";
		$data['title_menu'] 	= "clients";
		$data['controllers'] 	= "clients";

		if(empty($data['clients'])){
			show_404();
		}

		$this->form_validation->set_rules('cln_name', 'Clients Name', 'required|callback_clients_name_check');
		$this->form_validation->set_rules('cln_image', 'Clients Image', 'callback_validate_image_edit');
		$this->form_validation->set_rules('cln_tags[]', 'Clients Tags', 'required');

		$this->form_validation->set_message('required', '%s Empty, Please Input..');

		if($this->form_validation->run() === FALSE){
			$this->temp_backend->load('backend/theme/template', 'backend/clients/clients_form_edit', $data);
		} else {
			$id = $this->input->post('cln_id');
			$config['upload_path'] = './assets/img/clients';
			$config['allowed_types'] = 'png|jpg|jpeg|gif';			

			date_default_timezone_set('Asia/Jakarta');
			$rename = date('dmY His').strtolower($this->input->post('cln_name'));
			$config['file_name'] = $rename;

			$this->load->library('upload', $config);

			if(!$this->upload->do_upload('cln_image')){
				$errors = array('error' => $this->upload->display_errors());
				$images = $this->input->post('photos');
			} else {
				$data = $this->b_clients_m->ambil_id_gambar($id);
				$path = './assets/img/clients/';
				$nama = $path.$data->cln_image;

				if(file_exists($nama) && unlink($nama)){
					$dataphotos = $this->upload->data();
					$images = $dataphotos['file_name'];
				}
					$dataphotos = $this->upload->data();
					$images = $dataphotos['file_name'];
			}
			$this->b_clients_m->update_clients($images);
			redirect('backoffice/clients/list');
		}
	}

	public function validate_image() {
    $check = TRUE;
    if ((!isset($_FILES['cln_image'])) || $_FILES['cln_image']['size'] == 0) {
        $this->form_validation->set_message('validate_image', '{field} Empty ..!');
        $check = FALSE;
    }
    else if (isset($_FILES['cln_image']) && $_FILES['cln_image']['size'] != 0) {
        $allowedExts = array("png", "PNG", "jpg", "JPG", "jpeg", "JPEG", "gif", "GIF");
        $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
        $extension = pathinfo($_FILES["cln_image"]["name"], PATHINFO_EXTENSION);
        $detectedType = exif_imagetype($_FILES['cln_image']['tmp_name']);
        $type = $_FILES['cln_image']['type'];
        if (!in_array($detectedType, $allowedTypes)) {
            $this->form_validation->set_message('validate_image', 'Invalid Image Content!');
            $check = FALSE;
        }
        if(filesize($_FILES['cln_image']['tmp_name']) > '1000000') {
            $this->form_validation->set_message('validate_image', 'The Image file size shoud not exceed 1MB!');
            $check = FALSE;
        }
        if(!in_array($extension, $allowedExts)) {
            $this->form_validation->set_message('validate_image', "Invalid file extension .{$extension}, Only .png, jpg, jpeg, gif format is allowed");
            $check = FALSE;
        }
    }
    return $check;
	}

	public function validate_image_edit() {
    $check = TRUE;
    if (isset($_FILES['cln_image']) && $_FILES['cln_image']['size'] != 0) {
        $allowedExts = array("png", "PNG", "jpg", "JPG", "jpeg", "JPEG", "gif", "GIF");
        $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
        $extension = pathinfo($_FILES["cln_image"]["name"], PATHINFO_EXTENSION);
        $detectedType = exif_imagetype($_FILES['cln_image']['tmp_name']);
        $type = $_FILES['cln_image']['type'];
        if (!in_array($detectedType, $allowedTypes)) {
            $this->form_validation->set_message('validate_image_edit', 'Invalid Image Content!');
            $check = FALSE;
        }
        if(filesize($_FILES['cln_image']['tmp_name']) > '1000000') {
            $this->form_validation->set_message('validate_image_edit', 'The Image file size shoud not exceed 1MB!');
            $check = FALSE;
        }
        if(!in_array($extension, $allowedExts)) {
            $this->form_validation->set_message('validate_image_edit', "Invalid file extension .{$extension}, Only .png, jpg, jpeg, gif format is allowed");
            $check = FALSE;
        }
    }
    return $check;
	}

	public function clients_name_check()
	{
		$post = $this->input->post(null, TRUE);
		$query = $this->db->query("SELECT * FROM clients WHERE cln_name = '$post[cln_name]' AND cln_id != '$post[cln_id]'");
		if($query->num_rows() > 0){
			$this->form_validation->set_message('cln_check', '{field} Already Exist, Please Input Another Clients Name');
			return FALSE;
		}
			return TRUE;
	}

	public function delete($id){
		$id = decrypt_url($id);
		$data = $this->b_clients_m->ambil_id_gambar($id);//ambil id gambar	  
		$path = './assets/img/clients/';// lokasi gambar berada
		unlink($path.$data->cln_image);// hapus data di folder dimana data tersimpan
		$this->b_clients_m->delete_clients($id);
		redirect('backoffice/clients/list');
	}

}
