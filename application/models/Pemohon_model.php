<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemohon_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function gets()
	{
		return $this->db->get('pemohon');
	}

	public function get($id)
	{
		return $this->db->get_where('pemohon', ['id'=>$id]);
	}

	public function get_pemohon_periode($id)
	{
		$this->db->select('pemohon.*, periode.periode');
		$this->db->join('periode', 'pemohon.id_periode = periode.id');
		return $this->db->get_where('pemohon', ['pemohon.id'=>$id]);
	}

	public function get_kriteria_nilai($id_pemohon, $fun)
	{
		if ($fun=='detail') {
			$this->db->select('nama, nilai');
		} elseif($fun=='update') {
			$this->db->select('kriteria.id, nama, jenis_input, nilai.id as id_nilai, nilai.nilai as nilai');
		}
		$this->db->join('nilai', 'kriteria.id = nilai.id_kriteria AND id_pemohon = '.$id_pemohon, 'left');
		return $this->db->get('kriteria');
	}

	public function insert($data, $nilai_insert)
	{
		$this->db->trans_begin();
		$this->db->insert('pemohon', $data);

		$nilai = [];
		$i=0;
		foreach ($nilai_insert as $k => $v) {
			$nilai[$i] = [
				'id_pemohon' => $this->db->insert_id(),
				'id_kriteria'=> $k,
				'nilai'=> $v
			];
			$i++;
		}

		$this->db->insert_batch('nilai', $nilai);
		
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
		    $this->db->trans_commit();
		    return TRUE;
		}
	}

	public function update($data, $nilai_update, $id)
	{
		$this->db->trans_begin();
		$this->db->update('pemohon', $data, ['id'=>$id]);

		$nilai = [];
		$i=0;
		foreach ($nilai_update as $k => $v) {
			$nilai[$i] = [
				'id' => $k,
				'nilai'=> $v
			];
			$i++;
		}

		$this->db->update_batch('nilai', $nilai, 'id');
		
		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
		    $this->db->trans_commit();
		    return TRUE;
		}
	}

	public function get_max_urut()
	{
		$this->db->select_max('no_urut', 'max');
		return $this->db->get('pemohon');
	}

	public function delete($id)
	{
		$this->db->trans_begin();

		$this->db->delete('pemohon', ['id'=>$id]);
		$this->db->delete('nilai', ['id_pemohon'=>$id]);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
		    $this->db->trans_commit();
		    return TRUE;
		}
	}

}

/* End of file Pemohon_model.php */
/* Location: ./application/models/Pemohon_model.php */