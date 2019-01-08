<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload_files extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('form', 'url'));
                //$this->load->library('upload');
                $this->load->model('Upload_model');
                $this->load->database();
        }

        public function index()
        {
                $this->load->view('upload_form', array('error' => ' ' ));
        }

    public function set_profile_image() {

        // print_r($_POST);
        // print_r($_FILES);
//          
        $parent_id = $this->input->post('parent_id');

        $parent_type_text = $this->input->post("parent_type");

        switch ($parent_type_text) {
            case 'drivers':
                $parent_type = '1';
                break;
            case 'users':
                $parent_type = '2';
                break;
            case 'trucks':
                $parent_type = '3';
                break;
            case 'shippingagents':
                $parent_type = '4';
                break;
            case 'carriers':
                $parent_type = '5';
                break;
            case 'orders':
                $parent_type = '6';
                break;
            default:
                # code...
                break;
        }

        $file_type_text = $this->input->post("file_type");

        switch ($file_type_text) {
            case 'profile_picture':
                $file_type = '1';
                break;
            // case 'trucks':
            //     $file_type = '2';
            //     break;
            // case 'shippingagents':
            //     $file_type = '3';
            //     break;
            // case 'carriers':
            //     $file_type = '4';
            //     break;
            // case 'orders':
            //     $file_type = '5';
            //     break;
            default:
                # code...
                break;
        }

        $config['upload_path']          = FCPATH . 'upldocs';
        $config['allowed_types']        = 'gif|jpg|png|pdf|xls|xlsx|doc|docx';
        $config['max_size']             = 200000;
        $config['max_width']            = 10424;
        $config['max_height']           = 7648;

        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('userfile'))
            {
                    $error = array('error' => $this->upload->display_errors());
                    
                    echo json_encode(array("error" => $error));
            }
        if($this->upload->do_upload()){

            $data = array('upload_data' => $this->upload->data());
            $image= $data['upload_data']['file_name']; 

            // print_r($image);
            // die();
            $file_name = $data['upload_data']['file_name'];

            $file_path = FCPATH . 'upldocs/' . $file_name;
            // $file_type =  $_FILES['userfile']['type'];
            if($this->Upload_model->set_profile_image($file_name, $file_path, $file_type, $parent_type, $parent_id)){
    
                    echo json_encode(array("msg" => "Success", "file_name" => $file_name));

            }
        };


    }

//        

    public function do_upload() {       

   // print_r($_POST);
   // die();
       $parent_type_text = $this->input->post("parent_type");
        switch ($parent_type_text) {
            case 'admin':
                $parent_type = '1';
                break;
            case 'users':
                $parent_type = '2';
            break;
            case 'firms':
                $parent_type = '3';
                break;
            case 'Ads':
                $parent_type = '4';
                break;
            case 'Offers':
                $parent_type = '5';
                break;
            default:
                # code...
                break;
        }

    
        $parent_id = $this->input->post("parent_id");

        $config['upload_path']          = FCPATH . 'upldocs';
        $config['allowed_types']        = 'gif|jpg|png|pdf|xls|xlsx|doc|docx|txt|zip';
        $config['max_size']             = 0;
        $config['max_width']            = 224343;
        $config['max_height']           = 7648;

        $this->load->library('upload', $config);
        // $this->upload->initialize($config);
        // if ( ! $this->upload->do_upload('userfile'))
        // {
                
        // }
        // else
        // {       
                $files = $_FILES;
                if (count($files) > 0) {
                    # code...
                    
                    $img_array= array();
                    $ext_array = array();
                    $last_ids = array();
                    for($i=0; $i< count($files['userfile']['name']); $i++)
                    {           
                        $_FILES['userfile']['name']= $files['userfile']['name'][$i];
                        $_FILES['userfile']['type']= $files['userfile']['type'][$i];
                        $_FILES['userfile']['tmp_name']= $files['userfile']['tmp_name'][$i];
                        $_FILES['userfile']['error']= $files['userfile']['error'][$i];
                        $_FILES['userfile']['size']= $files['userfile']['size'][$i];    

                        //$this->upload->initialize($config);
                        if($this->upload->do_upload()){

                             $data = array('upload_data' => $this->upload->data());
                            // $image= $data['upload_data']['file_name']; 

                            // print_r($image);
                            // die();
                            $file_name = $_FILES['userfile']['name'];
                            $file_path = FCPATH . 'upldocs/'.$_FILES['userfile']['name'];
                            $file_type =  $_FILES['userfile']['type'][$i];
                            if($this->Upload_model->save_upload($file_path, $file_name, $file_type, $parent_type, $parent_id)){
                                    $last_ids[] = $this->db->insert_id();
                                    $img_array[] = $data['upload_data']['file_name'];
                                    $ext_array[] = $_FILES['userfile']['type'];
                                   
                            }
                        }else{
                            $error = array('error' => $this->upload->display_errors());
                
                            echo json_encode(array("msg" => $error));
                        }
                    }
                     echo json_encode(array("msg" => "Success","ids" => $last_ids, "files_names" => $img_array, "ext_files" => $ext_array));
                     die();
                }
            
    }

    public function delete_galery_image() {
        $file_id = $this->input->post('file_id');

        if($this->db->where('file_id',$file_id)->delete('uploaded_files')){
            echo json_encode(array("msg" => "Deleted"));
        }
    }
}