<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function index()
	{
		if ($this->session->userdata('email')) {
	      redirect();
    	}

		$this->form_validation->set_rules('email', 'Email', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
		
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('auth/login');
		} else {
			$this->_login();
		}
	}

	private function _login()
	{
		$email = $this->input->post('email');
    	$password = $this->input->post('password');

    	$this->load->model('user_model', 'user');
	    $user = $this->user->get_row($email);

    	// jika usernya ada
    	if ($user) {
      		// jika usernya aktif
      		if ($user['is_active'] == 1) {
        		// cek password
        		if (password_verify($password, $user['password'])) {
          			$data = [
            			'email' => $user['email'],
            			'role_id' => $user['role_id']
          			];
		          	$this->session->set_userdata($data);
		          	redirect();
		        } else {
          			$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
		      				Username atau password salah!
		      				 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
							    <span aria-hidden="true">&times;</span>
							  </button>
		      			</div>');
          			redirect('login');
        		}
      		} else {
        		$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
	      			User belum diaktifkan!
      				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
      					<span aria-hidden="true">&times;</span>
      				</button>
      			</div>');
        		redirect('login');
	    	}
	  	} else {
      		$this->session->set_flashdata('msg', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
      			User belum terdaftar!
      			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
      				<span aria-hidden="true">&times;</span>
      			</button>
      		</div>');
	      	redirect('login');
    	}
	}

	public function logout()
	{
		$this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out!</div>');
        redirect('login');
	}
}

/* End of file Auth.php */
/* Location: ./application/controllers/Auth.php */