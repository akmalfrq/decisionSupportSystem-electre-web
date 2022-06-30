<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function gets()
	{
		return $this->db->get_where('user', ['role_id'=>2])->result_array();
	}

	public function insert($data)
	{
		$this->db->insert('user', $data);
		if ($this->db->affected_rows()) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	public function get($nip)
	{
		return $this->db->get_where('user', ['no_id'=>$nip])->row_array();
	}

	public function update($id, $nama)
	{
		if ($this->db->update('user', ['nama'=>$nama], "id = ${id}")) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function update_status($id, $status)
	{
		if ($status>0) {
			$this->db->update('user', ['is_active'=>0], ['id'=>$id]);
		} else {
			$this->db->update('user', ['is_active'=>1], ['id'=>$id]);
		}

		if ($this->db->affected_rows()) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
}

/* End of file Pegawai_model.php */
/* Location: ./application/models/Pegawai_model.php */