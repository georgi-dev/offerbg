<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
	
	}


	public function getcount() {
		
			// Utils::dump($params);
			
			$sql = '
				SELECT (
	        		SELECT COUNT(*) FROM ads
	        	) AS ads_cnt ,
	        	
	        	(
	        		SELECT COUNT(*) FROM users 
	        	) AS users_cnt,
	        	(
	        		SELECT COUNT(*) FROM firms 
	        	) AS firms_cnt,
				(
	        		SELECT COUNT(*) FROM offers 
	        	) AS offers_cnt,
				
				(
	        		SELECT COUNT(*) FROM deals 
	        	) AS deals_cnt
				

			';
				
			$q = $this->db->query($sql);
			
			$count = $q->result()[0];
			//Utils::dump($count);
			//echo json_encode([
			//	"count" => $count
			//]);

			return $count;	
	}

	public function index() {	

		$q = $this->db->select('*')->from('users')->get();

		// print_r($q->result());

		 $data['users'] = $q->result();

		// $this->load->view('public_pages/home',$data);
		$this->load->view('/public_pages/home', array("count"=>$this->getcount()) );
	}
}
