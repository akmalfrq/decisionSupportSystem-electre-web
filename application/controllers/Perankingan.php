<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perankingan extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('user_model', 'user');
		// $this->load->model('metode_model', 'metode');
	}

	public function index()
	{
		$data['title'] = "Perankingan";
		$data['content'] = "content/metode/index";
		$data['user'] = $this->user->get_row($this->session->userdata('email'));

		$this->load->model('periode_model', 'periode');
		$data['periode'] = $this->periode->gets();

		$this->form_validation->set_rules('periode', 'Periode', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('layout', $data);
		} else {
			redirect('metode/electre?p='.$this->input->post('periode'));
		}
	}

	public function electre()
	{
		$data = hitung_electre();
		$data['title'] = "Perhitungan Menggunakan Metode Electre";
		$data['content'] = "content/metode/electre";
		$data['user'] = $this->user->get_row($this->session->userdata('email'));

		$this->load->view('layout', $data);
	}
}

/* End of file Metode.php */
/* Location: ./application/controllers/Metode.php */