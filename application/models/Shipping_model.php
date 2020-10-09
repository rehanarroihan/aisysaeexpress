<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shipping_model extends CI_Model {

    protected $tableName = "shipping";

    public function __construct() {
        $this->load->model('Shipping_history_model');
    }

    public function insert() {
        $price = $this->input->post('price') == "" || $this->input->post('price') == NULL
                    ? "0"
                    : $this->input->post('price');

        $data = array(
			'origin_branch_id'      => $this->input->post('origin_branch_id'),
			'destination_branch_id' => $this->input->post('destination_branch_id'),
			'tracking_no'		    => $this->input->post('tracking_no'),
			'status'		        => $this->input->post('status'),
			'service'		        => $this->input->post('service'),
			'mode'		            => $this->input->post('mode'),
			'price'		            => $price,
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
			'created_at'            => date($this->ms_variable->dbDateTimeFormat),
			'updated_at'            => date($this->ms_variable->dbDateTimeFormat)
        );
        $this->db->insert($this->tableName, $data);

        $insertedShippingId = $this->db->insert_id();

        // Inserting history for resi tracking
        $this->Shipping_history_model->insert($insertedShippingId, 1, '');

        $status = $this->db->affected_rows() > 0;

        return array(
            "status"    => $status,
            "message"   => $status
                            ? 'Berhasil membuat data pengiriman baru'
                            : 'Gagal membuat data pengiriman baru',
            "data"      => $status 
                            ? $this->getShippingById($insertedShippingId) 
                            : $this->db->error()
        );
    }

    public function update() {
        $price = $this->input->post('price') == "" || $this->input->post('price') == NULL
                    ? "0"
                    : $this->input->post('price');

        $id = $this->input->post('id');

        $data = array(
			'origin_branch_id'      => $this->input->post('origin_branch_id'),
			'destination_branch_id' => $this->input->post('destination_branch_id'),
			'tracking_no'		    => $this->input->post('tracking_no'),
			'status'		        => $this->input->post('status'),
			'service'		        => $this->input->post('service'),
			'mode'		            => $this->input->post('mode'),
			'price'		            => $price,
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
			'created_at'            => date($this->ms_variable->dbDateTimeFormat),
			'updated_at'            => date($this->ms_variable->dbDateTimeFormat)
        );

        $this->db->where('id', $id)->update($this->tableName, $data);

        $status = $this->db->affected_rows() > 0;

        return array(
            "status"    => $status,
            "message"   => $status
                            ? 'Berhasil update data pengiriman'
                            : 'Gagal update data pengiriman',
            "data"      => $status 
                            ? $this->getShippingById($id) 
                            : $this->db->error()
        );
    }

    public function delete($shippingId) {
        if ($this->getShippingById($shippingId)->status == 1) {
            $this->db->where('id', $shippingId)->delete($this->tableName);
        }

        return $this->db->affected_rows() > 0;
    }

    public function getShippingById($shipping_id) {
        $shippingDetail = $this->db->select('sh.*, or.name AS origin_branch, or.registration_code AS origin_branch_code, dest.name AS destination_branch, dest.registration_code AS destination_branch_code')
                        ->where('sh.id', $shipping_id)
                        ->join('branch or', 'sh.origin_branch_id = or.id', 'left')
                        ->join('branch dest', 'sh.destination_branch_id = dest.id', 'left')
                        ->get($this->tableName.' AS sh')
                        ->row();

        $shippingHistory = $this->db
                                ->where('shipping_id', $shipping_id)
                                ->get('shipping_history')
                                ->result();

        $shippingDetail->history = $shippingHistory;

        return $shippingDetail;
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
                    ->where('shipping.status >=', 2)
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
                            ->join('branch', 'branch.id = shipping.destination_branch_id')
                            ->where("shipping.id", $id)
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

    public function updateStatusInsertHistory($shippingIds, $status, $remarks) {
        $shippingIdList = explode(",", $shippingIds);
        foreach ($shippingIdList as $shippingId) {
            $this->db->set('status', $status)
                        ->where('id', $shippingId)
                        ->update($this->tableName);

            // Checking is this status already recorded on history
            $history = $this->Shipping_history_model->getHistoryByIdAndStatus($shippingId, $status);
            if (empty($history)) {
                $this->Shipping_history_model->insert($shippingId, $status, $remarks);
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