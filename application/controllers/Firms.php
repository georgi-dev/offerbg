<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Firms extends CI_Controller {

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
		$this->load->helper('url');

		$this->load->model('Firms_model');
		
	}

	public function index() {	

		$firms = $this->Firms_model->get_all();

		echo json_encode(array('firms' => $firms));
	}

	public function get_all() {
		$firms = $this->Firms_model->get_all();

		echo json_encode(array('firms' => $firms));
	}

	public function get_one($id) {
		$firm = $this->Firms_model->get_one($id);

		echo json_encode(array('firm' => $firm));
	}

	public function edit_one($id){

		$params = array('name' => 'newDSZI');

		if ($this->Firms_model->edit_one($id, $params)) {
			echo json_encode(array("status" => 'Updated'));
		}
	}

	public function delete_one($id){

		if ($this->Firms_model->delete_one($id)) {
			echo json_encode(array("status" => 'Deleted'));
		}
	}
}
