<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Periode_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function gets()
	{
		return $this->db->get('periode')->result_array();
	}

	public function insert($object)
	{
		$this->db->insert('periode', $object);
		if ($this->db->affected_rows()) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

}

/* End of file Periode_model.php */
/* Location: ./application/models/Periode_model.php */