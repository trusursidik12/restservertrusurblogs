<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Global_m extends CI_Model {

	public function get_blogs_count($id = null)
    {
        $this->db->from('blogs');
        if($id != null){
            $this->db->where('blg_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }
}