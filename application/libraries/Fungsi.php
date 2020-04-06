<?php

class Fungsi
{
	
	protected $ci;

	function __construct(){
		$this->ci =& get_instance();
	}

	function user_login(){
		$this->ci->load->model('b_users_m');
		$users_id = $this->ci->session->userdata('userid');
		$users_data = $this->ci->b_users_m->get($users_id)->row();
		return $users_data;
	}

	public function count_blogs()
	{
		return $this->ci->global_m->get_blogs_count()->num_rows();
	}
	
}