<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shipping extends CI_Controller {

	public function __construct(){
        parent::__construct();
        
        $this->load->model('Shipping_model');
	}
    
    public function index() {
        $viewData = array(
			'page_title' => 'Pengiriman',
			'primary_view' => 'shipping/shipping_view'
		);
		$this->load->view('template_view', $viewData);
    }

    public function submit() {
        $result = $this->Shipping_model->insert();
        echo json_encode(array(
			'status' => true,
			'message' => 'Berhasil menyimpan data pengiriman baru',
			'data' => $result
        ));
    }
}
