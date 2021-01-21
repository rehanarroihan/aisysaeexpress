<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Branch_model extends CI_Model {

    protected $tableName = "branch";

    public function create() {
        $data = array(
			'name'              => $this->input->post('branch_name'),
			'address'           => $this->input->post('branch_address'),
			'registration_code' => $this->input->post('registration_code'),
			'created_at'        => date($this->ms_variable->dbDateTimeFormat),
			'updated_at'        => date($this->ms_variable->dbDateTimeFormat)
        );
        $this->db->insert($this->tableName, $data);
        // NOTE : returning last inserted id
        return $this->db->insert_id();
    }

    public function get() {
        return $this->db->get($this->tableName)->result();
    }

    public function getBranchDetailById($branchId) {
        return $this->db
                    ->where('id', $branchId)
                    ->get($this->tableName)
                    ->row();
    }

    public function getDestBranchList() {
        $branchList = $this->db->get($this->tableName)->result();
        
        $loggedInBranchId = $this->session->userdata('branch_id');
        
        if (isset($loggedInBranchId)) {
            for ($i=0; $i < count($branchList); $i++) {
                if ($branchList[$i]->id == $loggedInBranchId) {
                    unset($branchList[$i]);
                }
            }
        }
        
        return $branchList;
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