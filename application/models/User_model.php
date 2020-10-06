<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    protected $tableName = "users";

    public function __construct() {
        $this->load->model('Branch_model');
    }

    public function insert($branchId) {
        $data = array(
			'branch_id'     => $branchId,
			'username'		=> $this->input->post('username'),
			'full_name'	    => $this->input->post('full_name'),
			'password'	    => md5($this->input->post('password')),
			'role'	        => 2,
			'created_at'	=> date("Y-m-d H:m:s"),
			'updated_at'	=> date("Y-m-d H:m:s")
        );
        $this->db->insert('users', $data);
        // NOTE : returning last inserted data row
        return $this->db
                ->select('users.id AS user_id, branch.id AS branch_id, branch.registration_code, branch.name, branch.address, users.full_name, users.username')
                ->join('branch','branch.id = users.branch_id')
                ->where('users.id', $this->db->insert_id())
                ->get($this->tableName)
                ->row();
    }

    public function checkUsernameAvailability($username) {
        return $this->db
                    ->where('username', $username)
                    ->get($this->tableName)
                    ->num_rows();
    }

    public function login(){
		$username = $this->input->post('username');
        $password = $this->input->post('password');
        
        $userDetail = $this->db
                        ->where('username', $username)
                        ->where('password', md5($password))
                        ->get($this->tableName);

        if ($userDetail->num_rows() == 0) {
            return false;
        }

        $branchDetail = $this->Branch_model->getBranchDetailById($userDetail->row()->branch_id);

        $data = array(
            'full_name'	        => $userDetail->row()->full_name,
            'username'	        => $userDetail->row()->username,
            'logged_in'	        => true,
            'role'		        => $userDetail->row()->role,

            'branch_id'	        => $userDetail->row()->branch_id,
            'branch_name'       => $branchDetail->name,
            'branch_regist'     => $branchDetail->registration_code,
            'branch_address'    => $branchDetail->address,
        );
        
        $this->session->set_userdata($data);
        return true;
    }
}