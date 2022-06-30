<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kriteria extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('user_model', 'user');
		$this->load->model('kriteria_model', 'kriteria');
	}

	public function index()
	{
		$data['title'] = "Kriteria";
		$data['content'] = "content/kriteria";
		$data['user'] = $this->user->get_row($this->session->userdata('email'));

		$data['kriteria'] = $this->kriteria->gets();
		$data['pilihan'] = $this->kriteria->gets_pilihan();

		$this->load->view('layout', $data);
	}

	public function tambah()
	{
		$data['title'] = "Tambah Kriteria";
		$data['content'] = "content/kriteria_tambah";
		$data['user'] = $this->user->get_row($this->session->userdata('email'));

		$this->form_validation->set_rules('kode', 'Kode', 'trim|required|min_length[2]|max_length[3]|is_unique[kriteria.kode]', [
			'is_unique'=>'Kode sudah ada!'
		]);
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('tipe', 'Tipe', 'trim|required|in_list[cost,benefit]');
		$this->form_validation->set_rules('bobot', 'Bobot', 'trim|required|numeric|greater_than[0]');
		$this->form_validation->set_rules('jenis', 'Jenis Inputan', 'trim|required|in_list[langsung,pilihan]');
		$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('layout', $data);
		} else {
			$data = [
				'kode' => $this->input->post('kode'),
				'nama' => $this->input->post('nama'),
				'tipe' => $this->input->post('tipe'),
				'bobot' => $this->input->post('bobot'),
				'jenis_input' => $this->input->post('jenis')
			];
			$variabel = $this->input->post('variabel');
			$nilai = $this->input->post('nilai');

			$this->kriteria->insert($data, $variabel, $nilai);
			redirect('kriteria');
		}
	}

	public function ubah()
	{
		$data['title'] = "Ubah Kriteria";
		$data['content'] = "content/kriteria_ubah";
		$data['user'] = $this->user->get_row($this->session->userdata('email'));

		$data['kriteria'] = $this->kriteria->get($this->input->get('kode'));
		$data['pilihan'] = $this->kriteria->get_pilihan($data['kriteria']['id']);
		$data['jenis'] = $data['kriteria']['jenis_input'] == "pilihan" ? "collapsed" : "collapse";

		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('tipe', 'Tipe', 'trim|required|in_list[cost,benefit]');
		$this->form_validation->set_rules('bobot', 'Bobot', 'trim|required|numeric|greater_than[0]');
		$this->form_validation->set_rules('jenis', 'Jenis Inputan', 'trim|required|in_list[langsung,pilihan]');
		$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');

		if ($this->form_validation->run() ==FALSE) {
			$this->load->view('layout', $data);
		} else {

			$id_kriteria = $this->input->post('id');
			$data = [
				'nama' => $this->input->post('nama'),
				'tipe' => $this->input->post('tipe'),
				'bobot' => $this->input->post('bobot'),
				'jenis_input' => $this->input->post('jenis')
			];

			$id_pil = $this->input->post('id_pil');
			$variabel = $this->input->post('variabel');
			$nilai = $this->input->post('nilai');

			$this->kriteria->update($id_kriteria, $data, $id_pil, $variabel, $nilai);
			redirect('kriteria');
		}
	}

	public function hapus()
	{
		$id = $this->input->get('i');

		$this->kriteria->delete($id);
		redirect('kriteria');
	}
}

/* End of file Kriteria.php */
/* Location: ./application/controllers/Kriteria.php */