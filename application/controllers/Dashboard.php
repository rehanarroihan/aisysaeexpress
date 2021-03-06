<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Branch_model');
		$this->load->model('User_model');
		$this->load->model('Dashboard_model');

		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
    }
    
    public function index() {
        $viewData = array(
			'page_title' 	=> 'Dashboard',
			'primary_view' 	=> $this->session->userdata('role') == 1
									? 'dashboard/manager_dashboard_view'
									: 'dashboard/dashboard_view',
			'daily_data'	=> $this->Dashboard_model->getDailyData(Date('Y-m-d')),
			'monthly_data'	=> $this->Dashboard_model->getMonthlyData(Date('n')),
			'unfinished'	=> $this->Dashboard_model->getUnfinishedTasks(),
			'branchList' => $this->Branch_model->get()
		);
		$this->load->view('template_view', $viewData);
	}

	public function monthly() {
		echo json_encode(array(
			'status' => true,
			'message' => 'Berhasil mendapatkan data dashboard bulanan',
			'data' => $this->Dashboard_model->getMonthlyData($this->input->get('month'))
        ));
	}

    public function vehicle() {
        $viewData = array(
			'page_title' => 'Kendaraan',
			'primary_view' => 'vehicle/vehicle_view'
		);
		$this->load->view('template_view', $viewData);
    }
}
