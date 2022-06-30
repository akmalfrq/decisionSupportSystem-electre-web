<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('user_model', 'user');
	}

	public function index()
	{
		$data['title'] = "Pilih Periode";
		$data['content'] = "content/report/index";
		$data['user'] = $this->user->get_row($this->session->userdata('email'));

		$this->load->model('periode_model', 'periode');
		$data['periode'] = $this->periode->gets();

		$this->form_validation->set_rules('periode', 'Periode', 'trim|required');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('layout', $data);
		} else {
			redirect('report/electre?p='.$this->input->post('periode'));
		}
	}

	public function electre()
	{
		$data = report_electre();
		$data['title'] = "Data Hasil Perhitungan Electre";
		$data['user'] = $this->user->get_row($this->session->userdata('email'));
		$data['periode'] = $this->input->get('p');
		if ($this->input->get('report')) {
			$this->load->view('content/report/print', $data, FALSE);
		} else {
			$data['content'] = "content/report/electre";
			$this->load->view('layout', $data, FALSE);
		}

	}
}

/* End of file Report.php */
/* Location: ./application/controllers/Report.php */