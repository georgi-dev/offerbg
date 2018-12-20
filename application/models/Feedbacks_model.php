<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Feedbacks_model extends CI_Model {

	

	private $_list_limit = 30;



	public function __construct()

	{

		parent::__construct();

	}

	

	/*

	 * Returns feedbacks

	 */

	public function get_all() {
		$q = $this->db->select('*')->get('feedbacks');
		return $q->result();

	}

	/*

	 * Returns full feedback info

	 */

	public function get_one($id) {
		$q = $this->db->select('*')->where('id',$id)->get('feedbacks');
		return $q->result()[0];

	}
	/*

	 * Edit feedback

	 */

	public function edit_one($id, $params) {

		$q = $this->db->select('*')->where('id',$id)->update('feedbacks',$params);
		return $q;

	}
	/*

	 * Delete feedback

	 */
	public function delete_one($id) {

		$q = $this->db->select('*')->where('id',$id)->delete('feedbacks');
		return $q;

	}



}

