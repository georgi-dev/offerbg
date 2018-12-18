<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

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
		$this->load->model('Users_model');
	}

	public function getUsers() {	

		$users = $this->Users_model->getUsers();

		if ($this->input->is_ajax_request()) {
		   echo json_encode(array('users' => $users));
		}
		else{
			print_r($users);
		}
	}

	public function getUser($id) {	

		$user = $this->Users_model->getUser($id);

		if ($this->input->is_ajax_request()) {
		   echo json_encode(array('user' => $user));
		}
		else{
			print_r($user);
		}
	}

	public function addUser() {	



		$params = array(
						'fname' => "Иван",
						'lname' => "Иванов",
						'password' => "123456",
						'verified' => "yes",
						'date_registration' => date("Y-m-d H:i:s")
						);

		$user = $this->Users_model->addUser($params);
		
	}

	public function editUser($id) {	

		$params = array(
						'fname' => "Васил",
						'lname' => "Георгиев",
						'verified' => "no",
						);

		$user = $this->Users_model->editUser($id, $params);
		
	}

	public function deleteUser($ID) {

		// if ($this->input->server('REQUEST_METHOD') == 'POST'){

		// 	return "delete user";
		// }


		$this->db->where('userID',$ID);
		$this->db->delete('users');
	}
}
