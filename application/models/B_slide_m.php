<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class B_slide_m extends CI_Model {

	public function get_slide($id = FALSE){
		if($id === FALSE){
			$this->db->order_by('sld_id', 'DESC');
			$query = $this->db->get('slide');
			return $query->result_array();
		}
		$query = $this->db->get_where('slide', array('sld_id' => $id));
		return $query->row_array();
	}

	public function get_slideview($slug = FALSE){
		if($slug === FALSE){
			$this->db->order_by('sld_id', 'ASC');
			$query = $this->db->get('slide');
			return $query->result_array();
		}
		$query = $this->db->get_where('slide', array('sld_slug' => $slug));
		return $query->row_array();
	}

	public function get_users()
	{
		$this->db->order_by('usr_id', 'ASC');
		$query = $this->db->get('users');
		return $query->result_array();
	}

	public function add_slide($images){
		$slug 					= url_title($this->input->post('sld_name'));
		$tags 					= implode(',', $this->input->post('sld_tags'));
		$data = array(
			'sld_name'			=> $this->input->post('sld_name'),
			'sld_slug	' 		=> strtolower($slug),
			'sld_image	' 		=> $images,
			'sld_image_api' 	=> site_url().'assets/img/slide/'.$images,
			'sld_tags	' 		=> $tags,
			'sld_created_at'	=> $this->input->post('sld_created_at', array('type' => 'timestamp')),
			'sld_created_by'	=> $this->fungsi->user_login()->usr_id
		);
		return $this->db->insert('slide', $data);
	}

	public function update_slide($images){
		$tags 					= implode(',', $this->input->post('sld_tags'));
		$data = array(
			'sld_name'			=> $this->input->post('sld_name'),
			'sld_image	' 		=> $images,
			'sld_image_api' 	=> site_url().'assets/img/slide/'.$images,
			'sld_tags	' 		=> $tags,
			'sld_edited_at' 	=> date('Y-m-d H:i:s'),
			'sld_edited_by' 	=> $this->fungsi->user_login()->usr_id
		);
		$this->db->where('sld_id', $this->input->post('sld_id'));
		return $this->db->update('slide', $data);
	}

	public function ambil_id_gambar($id){
	$this->db->from('slide');
	$this->db->where('sld_id', $id);
	$result = $this->db->get('');
	// periksa ada datanya atau tidak
		if ($result->num_rows() > 0) {
		  return $result->row();//ambil datanya berdasrka row id
		}
	}

	public function delete_slide($id){
		$this->db->where('sld_id', $id);
		$this->db->delete('slide');
		return TRUE;
	}

}