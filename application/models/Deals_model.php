<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Deals_model extends CI_Model {

	

	private $_list_limit = 30;



	public function __construct()

	{

		parent::__construct();

	}

	

	/*

	 * Returns deals

	 */

	public function get_all() {
		$q = $this->db->select('*')->get('deals');
		return $q->result();

	}

	/*

	 * Returns full deal info

	 */

	public function get_one($id) {
		$q = $this->db->select('*')->where('id',$id)->get('deals');
		return $q->result()[0];

	}
	/*

	 * Edit deal

	 */

	public function edit_one($id, $params) {

		$q = $this->db->select('*')->where('id',$id)->update('deals',$params);
		return $q;

	}
	/*

	 * Delete deal

	 */
	public function delete_one($id) {

		$q = $this->db->select('*')->where('id',$id)->delete('deals');
		return $q;

	}



}

