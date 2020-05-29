<?php

class B_faqs_api_m extends CI_Model
{

	public function get_faqs($id = FALSE)
	{
		if($id === FALSE){
			$this->db->select('faq_id, faq_question, faq_answer, faq_tags');
			$this->db->order_by('faq_id', 'DESC');
			$query = $this->db->get('faqs');
			return $query->result_array();
		}
		$query = $this->db->get_where('faqs', array('faq_id' => $id));
		return $query->row_array();
	}
}