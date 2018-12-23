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
		$this->load->view('admin/firms/all_firms');
	}
	public function firm($id) {
		$firm = $this->Firms_model->get_one($id);
		$this->load->view('admin/firms/edit_firm',array('firm' => $firm));

	}
	public function add_firm() {

		if ($this->input->server('REQUEST_METHOD') == 'GET')
			$this->load->view('admin/firms/add_firm');
		else if ($this->input->server('REQUEST_METHOD') == 'POST')

			//print_r("POST");
			
			//print_r($_POST);

			 if ($this->Firms_model->add_firm($_POST)) {
			 	echo json_encode(array('status'=>'Inserted'));
			 }

	}

	public function get_all() {

		$page = $this->input->post('page');
		$limit = 2;
		$offset = ($page - 1) * $limit;
		$filter = $this->input->post('filter');

		$result = $this->Firms_model->get_all($limit, $offset, $filter);

		$pages = ceil($result['count_rows'] / $limit);

		echo json_encode(array('firms' => $result['firms'], 'pages' => $pages, 'totalrecords' => $result['count_rows']));
	}

	public function get_one($id) {
		$firm = $this->Firms_model->get_one($id);

		echo json_encode(array('firm' => $firm));
	}

	public function edit_firm(){

		// $params = array('name' => 'newDSZI');

		// if ($this->Firms_model->edit_one($id, $params)) {
		// 	echo json_encode(array("status" => 'Updated'));
		// }


		if ($this->input->server('REQUEST_METHOD') == 'GET')
			$this->load->view('admin/firms/edit_firm');
		else if ($this->input->server('REQUEST_METHOD') == 'POST')
		// print_r($_POST);
		// die();
		 if ($this->Firms_model->edit_one($_POST)) {
		 	echo json_encode(array('status'=>'Inserted'));
		 }

	}

	public function delete_one(){

		//print_r($_POST);
		//return "test";
		//print_r($this->input->server('REQUEST_METHOD'));
		if ($this->Firms_model->delete_one($_POST['id'])) {
			echo json_encode(array("status" => 'Deleted'));
		}
	}
}
