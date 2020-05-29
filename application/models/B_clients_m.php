<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class B_clients_m extends CI_Model {

	public function get_clients($id = FALSE){
		if($id === FALSE){
			$this->db->order_by('cln_id', 'DESC');
			$query = $this->db->get('clients');
			return $query->result_array();
		}
		$query = $this->db->get_where('clients', array('cln_id' => $id));
		return $query->row_array();
	}

	public function get_clientsview($slug = FALSE){
		if($slug === FALSE){
			$this->db->order_by('cln_id', 'ASC');
			$query = $this->db->get('clients');
			return $query->result_array();
		}
		$query = $this->db->get_where('clients', array('cln_slug' => $slug));
		return $query->row_array();
	}

	public function get_users()
	{
		$this->db->order_by('usr_id', 'ASC');
		$query = $this->db->get('users');
		return $query->result_array();
	}

	public function add_clients($images){
		$slug 					= url_title($this->input->post('cln_name'));
		$tags 					= implode(',', $this->input->post('cln_tags'));
		$data = array(
			'cln_name'			=> $this->input->post('cln_name'),
			'cln_slug	' 		=> strtolower($slug),
			'cln_image	' 		=> $images,
			'cln_image_api' 	=> site_url().'assets/img/clients/'.$images,
			'cln_tags	' 		=> $tags,
			'cln_created_at'	=> $this->input->post('cln_created_at', array('type' => 'timestamp')),
			'cln_created_by'	=> $this->fungsi->user_login()->usr_id
		);
		return $this->db->insert('clients', $data);
	}

	public function update_clients($images){
		$tags 					= implode(',', $this->input->post('cln_tags'));
		$data = array(
			'cln_name'			=> $this->input->post('cln_name'),
			'cln_image	' 		=> $images,
			'cln_image_api' 	=> site_url().'assets/img/clients/'.$images,
			'cln_tags	' 		=> $tags,
			'cln_edited_at' 	=> date('Y-m-d H:i:s'),
			'cln_edited_by' 	=> $this->fungsi->user_login()->usr_id
		);
		$this->db->where('cln_id', $this->input->post('cln_id'));
		return $this->db->update('clients', $data);
	}

	public function ambil_id_gambar($id){
	$this->db->from('clients');
	$this->db->where('cln_id', $id);
	$result = $this->db->get('');
	// periksa ada datanya atau tidak
		if ($result->num_rows() > 0) {
		  return $result->row();//ambil datanya berdasrka row id
		}
	}

	public function delete_clients($id){
		$this->db->where('cln_id', $id);
		$this->db->delete('clients');
		return TRUE;
	}

}