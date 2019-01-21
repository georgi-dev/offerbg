<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Ads_model extends CI_Model {

	

	private $_list_limit = 30;



	public function __construct()

	{

		parent::__construct();
		$this->load->database();
	}

	

			/*

	 * Returns ads

	 */

	public function get_all($limit, $offset, $filter) {

		// $this->db
		if ($filter !== '') {
			$this->db->like('ads.title', $filter);
			$this->db->or_like('ads.description', $filter);
			// $this->db->or_like('ads.EIK', $filter);
		}
		$q = $this->db->select('*')->get('ads');
		$count_rows = $q->num_rows();


	// 	// print_r($q3->result()[0]);

		// die();
		$q1 = $this->db->select('
						ads.id as ad_id,
						u.email as creator,
						ads.title as title,
						ads.description as ad_desc,
						ads.invited_firms as invited_firms,
						ads.type,
						ads.date_valid,
						ads.date_create as created,
						ads.files as files,
						(SELECT time_format(timediff(NOW(), ads.date_create),"%H:%i:%s")) as left_time
						')
						->join('users as u', 'u.UserID = ads.UserID', 'left')
						// ->join('cities as c', 'c.id = fcities.cityID', 'left')
						// ->join('firms_activities as factivities', 'firms.id = factivities.FirmID', 'left')
						// ->join('firms_certificates as fcertificates', 'firms.id = fcertificates.FirmID', 'left')
						->limit($limit, $offset)
						->order_by('ads.id','desc')
				 		->get('ads');
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

		return array('ads' => $q1->result(), 'uploaded_files' => $uploaded_files, 'count_rows' => $count_rows);
	}

	/*

	 * Returns full ad info

	 */

	public function get_one($id) {
		$q = $this->db->select('*')->where('id',$id)->get('ads');
		return $q->result()[0];

	}

	public function add_ad($params) {

		// print_r($params);
		// die();
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
					"files" => json_encode($params["files"]),
					"invited_firms" => json_encode($params['firms']),
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

