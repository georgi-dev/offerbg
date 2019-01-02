<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Users_model extends CI_Model {

	

	private $_list_limit = 30;



	public function __construct()

	{

		parent::__construct();

	}

	
	public function GetUsers($limit, $offset, $filter) {

		if ($filter !== '') {
			$this->db->like('users.name', $filter);
			$this->db->or_like('users.description', $filter);
			$this->db->or_like('users.EIK', $filter);
		}
		$q = $this->db->select('*')->get('users');
		$count_rows = $q->num_rows();


	// 	// print_r($q3->result()[0]);
// UserID	int(11) Auto Increment	
// first_name	varchar(200)	
// last_name	varchar(200)	
// email	text	
// phone	text	
// password	varchar(255)	
// type	enum('admin','user')	
// city_id	int(11)	
// date_registration	datetime	
// verified
		// die();
		$q1 = $this->db->select('
						users.UserID as user_id,
						users.first_name as fname,
						users.last_name as lname,
						users.email as user_email,
						users.phone as user_phone,
						users.type as user_type,
						users.date_registration as user_registration_date,
						users.verified as user_verified,
						c.name as city,
						c.id as user_city_id
						')
						->join('cities as c', 'c.id = users.city_id', 'left')
						->limit($limit, $offset)
						->order_by('users.UserID','desc')
				 		->get('users');
		// print_r($q1->result());
		// die();

		// $sql = '
		// 		SELECT
		// 			*  
		// 		FROM
		// 			activities
				
		// 		';
		// $q3 = $this->db->query($sql);
		// $firms_activities = $q3->result();
// print_r($firms_activities);

		return array('users' => $q1->result(),/*'firms_activities' => $firms_activities,*/ 'count_rows' => $count_rows);

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

		return $this->db->where('UserID', $UserId)->limit(1)->get('users')->row();

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

	public function AddUser($Username, $Password, $FirstName, $LastName, $Phone, $CityId) {

		$Data = array(

			'email' => $Username,

			'password' => $Password,

			'first_name' => $FirstName,

			'last_name' => $LastName,

			'phone' 	=> $Phone,

			'city_id' 	=> $CityId,

			'date_registration' => date("Y-m-d H:i:s")

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

