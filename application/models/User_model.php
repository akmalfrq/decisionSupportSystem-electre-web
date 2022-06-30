<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
	public function get_row($email)
	{
		return $this->db->get_where('user', ['email' => $email])->row_array();
	}	

}

/* End of file User_model.php */
/* Location: ./application/models/User_model.php */