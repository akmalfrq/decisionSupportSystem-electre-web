<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kriteria_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function gets()
	{
		$this->db->order_by('kode', 'asc');
		return $this->db->get('kriteria')->result_array();
	}

	public function get($kode)
	{
		return $this->db->get_where('kriteria', ['kode'=>$kode])->row_array();
	}

	public function gets_pilihan()
	{
		return $this->db->get('pilihan_kriteria')->result_array();
	}

	public function get_pilihan($id_kriteria)
	{
		return $this->db->get_where('pilihan_kriteria', ['id_kriteria'=>$id_kriteria])->result_array();
	}

	public function insert($data, $variabel='', $nilai='')
	{
		$this->db->trans_begin();

		$this->db->insert('kriteria', $data);

		if ($data['jenis_input']=="pilihan" && !empty($variabel) && !empty($nilai)) {
			$pilihan = array();
			for ($i=0; $i < count($variabel); $i++) { 
				array_push($pilihan, array(
					'id_kriteria'=>$this->db->insert_id(),
					'nama'=>$variabel[$i],
					'nilai'=>floatval($nilai[$i])
				));
			}
			$this->db->insert_batch('pilihan_kriteria', $pilihan);
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
		    $this->db->trans_commit();
		    return TRUE;
		}
	}

	public function update($id, $data, $id_pil, $variabel, $nilai)
	{		
		$this->db->trans_begin();

		$this->db->where('id', $id);
		$this->db->update('kriteria', $data);

		if ($data['jenis_input']=="pilihan" && !empty($variabel) && !empty($nilai)) {
			$pilihan = array();
			$arr_id_pil = array();
			foreach ($variabel as $i => $v) {
				if ($id_pil[$i]) {
					$arr_id_pil[] = $id_pil[$i];
					$this->db->where('id', $id_pil[$i]);
					$this->db->update('pilihan_kriteria', [
						'nama' => $v,
						'nilai' => floatval($nilai[$i])
					]);
				} else {
					array_push($pilihan, array(
						'id_kriteria'=>$id,
						'nama'=>$v,
						'nilai'=>floatval($nilai[$i])
					));
				}
			}
			
			$this->db->where('id_kriteria', $id);
			if ($arr_id_pil!=null) {
				$this->db->where_not_in('id', $arr_id_pil);
			}
			$this->db->delete('pilihan_kriteria');

			if (!empty($pilihan)) {
				$this->db->insert_batch('pilihan_kriteria', $pilihan);
			}
		} elseif ($data['jenis_input']=="langsung") {
			$this->db->delete('pilihan_kriteria', ['id_kriteria'=>$id]);
		}

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
		    $this->db->trans_commit();
		    return TRUE;
		}
	}

	public function delete($id)
	{
		$this->db->trans_begin();

		$this->db->where('id', $id);
		$this->db->delete('kriteria');

		$this->db->where('id_kriteria', $id);
		$this->db->delete('pilihan_kriteria');

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			return FALSE;
		} else {
		    $this->db->trans_commit();
		    return TRUE;
		}
	}

	public function kriteria_join_pilihan()
	{
		$this->db->order_by('kode', 'asc');
		$this->db->select('kriteria.*, pilihan_kriteria.id as id_pil, pilihan_kriteria.nama as pilihan, nilai');
		$this->db->join('pilihan_kriteria', 'kriteria.id = pilihan_kriteria.id_kriteria','left');
		return $this->db->get('kriteria');
	}

}

/* End of file Kriteria_model.php */
/* Location: ./application/models/Kriteria_model.php */