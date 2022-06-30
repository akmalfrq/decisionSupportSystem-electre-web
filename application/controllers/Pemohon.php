<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemohon extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('user_model', 'user');
		$this->load->model('pemohon_model', 'pemohon');
	}

	public function index()
	{
		if ($this->input->get()) {
			$this->detail($this->input->get('i'));
			return FALSE;
		}
		$data['title'] = "Data Pemohon";
		$data['content'] = "content/pemohon/index";
		$data['user'] = $this->user->get_row($this->session->userdata('email'));

		$data['pemohon'] = $this->pemohon->gets();

		$this->load->view('layout', $data);
	}

	public function detail()
	{
		$id = $this->input->get('i');
		$data['title'] = "Detail Data Pemohon";
		$data['content'] = "content/pemohon/detail";
		$data['user'] = $this->user->get_row($this->session->userdata('email'));

		$data['pemohon'] = $this->pemohon->get_pemohon_periode($id)->row_array();
		$data['nilaiPemohon'] = $this->pemohon->get_kriteria_nilai($id, 'detail')->result_array();

		$this->load->view('layout', $data);
	}

	public function tambah()
	{
		$data['title'] = "Tambah Pemohon";
		$data['content'] = "content/pemohon/tambah";
		$data['user'] = $this->user->get_row($this->session->userdata('email'));

		$this->load->model('kriteria_model','kriteria');
		$data['kriteria'] = $this->kriteria->gets();
		$data['pilihan'] = $this->kriteria->gets_pilihan();
		$no_urut = $this->pemohon->get_max_urut()->row_array();
		if (!$no_urut['max']) {
			$max_urut = 0;
		} else {
			$max_urut = substr($no_urut['max'], 1);
		}
		$max_urut++;
		$data['alternatif'] = "A".$max_urut;
		$this->load->model('periode_model', 'periode');
		$data['periode'] = $this->periode->gets();

		$this->form_validation->set_rules('kk', 'KK', 'trim|required|numeric|max_length[20]');
		$this->form_validation->set_rules('periode', 'Periode', 'trim|required');
		$this->form_validation->set_rules('nik', 'NIK', 'trim|required|numeric|max_length[20]');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|max_length[64]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[32]');
		$this->form_validation->set_rules('hp', 'Nomor Handhphone', 'trim|required|numeric|max_length[15]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|max_length[128]');
		$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('layout', $data);
		} else {
			$data = [
				'no_urut' => $this->input->post('urut'),
				'kk' => $this->input->post('kk'),
				'nik' => $this->input->post('nik'),
				'nama' => $this->input->post('nama'),
				'email' => $this->input->post('email'),
				'no_hp' => $this->input->post('hp'),
				'alamat' => $this->input->post('alamat'),
				'id_periode' => $this->input->post('periode')
			];

			if($this->pemohon->insert($data, $this->input->post('kriteria'))){
				$msg = '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil di tambahkan!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
			} else {
				$msg = '<div class="alert alert-dangeer alert-dismissible fade show" role="alert">Data gagal di tambahkan!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
			}
			$this->session->set_flashdata('msg', $msg);
			redirect('pemohon');
		}
	}

	public function ubah($id)
	{
		$data['title'] = "Ubah Data Pemohon";
		$data['content'] = "content/pemohon/ubah";
		$data['user'] = $this->user->get_row($this->session->userdata('email'));

		$data['pemohon'] = $this->pemohon->get($id)->row_array();
		$data['kriteriaNilai'] = $this->pemohon->get_kriteria_nilai($id, 'update')->result_array();

		$this->load->model('kriteria_model','kriteria');
		// $data['kriteria'] = $this->kriteria->gets();
		$data['pilihan'] = $this->kriteria->gets_pilihan();

		$this->load->model('periode_model', 'periode');
		$data['periode'] = $this->periode->gets();

		$this->form_validation->set_rules('kk', 'KK', 'trim|required|numeric|max_length[20]');
		$this->form_validation->set_rules('periode', 'Periode', 'trim|required');
		$this->form_validation->set_rules('nik', 'NIK', 'trim|required|numeric|max_length[20]');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|max_length[64]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[32]');
		$this->form_validation->set_rules('hp', 'Nomor Handhphone', 'trim|required|numeric|max_length[15]');
		$this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|max_length[128]');
		$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('layout', $data);
		} else {
			$data = [
				'kk' => $this->input->post('kk'),
				'nik' => $this->input->post('nik'),
				'nama' => $this->input->post('nama'),
				'email' => $this->input->post('email'),
				'no_hp' => $this->input->post('hp'),
				'alamat' => $this->input->post('alamat'),
				'id_periode' => $this->input->post('periode')
			];

			if($this->pemohon->update($data, $this->input->post('nilai'),$id)) {
				$msg = '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil di update!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
				$red = 'pemohon?i='.$id;
			} else {
				$msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">Data gagal di update!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
				$red = 'ubah-pemohon/'.$id;
			}
			$this->session->set_flashdata('msg', $msg);
			redirect($red);
		}
	}

	public function hapus()
	{
		$id = $this->input->get('i');
		if (!$id) {
			show_404();
			return FALSE;
		}

		if ($this->pemohon->delete($id)) {
			$msg = '<div class="alert alert-success alert-dismissible fade show" role="alert">Data berhasil di hapus!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
		} else {
			$msg = '<div class="alert alert-danger alert-dismissible fade show" role="alert">Data gagal di hapus!<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
		}
		$this->session->set_flashdata('msg', $msg);
		redirect('pemohon');
	}

}

/* End of file Pemohon.php */
/* Location: ./application/controllers/Pemohon.php */