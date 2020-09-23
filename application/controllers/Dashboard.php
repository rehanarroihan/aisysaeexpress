<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

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
			'page_title' => 'Dashboard',
			'primary_view' => 'dashboard/dashboard_view'
		);
		$this->load->view('template_view', $viewData);
    }

    public function vehicle() {
        $viewData = array(
			'page_title' => 'Kendaraan',
			'primary_view' => 'vehicle/vehicle_view'
		);
		$this->load->view('template_view', $viewData);
    }

    public function report() {
        $viewData = array(
			'page_title' => 'Laporan',
			'primary_view' => 'report/report_view'
		);
		$this->load->view('template_view', $viewData);
	}
	
	public function shipping() {
        $viewData = array(
			'page_title' => 'Pengiriman',
			'primary_view' => 'shipping/shipping_view'
		);
		$this->load->view('template_view', $viewData);
    }
}
