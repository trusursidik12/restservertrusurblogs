<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class B_blogs extends CI_Controller {

	function __construct()
	{
		parent::__construct();		
		check_not_login();
	}

	public function index()
	{
		$data['blogs'] 			= $this->b_blogs_m->get_blogs();
		$data['users'] 			= $this->b_blogs_m->get_users();
		$data['title_header'] 	= "Blogs List";
		$data['title_menu'] 	= "Add Blog";
		$data['controllers'] 	= "blogs";
		
		$this->temp_backend->load('backend/theme/template', 'backend/blogs/blogs/blogs_list', $data);
	}

	public function add(){
		$data['title_header'] 	= 'Add Blog';
		$data['title_menu'] 	= "Blogs List";
		$data['controllers'] 	= "blogs";

		$this->form_validation->set_rules('blg_title', 'Blog Title', 'required|is_unique[blogs.blg_title]');
		$this->form_validation->set_rules('blg_tags[]', 'Tags', 'required');
		$this->form_validation->set_rules('blg_image', 'Image', 'callback_validate_image');

		$this->form_validation->set_message('required', '%s Empty, Please Input..');
		$this->form_validation->set_message('is_unique', '%s Already Exist, Please Input Another Blog Title..');

		if($this->form_validation->run() === FALSE){
			$this->temp_backend->load('backend/theme/template', 'backend/blogs/blogs/blogs_form_add', $data);
		} else {
			$config['upload_path'] = './assets/img/blogs';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';

			date_default_timezone_set('Asia/Jakarta');
			$slug 					= url_title($this->input->post('blg_title'));
			$rename = date('d-m-Y His ').strtolower($slug);
			$config['file_name'] = $rename;

			$this->load->helper('file');
			$this->load->library('upload', $config);

			if(!$this->upload->do_upload('blg_image')){
				$errors = array('error' => $this->upload->display_errors());
				$image = 'noimageblogs.png';
			} else {
				$dataimages = $this->upload->data();
				$image = $dataimages['file_name'];
			}

			$this->b_blogs_m->add_blogs($image);
			redirect('backoffice/blogs/list');
		}
	}

	public function edit($slug = NULL){
		$data['blogs'] 			= $this->b_blogs_m->get_blogsview($slug);
		$data['title_header'] 	= 'Edit Blog';
		$data['title_menu'] 	= "Blogs List";
		$data['controllers'] 	= "blogs";

		if(empty($data['blogs'])){
			show_404();
		}
		
		$this->form_validation->set_rules('blg_title', 'Blog Title', 'required|callback_blogs_title_check');
		$this->form_validation->set_rules('blg_tags[]', 'Tags', 'required');
		$this->form_validation->set_rules('blg_image', 'Image', 'callback_validate_image');

		$this->form_validation->set_message('required', '%s Empty, Please Input..');

		if($this->form_validation->run() === FALSE){
			$this->temp_backend->load('backend/theme/template', 'backend/blogs/blogs/blogs_form_edit', $data);
		} else {
			$id = $this->input->post('blg_id');
			$config['upload_path'] = './assets/img/blogs';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';

			date_default_timezone_set('Asia/Jakarta');
			$slug 					= url_title($this->input->post('blg_title'));
			$rename = date('d-m-Y His ').strtolower($slug);
			$config['file_name'] = $rename;

			$this->load->library('upload', $config);

			if(!$this->upload->do_upload('blg_image')){
				$errors = array('error' => $this->upload->display_errors());
				$image = $this->input->post('images');
			} else {
				$data = $this->b_blogs_m->ambil_id_gambar($id);
				$path = './assets/img/blogs/';
				$nama = $path.$data->blg_image;

				if(file_exists($nama) && unlink($nama)){
					$dataimages = $this->upload->data();
					$image = $dataimages['file_name'];
				}
					$dataimages = $this->upload->data();
					$image = $dataimages['file_name'];
			}
			$this->b_blogs_m->update_blogs($image);
			redirect('backoffice/blogs/list');
		}
	}

	public function status($slug = NULL){
		$data['blogs'] 			= $this->b_blogs_m->get_blogsview($slug);
		$data['title_header'] 	= 'Edit Status';
		$data['title_menu'] 	= "Blogs List";
		$data['controllers'] 	= "blogs";

		if(empty($data['blogs'])){
			show_404();
		}

		$this->form_validation->set_rules('blg_status', 'Blog Status', 'required');

		$this->form_validation->set_message('required', '%s Empty, Please Select..');

		if($this->form_validation->run() === FALSE){
			$this->temp_backend->load('backend/theme/template', 'backend/blogs/blogs/blogs_form_edit_status', $data);
		} else {
			$this->b_blogs_m->update_status();
			redirect('backoffice/blogs/list');
		}
	}

	public function validate_image() {
    $check = TRUE;
    if (isset($_FILES['blg_image']) && $_FILES['blg_image']['size'] != 0) {
        $allowedExts = array("gif", "jpeg", "jpg", "png", "JPG", "JPEG", "GIF", "PNG");
        $allowedTypes = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
        $extension = pathinfo($_FILES["blg_image"]["name"], PATHINFO_EXTENSION);
        $detectedType = exif_imagetype($_FILES['blg_image']['tmp_name']);
        $type = $_FILES['blg_image']['type'];
        if (!in_array($detectedType, $allowedTypes)) {
            $this->form_validation->set_message('validate_image', 'Invalid Image Content!');
            $check = FALSE;
        }
        if(filesize($_FILES['blg_image']['tmp_name']) > 3000000) {
            $this->form_validation->set_message('validate_image', 'The Image file size shoud not exceed 3MB!');
            $check = FALSE;
        }
        if(!in_array($extension, $allowedExts)) {
            $this->form_validation->set_message('validate_image', "Invalid file extension {$extension}, Only .gif | .jpeg | .jpg | .png format is allowed");
            $check = FALSE;
        }
    }
    return $check;
	}

	public function blogs_title_check()
	{
		$post = $this->input->post(null, TRUE);
		$query = $this->db->query("SELECT * FROM blogs WHERE blg_title = '$post[blg_title]' AND blg_id != '$post[blg_id]'");
		if($query->num_rows() > 0){
			$this->form_validation->set_message('blogs_check', '{field} Already Exist, Please Input Another Blog Title');
			return FALSE;
		}
			return TRUE;
	}

	public function delete($id){
		check_bukan_level_staff();
		$id 	= decrypt_url($id);
		$data 	= $this->b_blogs_m->ambil_id_gambar($id);//ambil id gambar	  
		$path 	= './assets/img/blogs/';// lokasi gambar berada
		unlink($path.$data->blg_image);// hapus data di folder dimana data tersimpan
		$this->b_blogs_m->delete_blogs($id);
		redirect('backoffice/blogs/list');
	}
}
