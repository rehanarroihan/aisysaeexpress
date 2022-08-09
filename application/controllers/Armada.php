<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Armada extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Branch_model');
		$this->load->model('User_model');

		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
	}

	public function index() {
		$viewData = array(
			'page_title' => 'Armada',
			'primary_view' => 'armada/armada_list_view',
			'armada_list' => $this->ms_variable->vehicleList(),
		);
		$this->load->view('template_view', $viewData);
	}
}
