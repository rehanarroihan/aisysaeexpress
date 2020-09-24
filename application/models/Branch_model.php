<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Branch_model extends CI_Model {

    protected $tableName = "branch";

    public function create() {
        $data = array(
			'name'              => $this->input->post('branch_name'),
			'address'           => $this->input->post('branch_address'),
			'registration_code' => $this->input->post('registration_code'),
			'created_at'        => date("Y-m-d h:m:s"),
			'updated_at'        => date("Y-m-d h:m:s")
        );
        $this->db->insert($this->tableName, $data);
        // NOTE : returning last inserted id
        return $this->db->insert_id();
    }

    public function checkRegistrationCodeAvailability($regCode) {
        return $this->db
                    ->where('registration_code', $regCode)
                    ->get($this->tableName)
                    ->num_rows();
    }

    public function getAdminBranchList() {
		return $this->db
                    ->join('users','users.branch_id = branch.id', 'right')
                    ->where('role !=', 1)
                    ->get($this->tableName)
                    ->result();
    }

    public function getBranchRegCode($branch_id) {
        return $this->db->where('id', $branch_id)
                        ->get($this->tableName)
                        ->row()
                        ->registration_code;
    }
}