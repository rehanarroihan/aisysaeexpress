<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Shipping_history_model extends CI_Model {

    protected $tableName = "shipping_history";

    public function insert($shippingId, $statusId) {
        $data = array(
            'shipping_id'   => $shippingId,
            'status_id'     => $statusId,
            'created_at'	=> date("Y-m-d h:m:s"),
        );

        $this->db->insert($this->tableName, $data);
        return $this->db->affected_rows() > 0;
    }
}