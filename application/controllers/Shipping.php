<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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

        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        
        $this->load->model('Shipping_model');
        $this->load->model('Branch_model');
    }
    
    public function index() {
        $viewData = array(
			'page_title'            => 'Pengiriman',
            'primary_view'          => 'shipping/shipping_view',
            'dest_branch_list'      => $this->Branch_model->getDestBranchList(),
			'shipping_data_list'    => $this->Shipping_model->getShippingDataList($this->session->userdata('branch_id'))
		);
		$this->load->view('template_view', $viewData);
    }

    public function incoming() {
        $viewData = array(
			'page_title'                => 'Daftar Tugas',
            'primary_view'              => 'shipping/incoming_shipping_view',
            'dest_branch_list'          => $this->Branch_model->getDestBranchList(),
			'incoming_shipping_list'    => $this->Shipping_model->getIncomingShippingDataList($this->session->userdata('branch_id'))
		);
		$this->load->view('template_view', $viewData);
    }

    public function submit() {
        $result = $this->Shipping_model->insert();
        echo json_encode(array(
			'status' => $result['status'],
			'message' => $result['message'],
			'data' => $result['data']
        ));
    }

    public function generateResi() {
        $branchId = $this->input->post('branch_id');
        if ($branchId == null) {
            echo json_encode(array(
                'status' => false,
                'message' => 'Invalid parameter'
            ));
            return;
        }

        $branchRegCode = $this->Branch_model->getBranchRegCode($branchId);
        $sequence = $this->Shipping_model->getTrackingNoSequence($branchId);

        $trackingNo = $branchRegCode.'-'.Date('ym').''.$sequence;

        echo json_encode(array(
			'status' => true,
			'message' => 'Berhasil generate nomor resi',
			'data' => $trackingNo
        ));
    }

    public function manifest() {
        $viewData = array(
            "shippingList" => $this->Shipping_model->loadShippingByIds(
                $this->input->post('ids')
            )
        );

        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->filename = "laporan-petanikode.pdf";
        $this->pdf->load_view('shipping/manifest_table_view', $viewData);
    }

    public function prePrintManifest() {
        $actionStatus = $this->Shipping_model->updateStatusInsertHistory($this->input->post('ids'));

        echo json_encode(array(
			'status' => $actionStatus,
			'message' => $actionStatus ? 'Action successful' : 'Action failed'
        ));
    }

    public function printWayBill($shippingId) {
        $viewData = array(
            "data"  => $this->Shipping_model->getShippingById($shippingId)
        );
        $this->load->view('shipping/shipping_waybill_view', $viewData);
    }
}
