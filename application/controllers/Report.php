<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

    public function __construct() {
		parent::__construct();
		$this->load->model('Manifest_model');
		$this->load->model('Shipping_model');

		if (!$this->session->userdata('logged_in')) {
			redirect('login');
		}
    }

    public function manifest() {
        $viewData = array(
			'page_title'	=> 'Manifest Tercetak',
			'primary_view'	=> 'report/manifest_view',
			'manifest_data'	=> $this->Manifest_model->get()
		);

		$this->load->view('template_view', $viewData);
    }

	public function vehicle() {
        $viewData = array(
			'page_title'	=> 'Aktifitas Armada',
			'primary_view'	=> 'report/vehicle_view',
			'manifest_data'	=> $this->Manifest_model->get(),
			'armada_list' => $this->ms_variable->vehicleList(),
		);

		$this->load->view('template_view', $viewData);
    }

	public function vehicleDetail() {
        $viewData = array(
			'page_title'	=> 'Detail Armada',
			'primary_view'	=> 'report/vehicle_detail_view',
			'armada_detail' => $this->ms_variable->vehicleList()[$this->searchForId($this->uri->segment(4), $this->ms_variable->vehicleList())],
		);

		$this->load->view('template_view', $viewData);
    }

	function searchForId($id, $array) {
		foreach ($array as $key => $val) {
			if ($val->id == $id) {
				return $key;
			}
		}

		return null;
	 }
    
    public function cashStatement() {
        $viewData = array(
			'page_title' => 'Laporan',
			'primary_view' => 'report/report_view'
		);
		$this->load->view('template_view', $viewData);
    }
    
    public function salesTrx() {
		$startDate = $this->input->get('startDate') != null
						? $this->input->get('startDate')
						: date_create(Date('Y-m-d'))->modify('-29 days')->format('Y-m-d');
		$endDate = $this->input->get('endDate') != null
						? $this->input->get('endDate')
						: Date('Y-m-d');
		
        $viewData = array(
			'page_title'	=> 'Transaksi Penjualan',
			'primary_view'	=> 'report/sales_trx_view',
			'trxList'		=> $this->Shipping_model->getShippingListWithCount(null, $startDate, $endDate)
		);
		
		$this->load->view('template_view', $viewData);
	}
}