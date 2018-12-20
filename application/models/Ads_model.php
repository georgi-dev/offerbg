<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Ads_model extends CI_Model {

	

	private $_list_limit = 30;



	public function __construct()

	{

		parent::__construct();

	}

	

			/*

	 * Returns ads

	 */

	public function get_all() {
		$q = $this->db->select('*')->get('ads');
		return $q->result();

	}

	/*

	 * Returns full ad info

	 */

	public function get_one($id) {
		$q = $this->db->select('*')->where('id',$id)->get('ads');
		return $q->result()[0];

	}
	/*

	 * Edit ad

	 */

	public function edit_one($id, $params) {

		$q = $this->db->select('*')->where('id',$id)->update('ads',$params);
		return $q;

	}
	/*

	 * Delete ad

	 */
	public function delete_one($id) {

		$q = $this->db->select('*')->where('id',$id)->delete('ads');
		return $q;

	}



}

