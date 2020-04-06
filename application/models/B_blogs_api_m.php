<?php

class B_blogs_api_m extends CI_Model
{

	public function get_blogs($id = FALSE)
	{
		if($id === FALSE){
			$this->db->select('blg_id, blg_title, blg_slug, blg_image_api, blg_video, blg_text_content, blg_tags, blg_status, blg_created_at');
			$this->db->order_by('blg_id', 'DESC');
			$this->db->where('blg_status', '1');
			$query = $this->db->get('blogs');
			return $query->result_array();
		}
		$query = $this->db->get_where('blogs', array('blg_slug' => $id));
		return $query->row_array();
	}
}