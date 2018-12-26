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

	public function add_ad($params) {

// 		Array
// (
//     [creator] => 8
//     [title] => tirle
//     [description] => 4234234
//     [type] => public
//     [firms] => Array
//         (
//             [0] => 40
//             [1] => 39
//             [2] => 38
//         )

// )
		$data = array(
					"UserID" => $params['creator'],
					"title" => $params['title'],
					"description" => $params['description'],
					"type" => $params["type"],
					"date_create" => date("Y-m-d H:i:s"),
					"date_valid" => $params["date_valid"]
					);

		if($this->db->insert('ads',$data)){
			return true;

		}

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

