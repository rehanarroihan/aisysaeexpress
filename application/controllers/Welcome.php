<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index() {
		if (!$this->session->userdata('logged_in')) {
			redirect('/login');
		} else {
			redirect('/dashboard');
		}
	}

	public function logout() {
		$this->session->sess_destroy();
		redirect('login');
	}

	public function notfound() {
		$this->load->view('404_view');
	}

	public function tracking() {
		$this->load->view('tracking_view');
	}
}
