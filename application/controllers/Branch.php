<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Branch extends CI_Controller {

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
			'page_title' => 'Cabang',
			'primary_view' => 'branch/branch_list_view',
			'branchList' => $this->Branch_model->getAdminBranchList()
		);
		$this->load->view('template_view', $viewData);
	}

	public function submit() {
		$usernameAvail = $this->User_model->checkUsernameAvailability(
			$this->input->post('username')
		);
		if ($usernameAvail > 0) {
			echo json_encode(array(
				'status' => false,
				'message' => 'Username tidak tersedia'
			));
			return;
		}

		$insertedBranchId = $this->Branch_model->create();
		$insertedBranchAdminData = $this->User_model->insert($insertedBranchId);
		echo json_encode(array(
			'status' => true,
			'message' => 'Berhasil menyimpan data cabang baru',
			'data' => $insertedBranchAdminData
		));
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('login');
	}
}
