<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Messages {

	

	protected $CI;

	

	public function __construct()

	{

		// Assign the CodeIgniter super-object

		$this->CI =& get_instance();

	}

	

	public function AddMessage($Message, $Level) {

		$this->CI->session->set_flashdata(array('message' => $Message, 'level' => $Level));

	}

	

	public function GetMessage() {

		return array(

			'Message' => $this->CI->session->flashdata('message'),

			'Level' => $this->CI->session->flashdata('level')

		);

	}

	

}

