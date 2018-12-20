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
						
						// $this->load->model('Upload_model');
						// $UserProfileImage =  $this->Upload_model->GetProfileImage($user_info->user_id,'2');
						
						// $this->session->set_userdata('profile_image',$UserProfileImage[0]->file_name);
						// $this->load->view('header',$h); 
						redirect('/dashboard',$user_info);
					} else {
						$this->session->set_flashdata('username', $Username);
						
						$this->messages->AddMessage('Wrong username or password.', 'danger');
						
						redirect('users/login');
					}
				}
			} else {
				$this->load->view('user/login');
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
					$this->load->view('user/registration', $data);
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
