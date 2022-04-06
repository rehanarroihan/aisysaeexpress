<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Shipping_model');
	}

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

	public function trackingCheck() {
		$trackingNo = $this->input->post('tracking_no');
		if (!$this->Shipping_model->isShippingByTrackingNoAvailable($trackingNo)) {
			echo json_encode(array(
				"status"	=> false,
				"message"	=> "No resi tidak tersedia"
			));
			return;
		}

		$result = $this->Shipping_model->getShippingByTrackingNo($trackingNo);
		echo json_encode(array(
			"status"	=> true,
			"message"	=> "Berhasil mendapatkan data tracking resi",
			"data"		=> $result
		));
	}
}
