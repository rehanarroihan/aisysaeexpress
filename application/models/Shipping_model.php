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
        return $this->getShippingById($this->db->insert_id());
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
}