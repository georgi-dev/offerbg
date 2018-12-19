<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Users_model extends CI_Model {

	

	private $_list_limit = 30;



	public function __construct()

	{

		parent::__construct();

	}

	

	/*

	 * Returns full user info by email

	 */

	public function GetUserByUsername($Username) {

		return $this->db->where('email', $Username)->limit(1)->get('users')->row();

	}

	

	/*

	 * Returns full user info by user id

	 */

	public function GetUserById($UserId) {

		return $this->db->where('user_id', $UserId)->limit(1)->get('users')->row();

	}

	

	/*

	 * Returns whether an email is in use

	 */

	public function UsernameExists($Username) {

		$Count = $this->db->where('email', $Username)->count_all_results('users');

		

		return ($Count > 0);

	}

	

	/*

	 * Insert the user into the database

	 */

	public function AddUser($Username, $Password, $FirstName, $LastName) {

		$Data = array(

			'email' => $Username,

			'password' => $Password,

			'first_name' => $FirstName,

			'last_name' => $LastName

		);

		

		return $this->db->insert('users', $Data);

	}

	

	/*

	 * Edit user

	 */

	public function EditUser($UserId, /*$Username,*/ $Password, $FirstName, $LastName) {

		$Data = array(

			//'email' => $Username,

			'first_name' => $FirstName,

			'last_name' => $LastName

		);

		

		if (!empty($Password)) {

			$Data['password'] = $Password;

		}

		

		return $this->db->where('user_id', $UserId)->update('users', $Data);

	}

	

	/*

	 * Delete user

	 */

	public function DeleteUser($UserId) {

		return $this->db->where('user_id', $UserId)->delete('users');

	}

	

	/*

	 * Get list limit

	 */

	public function GetLimit() {

		return $this->_list_limit;

	}

	

	/*

	 * Get user list

	 */

	public function GetList($Start = 0) {

		// return $this->db->order_by('user_id', 'ASC')->limit($this->GetLimit(), $Start)->get('users')->result();
		$sql = '
				SELECT 
						
						users.*,
						uf.*
					FROM 
						users
					
					JOIN uploaded_files uf ON uf.parent_id = users.user_id
					WHERE uf.file_type= 1 AND uf.parent_type = 2
					ORDER BY users.user_id ASC

				
				
				';
		$q = $this->db->query($sql);

		$rows = $q->result();
		return $rows;
	}

	

	/*

	 * Get users total

	 */

	public function GetTotal() {

		return $this->db->count_all_results('users');

	}



}

