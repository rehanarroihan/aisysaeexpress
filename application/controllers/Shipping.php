<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shipping extends CI_Controller {

    public $shippingStatus = array(
        array(
            "id" => 1,
            "title" => 'Order Masuk',
            "badge_title" => 'Order Masuk'
        ),
        array(
            "id" => 2,
            "title" => 'Perjalanan ke Kota Tujuan',
            "badge_title" => 'Perjalanan'
        ),
        array(
            "id" => 3,
            "title" => 'Transit',
            "badge_title" => 'Transit'
        ),
        array(
            "id" => 4,
            "title" => 'Diterima Dengan Baik',
            "badge_title" => 'Diterima'
        ),
        array(
            "id" => 5,
            "title" => 'Cancelled',
            "badge_title" => 'Cancelled'
        )
   );

   public $shippingType = array(
        array(
            "id" => 1,
            "title" => 'One Day Service'
        ),
        array(
            "id" => 2,
            "title" => 'Cargo'
        ),
    );

    public $shippingMode = array(
        array(
            "id" => 1,
            "title" => 'Trucking'
        ),
        array(
            "id" => 2,
            "title" => 'Kereta'
        ),
        array(
            "id" => 3,
            "title" => 'Pesawat'
        ),
        array(
            "id" => 4,
            "title" => 'Kapal Laut'
        )
    );

    public $shippingPaymentType = array(
        array(
            "id" => 1,
            "title" => 'Tagihan'
        ),
        array(
            "id" => 2,
            "title" => 'COD'
        ),
        array(
            "id" => 3,
            "title" => 'Cash'
        ),
    );

	public function __construct(){
        parent::__construct();
        
        $this->load->model('Shipping_model');
    }
    
    public function index() {
        $viewData = array(
			'page_title' => 'Pengiriman',
			'primary_view' => 'shipping/shipping_view',
			'shipping_data_list' => $this->Shipping_model->getShippingDataList(
                $this->session->userdata('branch_id')
            )
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
