<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		is_logged_in();
		$this->load->model('user_model', 'user');
	}

	public function index()
	{
		$data['title'] = "Dashboard";
		$data['content'] = "content/dashboard";
		$data['user'] = $this->user->get_row($this->session->userdata('email'));

		$this->load->view('layout', $data);
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */