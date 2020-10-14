<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Shipping extends CI_Controller {

	public function __construct(){
        parent::__construct();

        if (!$this->session->userdata('logged_in')) {
            redirect('login');
        }
        
        $this->load->model('Shipping_model');
        $this->load->model('Branch_model');
        $this->load->model('Manifest_model');
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

    public function admin() {
        // TODO: showing all shipping for admin
        if ($this->session->userdata('role') != 1) {
            return $this->load->view('404_view');
        }

        $viewData = array(
			'page_title'            => 'Semua Pengiriman',
            'primary_view'          => 'shipping/admin_shipping_view',
            'dest_branch_list'      => $this->Branch_model->getDestBranchList(),
			'shipping_data_list'    => $this->Shipping_model->getShippingDataList($this->session->userdata('branch_id'))
		);
		$this->load->view('template_view', $viewData);
    }

    public function incoming() {
        $viewData = array(
			'page_title'                => 'Daftar Tugas',
            'primary_view'              => 'shipping/incoming_shipping_view',
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

    public function update() {
        $result = $this->Shipping_model->update();
        echo json_encode(array(
			'status' => $result['status'],
			'message' => $result['message'],
			'data' => $result['data']
        ));
    }

    public function delete() {
        if ($this->input->post('shipping_id')) {
            $res = $this->Shipping_model->delete($this->input->post('shipping_id'));
            echo json_encode(array(
                'status' => $res
            ));
        }
    }

    public function detail($shippingId) {
        $detail = $this->Shipping_model->getShippingById($shippingId);
        
        echo json_encode(array(
			'status'    => true,
			'message'   => 'Berhasil mendapatkan detail',
			'data'      => $detail
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
            "shippingList" => $this->Shipping_model->getShippingListWithCount(
                $this->input->post('ids')
            )
        );

        // TODO : generating PDF, save to server and record in manifest table
        $fileName = "manifest".time().".pdf";
        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->filename = $fileName;
        $this->pdf->load_view('shipping/manifest_table_view', $viewData);
        
        file_put_contents("assets/generated-manifest/".$fileName, $this->pdf->output());

        $insertedManifestId = $this->Manifest_model->insert($this->session->userdata('branch_id'), $fileName);
        $this->Shipping_model->batchUpdateManifestId($this->input->post('ids'), $insertedManifestId);

        echo base_url()."assets/generated-manifest/".$fileName;
    }

    public function updateStatus() {
        // TODO : updating shipping status and insert history
        $actionStatus = $this->Shipping_model->updateStatusInsertHistory(
            $this->input->post('ids'),
            $this->input->post('status'),
            $this->input->post('remarks')
        );

        echo json_encode(array(
			'status' => $actionStatus,
			'message' => $actionStatus ? 'Action successful' : 'Action failed'
        ));
    }

    public function printWayBill($shippingId) {
        $viewData = array(
            "data"  => $this->Shipping_model->getShippingById($shippingId)
        );

        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->filename = "d".time().".pdf";
        $this->load->view('shipping/shipping_waybill_view', $viewData);
    }
}
