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

	public function get_all($limit, $offset, $filter) {

		// $this->db
		// if ($filter !== '') {
		// 	$this->db->like('ads.title', $filter);
		// 	$this->db->or_like('ads.description', $filter);
		// 	// $this->db->or_like('ads.EIK', $filter);
		// }
		$q = $this->db->select('*')->get('offers');
		$count_rows = $q->num_rows();


	// 	// print_r($q3->result()[0]);

		// die();
		$q1 = $this->db->select('
						offers.id as offer_id,
						offers.FirmID as firm_id,
						offers.AdsID as offer_ad,
						offers.description as offer_desc,
						offers.price as offer_price,
						offers.files as offer_files,
						offers.delvery_time as delivery_time,
						offers.created as created
						
						')
						//->join('users as u', 'u.UserID = ads.UserID', 'left')
						// ->join('cities as c', 'c.id = fcities.cityID', 'left')
						// ->join('firms_activities as factivities', 'firms.id = factivities.FirmID', 'left')
						// ->join('firms_certificates as fcertificates', 'firms.id = fcertificates.FirmID', 'left')
						->limit($limit, $offset)
						->order_by('offers.id','desc')
				 		->get('offers');
		// print_r($q1->result());
		// die();

		$sql = '
				SELECT
					file_id,
					file_path,
					file_name
				FROM
					uploaded_files
				WHERE 
				parent_type = 4
				';
		$q3 = $this->db->query($sql);
		$uploaded_files = $q3->result();
// print_r($firms_activities);

		return array('offers' => $q1->result(), 'uploaded_files' => $uploaded_files, 'count_rows' => $count_rows);
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

