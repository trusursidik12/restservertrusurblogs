<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class B_message_m extends CI_Model {

	public function get_message($id = FALSE){
		if($id === FALSE){
			$this->db->order_by('msg_id', 'DESC');
			$query = $this->db->get('message');
			return $query->result_array();
		}
		$query = $this->db->get_where('message', array('msg_id' => $id));
		return $query->row_array();
	}

	public function delete_message($id){
		$this->db->where('msg_id', $id);
		$this->db->delete('message');
		return TRUE;
	}

}