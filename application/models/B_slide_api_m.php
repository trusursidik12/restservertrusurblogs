<?php

class B_slide_api_m extends CI_Model
{

	public function get_slide()
	{
		$this->db->select('sld_name, sld_image_api, sld_tags');
		$this->db->order_by('sld_id', 'DESC');
		$query = $this->db->get('slide');
		return $query->result_array();
	}
}