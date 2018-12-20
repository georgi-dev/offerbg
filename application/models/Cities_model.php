<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Cities_model extends CI_Model {

	

	private $_list_limit = 30;



	public function __construct()

	{

		parent::__construct();

	}

	

		/*

	 * Returns cities

	 */

	public function get_all() {
		$q = $this->db->select('*')->get('cities');
		return $q->result();

	}

	/*

	 * Returns full city info 

	 */

	public function get_one($id) {
		$q = $this->db->select('*')->where('id',$id)->get('cities');
		return $q->result()[0];

	}
	/*

	 * Edit city

	 */

	public function edit_one($id, $params) {

		$q = $this->db->select('*')->where('id',$id)->update('cities',$params);
		return $q;

	}
	/*

	 * Delete city

	 */
	public function delete_one($id) {

		$q = $this->db->select('*')->where('id',$id)->delete('cities');
		return $q;

	}



}

