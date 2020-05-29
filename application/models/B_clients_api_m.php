<?php

class B_clients_api_m extends CI_Model
{

	public function get_clients()
	{
		$this->db->select('cln_name, cln_image_api, cln_tags');
		$this->db->order_by('cln_id', 'DESC');
		$query = $this->db->get('clients');
		return $query->result_array();
	}
}