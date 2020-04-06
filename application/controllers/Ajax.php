<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		$method = $_SERVER['REQUEST_METHOD'];
		if($method == "OPTIONS") {
		die();
		}
	}

	public function get_ajax() {
        $list = $this->ajax_m->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $cams) {
            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = $cams->id_stasiun;
            $row[] = $cams->waktu;
            $row[] = $cams->h2s;
            $row[] = $cams->cs2;
            $row[] = round($cams->h2s / 1500, 3);
            $row[] = round($cams->cs2 / 3130, 3);
            $row[] = $cams->ws;
            $row[] = $cams->wd;
            $row[] = $cams->humidity;
            $row[] = $cams->temperature;
            $row[] = $cams->pressure;
            $row[] = $cams->sr;
            $row[] = $cams->rain_intensity;
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->ajax_m->count_all(),
                    "recordsFiltered" => $this->ajax_m->count_filtered(),
                    "data" => $data,
                );
        // output to json format
        echo json_encode($output);
    }
	
	public function get_ajax2() {
        $list = $this->ajax_m->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $cams) {
            $no++;
            $row = array();
            $row[] = $no.".";
            $row[] = $cams->id_stasiun;
            $row[] = $cams->waktu;
            $row[] = $cams->h2s;
            $row[] = $cams->cs2;
            $row[] = round($cams->h2s / 1500, 3);
            $row[] = round($cams->cs2 / 3130, 3);
            $row[] = $cams->ws;
            $row[] = $cams->wd;
            $row[] = $cams->humidity;
            $row[] = $cams->temperature;
            $row[] = $cams->pressure;
            $row[] = $cams->sr;
            $row[] = $cams->rain_intensity;
            $data[] = $row;
        }
        $output = array(
                    "draw" => @$_POST['draw'],
                    "recordsTotal" => $this->ajax_m->count_all(),
                    "recordsFiltered" => $this->ajax_m->count_filtered(),
                    "data" => $data,
                );
		$this->output
        ->set_content_type("Access-Control-Allow-Origin: *")
        ->set_content_type("Access-Control-Allow-Methods: POST")
        ->set_content_type("Access-Control-Allow-Headers: Origin, Methods, Content-Type");
        // output to json format
        echo json_encode($output);
    }
}