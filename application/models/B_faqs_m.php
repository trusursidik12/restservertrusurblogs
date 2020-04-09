<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class B_faqs_m extends CI_Model {

	public function get_faqs($id = FALSE){
		if($id === FALSE){
			$this->db->order_by('faq_id', 'DESC');
			$query = $this->db->get('faqs');
			return $query->result_array();
		}
		$query = $this->db->get_where('faqs', array('faq_id' => $id));
		return $query->row_array();
	}

	public function get_users()
	{
		$this->db->order_by('usr_id', 'ASC');
		$query = $this->db->get('users');
		return $query->result_array();
	}

	public function update_faqs(){
		$tags 					= implode(',', $this->input->post('faq_tags'));
		$data = array(
			'faq_desc' 			=> $this->input->post('faq_desc'),
			'faq_tags' 			=> $tags,
			'faq_edited_at' 	=> date('Y-m-d H:i:s'),
			'faq_edited_by' 	=> $this->fungsi->user_login()->usr_id
		);
		$this->db->where('faq_id', $this->input->post('faq_id'));
		return $this->db->update('faqs', $data);
	}
}