<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('user_model', 'user');
		$this->load->model('pegawai_model', 'pegawai');
	}

	public function index()
	{
		$data['title'] = "Data Pegawai";
		$data['content'] = "content/pegawai/index";
		$data['user'] = $this->user->get_row($this->session->userdata('email'));

		$data['pegawai'] = $this->pegawai->gets();

		$this->form_validation->set_rules('nip', 'NIP', 'trim|required|is_natural');
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|max_length[128]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|max_length[64]|valid_email|is_unique[user.email]');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('layout', $data);
		} else {
			$data = [
				'no_id' => $this->input->post('nip'),
				'nama' => $this->input->post('nama'),
				'email' => $this->input->post('email'),
				'foto' => 'default.jpg',
				'password' => password_hash('Pegawai', PASSWORD_DEFAULT),
				'role_id' => 2,
				'is_active' => 1,
				'created' => time()
			];
			$this->pegawai->insert($data);
			redirect('pegawai');
		}
	}

	public function ubah()
	{
		$nip = $this->input->get('nip');
		if (!$nip) {
			show_404();
		}

		$data['title'] = "Edit Pegawai";
		$data['content'] = "content/pegawai/pegawai_ubah";
		$data['user'] = $this->user->get_row($this->session->userdata('email'));

		$data['pegawai'] = $this->pegawai->get($nip);

		$this->form_validation->set_rules('nama', 'Nama', 'trim|required|max_length[128]');
		$this->form_validation->set_error_delimiters('<small class="text-danger">', '</small>');

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('layout', $data);
		} else {
			if($this->pegawai->update($this->input->post('id'), $this->input->post('nama'))){
				redirect('pegawai');
			} else {
				redirect('ubah-pegawai?nip='.$nip);
			}
		}
	}

	public function ubah_status()
	{
		$id = $this->input->get('i');
		if (!$id) {
			show_404();
		}

		$this->pegawai->update_status($id, $this->input->get('s'));
		redirect('pegawai');
	}

}

/* End of file Pegawai.php */
/* Location: ./application/controllers/Pegawai.php */