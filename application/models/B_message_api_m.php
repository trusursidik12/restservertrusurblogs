<?php

class B_message_api_m extends CI_Model
{
	public function add_message()
	{
		$data = array(
			'msg_name' 				=> $this->input->post('msg_name'),
			'msg_email' 			=> $this->input->post('msg_email'),
			'msg_title' 			=> $this->input->post('msg_title'),
			'msg_text' 				=> $this->input->post('msg_text'),
			'msg_created_at' 		=> $this->input->post('msg_created_at', array('type' => 'timestamp'))
		);
		return $this->db->insert('message', $data);
	}
}