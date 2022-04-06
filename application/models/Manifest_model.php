<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manifest_model extends CI_Model {

    protected $tableName = "manifest";

    public function insert($branch_id, $file_name) {
        $data = array(
			'origin_branch_id'      => $branch_id,
			'file_name'             => $file_name,
			'driver'                => $this->input->post('driver'),
			'license_plate_number'  => $this->input->post('nopol'),
			'created_at'            => date($this->ms_variable->dbDateTimeFormat),
			'updated_at'            => date($this->ms_variable->dbDateTimeFormat)
        );
        
        $this->db->insert($this->tableName, $data);

        return $this->db->insert_id();
    }

    public function get() {
        $branchId = $this->session->userdata('branch_id');
        return $this->db->query("SELECT 
            mn.file_name, 
            mn.driver,
            mn.license_plate_number,
            sh.manifest_id, 
            mn.created_at,
            GROUP_CONCAT(DISTINCT br.name SEPARATOR', ') AS 'destination_list',
            GROUP_CONCAT(DISTINCT sh.tracking_no ORDER BY sh.tracking_no SEPARATOR', ') AS 'tracking_no_list'
        FROM shipping sh 
        JOIN manifest mn ON mn.id = sh.manifest_id
        JOIN branch br ON sh.destination_branch_id = br.id
        WHERE sh.manifest_id IS NOT null GROUP BY sh.manifest_id,
        sh.origin_branch_id = ".$branchId."")->result();
    }
}