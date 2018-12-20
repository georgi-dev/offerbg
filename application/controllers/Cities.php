<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cities extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct() {

		parent:: __construct();

		$this->load->database();

		$this->load->library('pagination');	

		$this->load->library('form_validation');
		
		$this->load->model('Cities_model');
		
	}

	public function index() {	

		$cities = $this->Cities_model->get_all();

		echo json_encode(array('cities' => $cities));
	}

	public function get_all() {
		$cities = $this->Cities_model->get_all();

		echo json_encode(array('cities' => $cities));
	}


	public function get_one($id) {
		$city = $this->Cities_model->get_one($id);

		echo json_encode(array('city' => $city));
	}

	public function edit_one($id){

		$params = array();

		if ($this->Cities_model->edit_one($id, $params)) {
			echo json_encode(array("status" => 'Updated'));
		}
	}

	public function delete_one($id){

		if ($this->Cities_model->delete_one($id)) {
			echo json_encode(array("status" => 'Deleted'));
		}
	}
}
