<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Firms_model extends CI_Model {

	

	private $_list_limit = 30;



	public function __construct()

	{

		parent::__construct();

	}

	

	/*

	 * Returns firms

	 */

	public function get_all() {
		$q = $this->db->select('*')->get('firms');
		return $q->result();

	}

	/*

	 * Returns full firm info 

	 */

	public function get_one($id) {
		$q = $this->db->select('*')->where('id',$id)->get('firms');
		return $q->result()[0];

	}
	/*

	 * Edit firm

	 */

	public function edit_one($id, $params) {

		$q = $this->db->select('*')->where('id',$id)->update('firms',$params);
		return $q;

	}

	public function delete_one($id) {

		$q = $this->db->select('*')->where('id',$id)->delete('firms');
		return $q;

	}

}

