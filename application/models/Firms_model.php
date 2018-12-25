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

	public function get_all($limit, $offset, $filter) {

		$this->db->limit($limit, $offset);
		if ($filter !== '') {
			$this->db->like('firms.name', $filter);
			$this->db->or_like('firms.description', $filter);
			$this->db->or_like('firms.EIK', $filter);
		}
		$q = $this->db->select('*')->get('firms');

		$q1 = $this->db->select('*')->get('firms');
		$count_rows = $q1->num_rows();
		

		return array('firms' => $q->result(), 'count_rows' => $count_rows);
	}

	/*

	 * Returns full firm info 

	 */

	public function get_one($id) {
		// $q = $this->db->select('*')->where('id',$id)->get('firms');
		// return $q->result()[0];

		$sql = '
							SELECT
								firms.id as firm_id,
								firms.EIK as firm_EIK,
								firms.name as firm_name,
								firms.description as firm_desc,
								firms.verified,
								firms.vat,
								firms.created as firm_created,

								c.name as firm_city,
								c.id as firm_city_id,
								fcities.address as firm_address,
								factivities.activities,
								fcertificates.certificates
							FROM
								firms

							LEFT JOIN firms_cities as fcities ON firms.id = fcities.FirmID
							LEFT JOIN cities as c ON c.id = fcities.cityID

							LEFT JOIN firms_activities as factivities ON firms.id = factivities.FirmID
							LEFT JOIN firms_certificates as fcertificates ON firms.id = fcertificates.FirmID
							WHERE firms.id = '.$id.'
						';
		$q = $this->db->query($sql);
		return $q->result()[0];
	}

	/*

	* Add Firm

	*/

	public function add_firm($params) {

		$data = array(
						"EIK" => $params["EIK"],
					    "name" => $params["name"],
					    "description" => $params["description"],
					    "verified" => $params["verified"],
					    "vat" => $params["vat"],
					    "created" => date("Y-m-d H:i:s")
						);

		if ($this->db->insert('firms', $data)) {

			$last_id = $this->db->insert_id();

			$activities = json_encode($params['activities']);
			$certificates = json_encode($params['certificates']);



			$this->add_firm_activities($last_id, $activities);
			$this->add_firm_certificates($last_id, $certificates);
			$this->add_firm_city($last_id, $params['city'], $params['address']);
			return true;
		}else{
		    return false;
		}
	}


	public function add_firm_activities($firm_id, $activities) {

		//array_push($params, date("Y m d H:i:s"));
		
		//print_r($params);

		//die();
		$data = array(
						"FirmID" => $firm_id,
						"activities" => $activities,
						"created" => date("Y-m-d H:i:s")
						);

		if ($this->db->insert('firms_activities', $data)) {

			//$last_id = $this->db->insert_id();
			
			return true;
		}else{
		    return false;
		}
	}

	public function add_firm_certificates($firm_id, $certificates) {

		//array_push($params, date("Y m d H:i:s"));
		
		//print_r($params);

		//die();
		$data = array(
						"FirmID" => $firm_id,
						"certificates" => $certificates,
						"created" => date("Y-m-d H:i:s")
						);

		if ($this->db->insert('firms_certificates', $data)) {

			//$last_id = $this->db->insert_id();
			
			return true;
		}else{
		    return false;
		}
	}

	public function add_firm_city($firm_id, $city, $address) {

		$data = array(
						"FirmID" => $firm_id,
						"CityID" => $city,
						"address" => $address,
						'created' => date("Y-m-d H:i:s")

						);

		if ($this->db->insert('firms_cities', $data)) {

			//$last_id = $this->db->insert_id();
			
			return true;
		}else{
		    return false;
		}
	}
	/*

	 * Edit firm

	 */

	public function edit_one($params) {

		$q = $this->db->select('*')->where('id',$params['id'])->update('firms',$params);
		return $q;

	}

	public function delete_one($id) {

		$q = $this->db->select('*')->where('id',$id)->delete('firms');
		return $q;

	}

}

