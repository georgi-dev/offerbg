<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Activities_model extends CI_Model {

	

	private $_list_limit = 30;



	public function __construct()

	{

		parent::__construct();

	}

	

			/*

	 * Returns activities

	 */

	public function get_all() {
		$q = $this->db->select('*')->get('activities');
		return $q->result();

	}

	/*

	 * Returns full activity info

	 */

	public function get_one($id) {
		$q = $this->db->select('*')->where('id',$id)->get('activities');
		return $q->result()[0];

	}
	/*

	 * Edit activity

	 */

	public function edit_one($id, $params) {

		$q = $this->db->select('*')->where('id',$id)->update('activities',$params);
		return $q;

	}
	/*

	 * Delete activity

	 */
	public function delete_one($id) {

		$q = $this->db->select('*')->where('id',$id)->delete('activities');
		return $q;

	}



}

