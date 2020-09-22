<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Branch_model extends CI_Model {

    public function create() {
        $data = array(
			'name'      	=> $this->input->post('branch_name'),
			'address'		=> $this->input->post('branch_address'),
			'created_at'	=> date("Y-m-d h:m:s"),
			'updated_at'	=> date("Y-m-d h:m:s")
        );
        $this->db->insert('branch', $data);
        // NOTE : returning last inserted id
        return $this->db->insert_id();
    }

    public function getAdminBranchList() {
		return $this->db
                    ->join('users','users.branch_id = branch.id', 'right')
                    ->where('role !=', 1)
                    ->get('branch')
                    ->result();
    }
}