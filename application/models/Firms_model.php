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

	public function get_all($limit, $offset) {

		$this->db->limit($limit, $offset);
		$q = $this->db->select('*')->get('firms');

		$q1 = $this->db->select('*')->get('firms');
		$count_rows = $q1->num_rows();
		//print_r($count_rows);

		//die();

		return array('firms' => $q->result(), 'count_rows' => $count_rows);

	}

	/*

	 * Returns full firm info 

	 */

	public function get_one($id) {
		$q = $this->db->select('*')->where('id',$id)->get('firms');
		return $q->result()[0];

	}

	/*

	* Add Firm

	*/

	public function add_firm($params) {

		//array_push($params, date("Y m d H:i:s"));
		$params['created'] = date("Y-m-d H:i:s");
		//print_r($params);

		//die();

		if ($this->db->insert('firms', $params)) {
			return true;
		}else{
		    return false;
		}
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

