<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class B_blogs_m extends CI_Model {

	public function get_blogs($id = FALSE){
		if($id === FALSE){
			$this->db->order_by('blg_id', 'DESC');
			$query = $this->db->get('blogs');
			return $query->result_array();
		}
		$query = $this->db->get_where('blogs', array('blg_id' => $id));
		return $query->row_array();
	}

	public function get_blogsview($slug = FALSE){
		if($slug === FALSE){
			$this->db->order_by('blg_id', 'ASC');
			$query = $this->db->get('blogs');
			return $query->result_array();
		}
		$query = $this->db->get_where('blogs', array('blg_slug' => $slug));
		return $query->row_array();
	}

	public function get_users()
	{
		$this->db->order_by('usr_id', 'ASC');
		$query = $this->db->get('users');
		return $query->result_array();
	}

	public function add_blogs($image){
		$slug 					= url_title($this->input->post('blg_title'));
		$tags 					= implode(',', $this->input->post('blg_tags'));
		$data = array(
			'blg_title' 		=> $this->input->post('blg_title'),
			'blg_slug' 			=> strtolower($slug),
			'blg_image' 		=> $image,
			'blg_image_api' 	=> site_url().'assets/img/blogs/'.$image,
			'blg_video' 		=> $this->input->post('blg_video'),
			'blg_text_content' 	=> $this->input->post('blg_text_content'),
			'blg_tags' 			=> $tags,
			'blg_status' 		=> $this->input->post('blg_status'),
			'blg_created_at' 	=> $this->input->post('blg_created_at', array('type' => 'timestamp')),
			'blg_created_by' 	=> $this->fungsi->user_login()->usr_id
		);
		return $this->db->insert('blogs', $data);
	}

	public function update_blogs($image){
		$tags 					= implode(',', $this->input->post('blg_tags'));
		$data = array(
			'blg_title' 		=> $this->input->post('blg_title'),
			'blg_image' 		=> $image,
			'blg_image_api' 	=> site_url().'assets/img/blogs/'.$image,
			'blg_video' 		=> $this->input->post('blg_video'),
			'blg_text_content' 	=> $this->input->post('blg_text_content'),
			'blg_tags' 			=> $tags,
			'blg_status' 		=> $this->input->post('blg_status'),
			'blg_edited_at' 	=> date('Y-m-d H:i:s'),
			'blg_edited_by' 	=> $this->fungsi->user_login()->usr_id
		);
		$this->db->where('blg_id', $this->input->post('blg_id'));
		return $this->db->update('blogs', $data);
	}

	public function update_status(){
		$data = array(
			'blg_status' 		=> $this->input->post('blg_status'),
			'blg_edited_at' 	=> date('Y-m-d H:i:s'),
			'blg_edited_by' 	=> $this->fungsi->user_login()->usr_id
		);
		$this->db->where('blg_id', $this->input->post('blg_id'));
		return $this->db->update('blogs', $data);
	}

	public function ambil_id_gambar($id){
	$this->db->from('blogs');
	$this->db->where('blg_id', $id);
	$result = $this->db->get('');
	// periksa ada datanya atau tidak
		if ($result->num_rows() > 0) {
		  return $result->row();//ambil datanya berdasrka row id
		}
	}

	public function delete_blogs($id){
		$this->db->where('blg_id', $id);
		$this->db->delete('blogs');
		return TRUE;
	}

}