<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Offers_model extends CI_Model {

	

	private $_list_limit = 30;



	public function __construct()

	{

		parent::__construct();

	}

	

	/*

	 * Returns offers

	 */

	public function get_all() {
		$q = $this->db->select('*')->get('offers');
		return $q->result();

	}

	/*

	 * Returns full offer info

	 */

	public function get_one($id) {
		$q = $this->db->select('*')->where('id',$id)->get('offers');
		return $q->result()[0];

	}
	/*

	 * Edit offer

	 */

	public function edit_one($id, $params) {

		$q = $this->db->select('*')->where('id',$id)->update('offers',$params);
		return $q;

	}
	/*

	 * Delete offer

	 */
	public function delete_one($id) {

		$q = $this->db->select('*')->where('id',$id)->delete('offers');
		return $q;

	}



}

