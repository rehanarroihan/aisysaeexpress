<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shipping_model extends CI_Model {

    protected $tableName = "shipping";

    public function insert() {
        $data = array(
			'branch_id'         => $this->input->post('branch_id'),
			'tracking_no'		=> $this->input->post('tracking_no'),
			'status'		    => $this->input->post('status'),
			'service'		    => $this->input->post('service'),
			'mode'		        => $this->input->post('mode'),
			'price'		        => $this->input->post('price'),
			'payment_type'		=> $this->input->post('payment'),
			'sender_name'		=> $this->input->post('sender_name'),
			'sender_address'	=> $this->input->post('sender_address'),
			'sender_phone'		=> $this->input->post('sender_phone'),
			'receiver_name'		=> $this->input->post('receiver_name'),
			'receiver_address'	=> $this->input->post('receiver_address'),
			'receiver_phone'	=> $this->input->post('receiver_phone'),
			'stuff_content'		=> $this->input->post('stuff_content'),
			'stuff_weight'		=> $this->input->post('stuff_weight'),
			'stuff_colly'		=> $this->input->post('stuff_colly'),
			'stuff_reference_no'=> $this->input->post('stuff_reference_no'),
			'created_at'        => date("Y-m-d h:m:s"),
			'updated_at'        => date("Y-m-d h:m:s")
        );
        $this->db->insert($this->tableName, $data);
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
        return $branchId != null
                ? $this->db->where('branch_id', $branchId)->get($this->tableName)->result()
                : $this->db->get($this->tableName)->result();
    }

    public function getTrackingNoSequence($branchId) {
        $query = $this->db
                    ->where('branch_id', $branchId)
                    ->where('MONTH(shipping.created_at)', Date('m'))
                    ->order_by('id',"DESC")
                    ->get($this->tableName);

        if ($query->num_rows() == 0) {
            return "001";
        }

        $lastTrackingNo = $query->row()->tracking_no;
        $lastTrackingNoSequence = substr(
            $lastTrackingNo, strlen($lastTrackingNo) - 3, strlen($lastTrackingNo)
        );
        $addedOne = (int) $lastTrackingNoSequence + 1;

        return sprintf("%03s", $addedOne);
    }

    public function loadShippingByIds($ids) {
        $result = array();
        $idList = explode(",", $ids);

        // Getting shipping data list
        foreach ($idList as $id) {
            $query = $this->db
                        ->where("id", $id)
                        ->get($this->tableName)
                        ->result();
            
            if (isset($query[0])) {
                $result[] = $query[0];
            }
        }

        // Counting total
        $totalWeight = 0;
        $totalColly = 0;
        $totalCashCount = 0;
        $totalCodCount = 0;
        $totalDeliveryCount = 0;
        foreach ($result as $data) {
            if ($data->stuff_weight != "") {
                $totalWeight += (int) $data->stuff_weight;
            }

            if ($data->stuff_colly != "") {
                $totalColly += (int) $data->stuff_colly;
            }

            if ($data->payment_type == 1) {
                $totalCashCount += 1;
            }

            if ($data->payment_type == 2) {
                $totalCodCount += 1;
            }

            if ($data->payment_type == 3) {
                $totalDeliveryCount += 1;
            }
        }

        return array (
            "shippingList"       => $result, 
            "totalWeight"        => $totalWeight,
            "totalColly"         => $totalColly,
            "totalCashCount"     => $totalCashCount,
            "totalCodCount"      => $totalCodCount,
            "totalDeliveryCount" => $totalDeliveryCount
        );
    }
}