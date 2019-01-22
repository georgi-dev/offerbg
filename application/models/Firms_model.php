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

		// $this->db
		//print_r($filter);

		//die();
		// $q = $this->db->select('*')->get('firms');
		// $count_rows = $q->num_rows();


	// 	// print_r($q3->result()[0]);

		// die();
		//$this->db->select('SQL_CALC_FOUND_ROWS *', false);
		
		//$this->db->select("SQL_CALC_FOUND_ROWS", FALSE);
		$this->db->select('
						SQL_CALC_FOUND_ROWS null as rows,
						firms.id as firm_id,
						firms.EIK as firm_EIK,
						firms.name as firm_name,
						firms.description as firm_desc,
						firms.verified,
						firms.vat,
						firms.created as firm_created,

						c.name as city,
						c.id as firm_city_id,
						fcities.address as address,
						factivities.activities,
						fcertificates.certificates
						',FALSE)
						->join('firms_cities as fcities', 'firms.id = fcities.FirmID', 'left')
						->join('cities as c', 'c.id = fcities.cityID', 'left')
						->join('firms_activities as factivities', 'firms.id = factivities.FirmID', 'left')
						->join('firms_certificates as fcertificates', 'firms.id = fcertificates.FirmID', 'left');

						if ($filter !== '') {
							$this->db->like('firms.name', $filter);
							$this->db->or_like('firms.description', $filter);
							$this->db->or_like('c.name', $filter);
							$this->db->or_like('firms.verified', $filter);
							$this->db->or_like('fcities.address', $filter);
							$this->db->or_like('fcertificates.certificates', $filter);
							$this->db->or_like('firms.EIK', $filter);
						}
						$this->db->limit($limit, $offset);
						$this->db->order_by('firms.id','desc');
				 		$q1 = $this->db->get('firms');

		$query = $this->db->query('SELECT FOUND_ROWS() AS `count`');
		$totalRows = $query->row()->count; 

				 		//print_r($q1->num_rows());
		 //print_r($this->db->last_query());
		// die();
		
		$sql = '
				SELECT
					*  
				FROM
					activities
				
				';
		$q3 = $this->db->query($sql);
		$firms_activities = $q3->result();
// print_r($firms_activities);

		return array('firms' => $q1->result(),'firms_activities' => $firms_activities, 'count_rows' => $totalRows);
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

// EIK: "1111111 "
// activities: (2) ["2125", "2522"]
// address: "Владислав Очков 45, 354"
// certificates: "нов сертификат"
// city: "5319"
// description: "тест "
// id: "39 "
// name: "NEW FIRM "
// vat: "yes"
// verified: "yes"
	/*

	 * Edit firm

	 */
	public function edit_one($params) {

		// print_r($params);
		// die();
		$firm_params = array(
								"EIK" => $params['EIK'],
								"description" => $params['description'],
								"name" => $params['name'],
								"vat" => $params["vat"],
								"verified" => $params["verified"]
								);

		$q1 = $this->db->where('id',$params['id'])->update('firms',$firm_params); // update firm

		$q2 = $this->db->where('firmID',$params['id'])->update('firms_activities',array("activities" => json_encode($params['activities']))); // update firm activities

		$q3 = $this->db->where('firmID',$params['id'])->update('firms_cities',array("CityID" => $params['city'], "address" => $params['address'])); // update firm city
		$q4 = $this->db->where('firmID',$params['id'])->update('firms_certificates',array("certificates" => json_encode($params['certificates']))); // update firm certificates
		
		if ($q1 && $q2 && $q3 && $q4) {

			return true;
				# code...
		}

	}
	/*

	* Add Firm

	*/

	public function add_firm($params) {


		// print_r($params);

		// die();

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
			$certificates = array();


			foreach ($params['cities'] as $key => $value) {
				$this->add_firm_city($last_id, $params['cities'][$key] , $params['addressess'][$key]);
				# code...
			}

			$this->add_firm_activities($last_id, $activities);
			


			foreach ($params['certificates'] as $key => $certificate) {
					$this->db->where('name',$certificate);
				$q = $this->db->select('name')->from('certificates')->get();
				if ($q->num_rows() == 0) {
					$this->db->insert('certificates',array('name' => $certificate));
					$certificates[] = $certificate;
				}else{
					$certificates[] = $certificate;
				}
				# code...
			}

				$this->add_firm_certificates($last_id, json_encode($certificates));

				// $this->add_firm_city($last_id, $params['cities'][$key] , $params['addressess'][$key]);

			//$this->add_firm_city($last_id, $params['city'], $params['address']);
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


	

	public function delete_one($id) {

		$q = $this->db->select('*')->where('id',$id)->delete('firms');
		return $q;

	}

}

