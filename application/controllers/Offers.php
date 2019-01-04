<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Offers extends CI_Controller {

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

		$this->load->model('Offers_model');
		
	}

	public function index() {	

		// $q = $this->db->select('*')->from('users')->get();

		// print_r($q->result());

		 // $data['users'] = $q->result();

		// $this->load->view('public_pages/home',$data);
		$this->load->view('admin/offers/all_offers');
	}

	public function get_all() {

		$page = $this->input->post('page');
		$limit = 2;
		$offset = ($page - 1) * $limit;
		$filter = $this->input->post('filter');

		$result = $this->Offers_model->get_all($limit, $offset, $filter);

		$pages = ceil($result['count_rows'] / $limit);

		echo json_encode(array('offers' => $result['offers'],'uploaded_files' => $result['uploaded_files'], 'pages' => $pages, 'totalrecords' => $result['count_rows']));
	}


	public function get_one($id) {
		$offer = $this->Offers_model->get_one($id);

		echo json_encode(array('offer' => $offer));
	}

	public function edit_one($id){

		$params = array();

		if ($this->Offers_model->edit_one($id, $params)) {
			echo json_encode(array("status" => 'Updated'));
		}
	}

	public function delete_one($id){

		if ($this->Offers_model->delete_one($id)) {
			echo json_encode(array("status" => 'Deleted'));
		}
	}
}
