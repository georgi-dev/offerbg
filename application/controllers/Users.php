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

		$this->load->helper('url');
		$this->load->database();
		$this->load->model('Users_model');
	}

	public function index() {
		$this->load->view('_admin/users/all_users');
	}

	public function login($Action = NULL) {
		//print_r($_SESSION);

		// die();
		if ($this->auth->IsLogged()) {
				
			 redirect('dashboard');
		} else {
			if ($Action === 'do') {
				$Username = $this->input->post('email');
				$Password = $this->input->post('password');
				
				if (empty($Username) || empty($Password)) {
					redirect('users/login');
				} else {
					if ($this->auth->CheckLoginDetails($Username, $Password)) {

						$user_info = $this->Users_model->GetUserByUsername($Username);
						
						if ($user_info->type == "admin") {
							$this->session->set_userdata('user_id',$user_info->UserID);
							$this->session->set_userdata('user_data',$user_info);
							//$this->load->view('/admin/dashboard',$user_info);
							redirect('/dashboard',$user_info);
						}
						elseif ($user_info->type == "user") {
							// $this->load->view('/admin/dashboard',$user_info);
							redirect('/dashboard',$user_info);
							# code...
						}
						elseif($user_info->type == "firm"){
							redirect('/firms/dashboard',$user_info);
						}
						// $this->load->model('Upload_model');
						// $UserProfileImage =  $this->Upload_model->GetProfileImage($user_info->user_id,'2');
						
						// $this->session->set_userdata('profile_image',$UserProfileImage[0]->file_name);
						// $this->load->view('header',$h); 
						
					} else {
						$this->session->set_flashdata('username', $Username);
						
						$this->messages->AddMessage('Wrong username or password.', 'danger');
						
						redirect('_users/login');
					}
				}
			} else {
				$this->load->view('_user/login');
			}
		}
	}

	public function logout() {
		if ($this->auth->IsLogged()) {
			$this->messages->AddMessage('You\'ve been signed out.', 'success');
		}
		
		$this->auth->Logout();
		
		redirect('/users/login');
	}

	public function registration($Action = NULL) {

			if ($Action === 'do') {

				$Username = $this->input->post('email');
				$Password = $this->input->post('password');
				$RepeatPassword = $this->input->post('password2');
				$FirstName = $this->input->post('firstname');
				$LastName = $this->input->post('lastname');
				$Phone = $this->input->post('phone');
				$City = $this->input->post('city');

				if (empty($Username) || empty($Password) || empty($FirstName) || empty($LastName || empty($Phone) || empty($City))) {
					$this->session->set_flashdata('fusername', $Username);
					$this->session->set_flashdata('firstname', $FirstName);
					$this->session->set_flashdata('lastname', $LastName);
					$this->session->set_flashdata('lastname', $Phone);
					$this->session->set_flashdata('lastname', $City);
					
					$this->messages->AddMessage('Please, fill in all the fields.', 'danger');
					
					redirect('users/registration');
				} elseif ($Password !== $RepeatPassword) {
					$this->session->set_flashdata('fusername', $Username);
					$this->session->set_flashdata('firstname', $FirstName);
					$this->session->set_flashdata('lastname', $LastName);
					$this->session->set_flashdata('lastname', $Phone);
					$this->session->set_flashdata('lastname', $City);
					
					$this->messages->AddMessage('Passwords doesn\'t match.', 'danger');
					
					redirect('users/registration');
				} else {
					$RegisterStatus = $this->auth->Register($Username, $Password, $FirstName, $LastName, $Phone, $City);
					if ($RegisterStatus === AUTH_REG_SUCCESS) {
						$this->messages->AddMessage('Administrator created.', 'success');
						
						redirect('users/login');
					} elseif ($RegisterStatus === AUTH_REG_USERNAME_IN_USE) {
						$this->session->set_flashdata('fusername', $Username);
						$this->session->set_flashdata('firstname', $FirstName);
						$this->session->set_flashdata('lastname', $LastName);
						$this->session->set_flashdata('lastname', $Phone);
						$this->session->set_flashdata('lastname', $City);
						
						$this->messages->AddMessage('E-mail is in use.', 'danger');
						
						redirect('users/registration');
					} elseif ($RegisterStatus === AUTH_REG_DATABASE_ERROR) {
						$this->session->set_flashdata('fusername', $Username);
						$this->session->set_flashdata('firstname', $FirstName);
						$this->session->set_flashdata('lastname', $LastName);
						$this->session->set_flashdata('lastname', $Phone);
						$this->session->set_flashdata('lastname', $City);
						
						$this->messages->AddMessage('There was an error while trying to create the account. Please, try again later.', 'danger');
						
						redirect('users/registration');
					}
				}
			}
			else {
					$q = $this->db->select('*')->from('cities')->get();
					$data = array('Cities' => $q->result());
					$this->load->view('_user/registration', $data);
				}
		// if ($this->auth->IsLogged()) {
		// 	if ($this->auth->HavePermission('ManageAdmins')) {
		// 		if ($Action === 'do') {
		// 			$Username = $this->input->post('email');
		// 			$Password = $this->input->post('password');
		// 			$RepeatPassword = $this->input->post('password2');
		// 			$FirstName = $this->input->post('firstname');
		// 			$LastName = $this->input->post('lastname');
					
		// 			if (empty($Username) || empty($Password) || empty($FirstName) || empty($LastName)) {
		// 				$this->session->set_flashdata('fusername', $Username);
		// 				$this->session->set_flashdata('firstname', $FirstName);
		// 				$this->session->set_flashdata('lastname', $LastName);
						
		// 				$this->messages->AddMessage('Please, fill in all the fields.', 'danger');
						
		// 				redirect('user/create');
		// 			} elseif ($Password !== $RepeatPassword) {
		// 				$this->session->set_flashdata('fusername', $Username);
		// 				$this->session->set_flashdata('firstname', $FirstName);
		// 				$this->session->set_flashdata('lastname', $LastName);
						
		// 				$this->messages->AddMessage('Passwords doesn\'t match.', 'danger');
						
		// 				redirect('user/create');
		// 			} else {
		// 				$RegisterStatus = $this->auth->Register($Username, $Password, $FirstName, $LastName);
		// 				if ($RegisterStatus === AUTH_REG_SUCCESS) {
		// 					$this->messages->AddMessage('Administrator created.', 'success');
							
		// 					redirect('user/create');
		// 				} elseif ($RegisterStatus === AUTH_REG_USERNAME_IN_USE) {
		// 					$this->session->set_flashdata('fusername', $Username);
		// 					$this->session->set_flashdata('firstname', $FirstName);
		// 					$this->session->set_flashdata('lastname', $LastName);
							
		// 					$this->messages->AddMessage('E-mail is in use.', 'danger');
							
		// 					redirect('user/create');
		// 				} elseif ($RegisterStatus === AUTH_REG_DATABASE_ERROR) {
		// 					$this->session->set_flashdata('fusername', $Username);
		// 					$this->session->set_flashdata('firstname', $FirstName);
		// 					$this->session->set_flashdata('lastname', $LastName);
							
		// 					$this->messages->AddMessage('There was an error while trying to create the account. Please, try again later.', 'danger');
							
		// 					redirect('user/create');
		// 				}
		// 			}
		// 		} else {
		// 			$this->load->view('user/create');
		// 		}
		// 	} else {
		// 		// TODO: Add error page display?
		// 		redirect('/');
		// 	}
		// } else {
		// 	redirect('/');
		// }
	}

	public function getUsers() {	

		$page = $this->input->post('page');
		$limit = 2;
		$offset = ($page - 1) * $limit;
		$filter = $this->input->post('filter');

		$result = $this->Users_model->getUsers($limit, $offset, $filter);

		$pages = ceil($result['count_rows'] / $limit);

		echo json_encode(array('users' => $result['users'], 'pages' => $pages, 'totalrecords' => $result['count_rows']));
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
						'first_name' => "Иван",
						'last_name' => "Иванов",
						'password' => "123456",
						'verified' => "yes",
						'date_registration' => date("Y-m-d H:i:s")
						);

		$user = $this->db->insert('users',$params);
		
	}

	public function edit($id) {
		$user = $this->Users_model->GetUserById($id);

		$this->load->model('Cities_model');
		$cities = $this->Cities_model->get_all();

		// $this->load->model('Activities_model');
		// $activities = $this->Activities_model->get_all();

		$this->load->view('_admin/users/edit_user',array('user' => $user,'Cities' => $cities));

	}

	public function edit_user($id) {	


		if ($this->input->server('REQUEST_METHOD') == 'GET')
			$this->load->view('_admin/users/edit_user');
		else if ($this->input->server('REQUEST_METHOD') == 'POST')
		// print_r($_POST);
		// die();
		 if ($this->Firms_model->edit_one($_POST)) {
		 	echo json_encode(array('status'=>'Inserted'));
		 }

		// $params = array(
		// 				'fname' => "Васил",
		// 				'lname' => "Георгиев",
		// 				'verified' => "no",
		// 				);

		// $user = $this->Users_model->editUser($id, $params);
		
	}

	public function delete_one() {

		// if ($this->input->server('REQUEST_METHOD') == 'POST'){

		// 	return "delete user";
		// }


		$this->db->where('userID',$this->input->post('id'));
		$this->db->delete('users');
		echo json_encode(array("status" => 'Deleted'));
	}
}
