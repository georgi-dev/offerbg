<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_model extends CI_Model {
	
	private $_list_limit = 2;
	public function __construct()
	{
		parent::__construct();

	}
	
	/*
	 * Returns full info by id
	 */
	function save_upload($file_path, $file_name, $file_type, $parent_type, $parent_id){
        $data = array(
                'file_path' => $file_path,
                'file_name' => $file_name,
                'file_type' => $file_type,
                'parent_type' => $parent_type,
                'parent_id' => $parent_id
            );

        // print_r($data);

        // die();
        $result= $this->db->insert('uploaded_files',$data);
        return $result;
    }

    function set_profile_image($file_name, $file_path, $file_type, $parent_type, $parent_id){



    	$data = array(
                'file_path' => $file_path,
                'file_type' => $file_type,
                'file_name' => $file_name,
                'parent_type' => $parent_type,
                'parent_id' => $parent_id
            );

        // print_r($data);

        // die();
        $q = $this->db->select('file_name')->where(array('parent_id' => $parent_id, 'file_type' => '1', 'parent_type' => $parent_type))->from('uploaded_files')->get();
        // print_r($q);
        if ($q->num_rows() > 0) {
             $this->db->where(array('parent_id' => $parent_id, 'file_type' => '1', 'parent_type' => $parent_type));
             $result = $this->db->update('uploaded_files',$data);
        } else {
             $result = $this->db->insert('uploaded_files',$data);
        }
       

        
        // $result1 = $this->db->where("user_id", $user_id)->update('admins',array("image" => $file_name));
        			
        return $result;
    }

    public function GetFiles($parent_id, $parent_type) {
        $q = $this->db->select('*')->where(array('parent_id' => $parent_id, 'parent_type' => $parent_type))->from('uploaded_files')->get();
        return $q->result();
    }

    public function GetProfileImage($parent_id, $parent_type) {
        $q = $this->db->select('*')->where(array('file_type' => '1','parent_id' => $parent_id, 'parent_type' => $parent_type))->from('uploaded_files')->get();
        return $q->result();
    }

    public function GetAllProfileImages($parent_type) {
        $q = $this->db->select('*')->where(array('parent_type' => $parent_type))->from('uploaded_files')->get();
        return $q->result();
    }
}
