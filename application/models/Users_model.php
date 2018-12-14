<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users_model extends CI_Model
{
	public function __construct()
	{
		parent:: __construct();
		$this->load->database();
	}

	
	public function getUsers() {
		$q = $this->db->select('*')->from('users')->get();
		$users = $q->result();
		return $users;
	}

	public function getUser($id) {

		$this->db->where('UserID',$id);

		$q = $this->db->select('*')->from('users')->get();
		$users = $q->result();

		return $users;
		
	}

	public function addUser($params) {

		$q = $this->db->insert('users',$params);

		if($q){
			return $q;
		}
		
	}

	public function editUser($id, $params) {
		$this->db->where('UserID',$id);
		$q = $this->db->update('users', $params);

		if($q){
			return $q;
		}
		
	}
	
}
?>
