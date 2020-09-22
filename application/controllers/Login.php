<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct(){
        parent::__construct();
        
        $this->load->model('User_model');
        
        if($this->session->userdata('logged_in')){
			redirect('branch');
		}
	}

	public function index() {
		$this->load->view('login_view');
    }
    
    public function submit() {
        if (empty($this->input->post('username'))) {
            redirect('login');
            return;
        }

        if ($this->User_model->login()) {
            redirect('dashboard/branch');
            return;
        }

        $this->session->set_flashdata('announce', 'Username atau password salah');
        redirect('login');
    }
}
