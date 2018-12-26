<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ads extends CI_Controller {

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

		$this->load->library('session');

		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->model('Ads_model');
	}

	public function index() {	

		$q = $this->db->select('*')->from('users')->get();

		// print_r($q->result());

		 $data['users'] = $q->result();

		// $this->load->view('public_pages/home',$data);
		$this->load->view('user/dashboard');
	}

	public function get_all() {
		$ads = $this->Ads_model->get_all();

		echo json_encode(array('ads' => $ads));
	}


	public function get_one($id) {
		$ad = $this->Ads_model->get_one($id);

		echo json_encode(array('ad' => $ad));
	}

	public function add_ad() {

		if ($this->input->server('REQUEST_METHOD') == 'GET') {

			// $this->load->model('Activities_model');
			// $activities = $this->Activities_model->get_all();

			// $this->load->model('Cities_model');
			// $cities = $this->Cities_model->get_all();
			// print_r($activities);

			// die();
			$this->load->model('Firms_model');
			$firms = $this->Firms_model->get_all(null, null, null);
			$data = array("Firms" => $firms);

			$this->load->view('admin/ads/add_ad',$data);

		}

			

		else if ($this->input->server('REQUEST_METHOD') == 'POST') {
			// print_r($_POST);
			// die();
			//print_r($_POST);

			 if ($this->Ads_model->add_ad($_POST)) {
			 	echo json_encode(array('status'=>'Inserted'));
			 }
		}

			

	}

	public function edit_one($id){

		$params = array();

		if ($this->Ads_model->edit_one($id, $params)) {
			echo json_encode(array("status" => 'Updated'));
		}
	}

	public function delete_one($id){

		if ($this->Ads_model->delete_one($id)) {
			echo json_encode(array("status" => 'Deleted'));
		}
	}
}
