<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shipping_model extends CI_Model {

    protected $tableName = "shipping";

    public function __construct() {
        $this->load->model('Shipping_history_model');
    }

    public function insert() {
        $data = array(
			'origin_branch_id'      => $this->input->post('origin_branch_id'),
			'destination_branch_id' => $this->input->post('destination_branch_id'),
			'tracking_no'		    => $this->input->post('tracking_no'),
			'status'		        => $this->input->post('status'),
			'service'		        => $this->input->post('service'),
			'mode'		            => $this->input->post('mode'),
			'price'		            => $this->input->post('price'),
			'payment_type'		    => $this->input->post('payment'),
			'sender_name'		    => $this->input->post('sender_name'),
			'sender_address'	    => $this->input->post('sender_address'),
			'sender_phone'		    => $this->input->post('sender_phone'),
			'receiver_name'		    => $this->input->post('receiver_name'),
			'receiver_address'	    => $this->input->post('receiver_address'),
			'receiver_phone'	    => $this->input->post('receiver_phone'),
			'stuff_content'		    => $this->input->post('stuff_content'),
			'stuff_weight'		    => $this->input->post('stuff_weight'),
			'stuff_colly'		    => $this->input->post('stuff_colly'),
			'stuff_reference_no'    => $this->input->post('stuff_reference_no'),
			'created_at'            => date("Y-m-d H:m:s"),
			'updated_at'            => date("Y-m-d H:m:s")
        );
        $this->db->insert($this->tableName, $data);

        // Inserting history for resi tracking
        $this->Shipping_history_model->insert($this->db->insert_id(), 1);

        $status = $this->db->affected_rows() > 0;

        return array(
            "status"    => $status,
            "message"   => $status
                            ? 'Berhasil membuat data pengiriman baru'
                            : 'Gagal membuat data pengiriman baru',
            "data"      => $status 
                            ? $this->getShippingById($this->db->insert_id()) 
                            : $this->db->error()
        );
    }

    public function getShippingById($shipping_id) {
        return $this->db->where('id', $shipping_id)
                        ->get($this->tableName)
                        ->row();
    }

    public function getShippingDataList($branchId) {
        if ($branchId == null) {
            $query = $this->db
                        ->select('shipping.id, tracking_no, branch.name AS dest_branch_name, branch.registration_code AS dest_branch_code, sender_name, shipping.created_at, status')
                        ->join('branch', 'destination_branch_id = branch.id')
                        ->get($this->tableName)
                        ->result();
        } else {
            $query = $this->db
                        ->select('shipping.id, tracking_no, branch.name AS dest_branch_name, branch.registration_code AS dest_branch_code, sender_name, shipping.created_at, status')
                        ->join('branch', 'destination_branch_id = branch.id')
                        ->where('shipping.origin_branch_id', $branchId)
                        ->get($this->tableName)
                        ->result();
        }

        return $query;
    }

    public function getIncomingShippingDataList($branchId) {
        return $this->db
                    ->select('shipping.id, tracking_no, branch.name AS origin_branch_name, branch.registration_code AS origin_branch_code, receiver_name, shipping.created_at, status')
                    ->join('branch', 'origin_branch_id = branch.id')
                    ->where('shipping.destination_branch_id', $branchId)
                    ->get($this->tableName)
                    ->result();
    }

    public function getTrackingNoSequence($branchId) {
        $query = $this->db
                    ->where('origin_branch_id', $branchId)
                    ->where('MONTH(shipping.created_at)', Date('m'))
                    ->order_by('id',"DESC")
                    ->get($this->tableName);

        if ($query->num_rows() == 0) {
            return "0001";
        }

        $lastTrackingNo = $query->row()->tracking_no;
        $lastTrackingNoSequence = substr(
            $lastTrackingNo, strlen($lastTrackingNo) - 3, strlen($lastTrackingNo)
        );
        $addedOne = (int) $lastTrackingNoSequence + 1;

        return sprintf("%04s", $addedOne);
    }

    public function getShippingListWithCount($ids=NULL, $startDate=NULL, $endDate=NULL) {
        $result = array();

        // Getting shipping data list by ids
        if ($ids != null) {
            $idList = $ids != null ? explode(",", $ids) : array();
            foreach ($idList as $id) {
                $query = $this->db
                            ->where("id", $id)
                            ->get($this->tableName)
                            ->result();
                
                if (isset($query[0])) {
                    $result[] = $query[0];
                }
            }
        }

        // Getting shipping data by date range
        if ($startDate != null && $endDate != null) {
            $result = $this->db
                        ->join('branch', 'destination_branch_id = branch.id')
                        ->where('shipping.created_at >=', $startDate)
                        ->where('shipping.created_at <=', $endDate)
                        ->where('shipping.origin_branch_id', $this->session->userdata('branch_id'))
                        ->get($this->tableName)
                        ->result();
        }

        // Counting total
        $totalWeight = 0;
        $totalColly = 0;
        $totalCashCount = 0;
        $totalCodCount = 0;
        $totalInvoiceCount = 0;
        foreach ($result as $data) {
            if ($data->stuff_weight != "") {
                $totalWeight += (int) $data->stuff_weight;
            }

            if ($data->stuff_colly != "") {
                $totalColly += (int) $data->stuff_colly;
            }

            if ($data->payment_type == 1) {
                $totalInvoiceCount += (int) $data->price;
            }

            if ($data->payment_type == 2) {
                $totalCodCount += (int) $data->price;
            }

            if ($data->payment_type == 3) {
                $totalCashCount += (int) $data->price;
            }
        }

        $res = array(
            "shippingList"       => $result, 
            "totalWeight"        => $totalWeight,
            "totalColly"         => $totalColly,
            "totalCashCount"     => $totalCashCount,
            "totalCodCount"      => $totalCodCount,
            "totalInvoiceCount"  => $totalInvoiceCount
        );

        return $res;
    }

    public function updateStatusInsertHistory($shippingIds) {
        $shippingIdList = explode(",", $shippingIds);
        foreach ($shippingIdList as $shippingId) {
            $shippingDetail = $this->getShippingById($shippingId);
            if ($shippingDetail->status == 1) {
                $this->db->set('status', 2)
                        ->where('id', $shippingId)
                        ->update($this->tableName);

                $this->Shipping_history_model->insert($shippingId, 2);
            }
        }
        return $this->db->affected_rows() > 0;
    }

    public function batchUpdateManifestId($shippingIds, $manifestId) {
        $shippingIdList = explode(",", $shippingIds);
        foreach ($shippingIdList as $shippingId) {
            $this->db
                ->set('manifest_id', $manifestId)
                ->where('id', $shippingId)
                ->update($this->tableName);
        }
    }
}