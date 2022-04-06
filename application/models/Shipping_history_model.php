<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shipping_history_model extends CI_Model {

    protected $tableName = "shipping_history";

    public function insert($shippingId, $statusId, $remarks) {
        $data = array(
            'shipping_id'   => $shippingId,
            'status_id'     => $statusId,
            'remarks'       => $remarks,
            'created_at'	=> date($this->ms_variable->dbDateTimeFormat),
        );

        $this->db->insert($this->tableName, $data);
        return $this->db->affected_rows() > 0;
    }

    public function getHistoryByIdAndStatus($shippingId, $statusId) {
        return $this->db
                    ->where('id', $shippingId)
                    ->where('status_id', $statusId)
                    ->get($this->tableName)
                    ->row();
    }
}