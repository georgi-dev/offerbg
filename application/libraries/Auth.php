<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Auth {

	

	protected $CI;

	

	private $_is_logged = FALSE;

	private $_userinfo = NULL;

	

	public function __construct()

	{

		// Assign the CodeIgniter super-object

		$this->CI =& get_instance();

		

		define('AUTH_REG_SUCCESS', 0);

		define('AUTH_REG_USERNAME_IN_USE', 1);

		define('AUTH_REG_DATABASE_ERROR', 2);

	}

	

	/*

	 * Returns whether or not an user is authenticated into the system

	 */

	public function IsLogged() {

		if ($this->_is_logged) {

			return TRUE;

		}

		

		$Username = $this->CI->session->userdata('username');

		$Password = $this->CI->session->userdata('password');

		

		if (empty($Username) || empty($Password)) {

			return FALSE;

		} else {

			$this->CI->load->model('Users');

			

			$UserInfo = $this->CI->Users->GetUserByUsername($Username);

			

			if ($UserInfo) {

				if ($Password === $this->GetPasswordForSession($UserInfo->password)) {

					// Remove unneeded information from the $UserInfo object

					unset($UserInfo->password);

					

					// Fill user information into the class variables

					$this->_userinfo = $UserInfo;

					

					// Set logged status

					$this->_is_logged = TRUE;

					

					return TRUE;

				}

			}

			

			return FALSE;

		}

	}

	

	/*

	 * Returns part of the password hash to keep in the session

	 */

	private function GetPasswordForSession($Password) {

		$PasswordLen = strlen($Password);

		

		return substr($Password, 0, floor($PasswordLen / 2));

	}

	

	/*

	 * Checks if user exists and if the password matches

	 */

	public function CheckLoginDetails($Username, $Password, $UpdateSession = TRUE) {

		$this->CI->load->model('Users');

		

		$UserInfo = $this->CI->Users->GetUserByUsername($Username);

		if ($UserInfo) {

			// Check if passwords match

			if ($this->CheckPassword($Password, $UserInfo->password)) {

				if ($UpdateSession) {

					$this->Login($UserInfo);

				}

				

				return TRUE;

			}

		}

		

		return FALSE;

	}

	

	/*

	 * Encrypts a password

	 */

	public function EncryptPassword($Password) {

		return password_hash($Password, PASSWORD_DEFAULT);

	}

	

	/*

	 * Checks if a password matches the encrypted version

	 */

	public function CheckPassword($Password, $EncryptedPassword) {

		return password_verify($Password, $EncryptedPassword);

	}

	

	/*

	 * Set session data

	 */

	public function Login($UserInfo) {

		$this->load
		$Data = array(
			
			'username' => $UserInfo->email,

			'password' => $this->GetPasswordForSession($UserInfo->password)

		);



		$this->CI->session->set_userdata($Data);

	}

	

	/*

	 * Logout the user (unset session data)

	 */

	public function Logout() {

		$this->CI->session->unset_userdata(array('username', 'password'));

	}

	

	/*

	 * Register an user account

	 */

	public function Register($Username, $Password, $FirstName, $LastName) {

		$this->CI->load->model('Users');

		

		if ($this->CI->Users->UsernameExists($Username)) {

			return AUTH_REG_USERNAME_IN_USE;

		} else {

			if ($this->CI->Users->AddUser($Username, $this->EncryptPassword($Password), $FirstName, $LastName)) {

				return AUTH_REG_SUCCESS;

			} else {

				return AUTH_REG_DATABASE_ERROR;

			}

		}

	}

	

	public function EditUser($UserId, $Password, $FirstName, $LastName) {

		$this->CI->load->model('Users');

		

		if (!$this->CanEditUser($UserId)) {

			return AUTH_EDIT_CANT_EDIT;

		} else {

			if (!empty($Password)) {

				$Password = $this->EncryptPassword($Password);

			}

			

			if ($this->CI->Users->EditUser($UserId, $Password, $FirstName, $LastName)) {

				return AUTH_EDIT_SUCCESS;

			} else {

				return AUTH_EDIT_DATABASE_ERROR;

			}

		}

	}

	

	public function DeleteUser($UserId) {

		$this->CI->load->model('Users');

		

		return $this->CI->Users->DeleteUser($UserId);

	}

	

	/*

	 * Checks if the currently logged in user have permission

	 */

	public function HavePermission($Permission) {

		return TRUE;

	}

	

	/*

	 * Checks if the user exists and can be edited by the currently logged in user

	 */

	public function CanEditUser($UserId, $SkipExistsCheck = FALSE) {

		if ($UserId == $this->GetUserId()) {

			return FALSE;

		}

		

		$this->CI->load->model('Users');

		if (!$SkipExistsCheck) {

			if (!$this->CI->Users->GetUserById($UserId)) {

				return FALSE;

			}

		}

		

		return TRUE;

	}

	

	/*

	 * User details

	 */

	private function GetUserVar($Variable, $Escape = TRUE) {

		if (isset($this->_userinfo->$Variable)) {

			if ($Escape) {

				return htmlspecialchars($this->_userinfo->$Variable);

			}

			

			return $this->_userinfo->$Variable;

		}

		

		return NULL;

	}

	

	public function GetUserId() {

		return $this->GetUserVar('user_id');

	}

	

	public function GetFirstName($Escape = TRUE) {

		return $this->GetUserVar('first_name', $Escape);

	}

	

	public function GetLastName($Escape = TRUE) {

		return $this->GetUserVar('last_name', $Escape);

	}

	

	public function GetFullName($Escape = TRUE) {

		return $this->GetFirstName($Escape) . " " . $this->GetLastName($Escape);

	}

	

	public function GetEmail($Escape = TRUE) {

		return $this->GetUserVar('email', $Escape);

	}

	

}

