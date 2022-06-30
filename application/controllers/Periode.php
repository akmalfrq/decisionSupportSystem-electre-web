<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Periode extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('user_model', 'user');
		$this->load->model('periode_model', 'periode');
	}

	public function index()
	{
		$data['title'] = "Periode";
		$data['content'] = "content/periode";
		$data['user'] = $this->user->get_row($this->session->userdata('email'));

		$data['periode'] = $this->periode->gets();

		$this->form_validation->set_rules('periode', 'Periode', 'trim|required|exact_length[4]|numeric');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('layout', $data);
		} else {
			if($this->periode->insert(array('periode'=>$this->input->post('periode')))) {
				$this->session->set_flashdata('msg', '');
			} else {
				$this->session->set_flashdata('msg', '');
			}
			redirect('periode');
		}
	}

}

/* End of file Periode.php */
/* Location: ./application/controllers/Periode.php */