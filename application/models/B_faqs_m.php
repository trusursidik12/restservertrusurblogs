<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class B_faqs_m extends CI_Model {

	public function get_faqs($sslug = FALSE){
		if($sslug === FALSE){
			$this->db->order_by('faq_id', 'DESC');
			$query = $this->db->get('faqs');
			return $query->result_array();
		}
		$query = $this->db->get_where('faqs', array('faq_slug' => $sslug));
		return $query->row_array();
	}

	public function get_users()
	{
		$this->db->order_by('usr_id', 'ASC');
		$query = $this->db->get('users');
		return $query->result_array();
	}

	public function add_faqs(){
		$slug 					= url_title($this->input->post('faq_question'));
		$tags 					= implode(',', $this->input->post('faq_tags'));
		$data = array(
			'faq_question' 		=> $this->input->post('faq_question'),
			'faq_slug' 			=> strtolower($slug),
			'faq_answer' 		=> $this->input->post('faq_answer'),
			'faq_tags' 			=> $tags,
			'faq_created_at' 	=> $this->input->post('faq_created_at', array('type' => 'timestamp')),
			'faq_created_by' 	=> $this->fungsi->user_login()->usr_id
		);
		return $this->db->insert('faqs', $data);
	}

	public function update_faqs(){
		$slug 					= url_title($this->input->post('faq_question'));
		$tags 					= implode(',', $this->input->post('faq_tags'));
		$data = array(
			'faq_question' 		=> $this->input->post('faq_question'),
			'faq_slug' 			=> strtolower($slug),
			'faq_answer' 		=> $this->input->post('faq_answer'),
			'faq_tags' 			=> $tags,
			'faq_edited_at' 	=> date('Y-m-d H:i:s'),
			'faq_edited_by' 	=> $this->fungsi->user_login()->usr_id
		);
		$this->db->where('faq_id', $this->input->post('faq_id'));
		return $this->db->update('faqs', $data);
	}

	public function delete_faqs($id){
		$this->db->where('faq_id', $id);
		$this->db->delete('faqs');
		return TRUE;
	}
}