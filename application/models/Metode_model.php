<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Metode_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_pemohon()
	{
		return $this->db->get('pemohon');
	}

	public function get_pemohon_nilai($periode)
	{
		$this->db->select('pemohon.id, no_urut, nilai, id_kriteria');
		$this->db->join('nilai', 'pemohon.id = nilai.id_pemohon');
		return $this->db->get_where('pemohon', ['id_periode'=>$periode]);
	}

	public function get_kriteria()
	{
		$this->db->order_by('kode', 'asc');
		return $this->db->get('kriteria');
	}

	public function get_bobot_kriteria()
	{
		$this->db->order_by('kode', 'asc');
		$this->db->select('bobot');
		return $this->db->get('kriteria');
	}

}

/* End of file Metode_model.php */
/* Location: ./application/models/Metode_model.php */