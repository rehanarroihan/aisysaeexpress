<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function insert($branchId) {
        $data = array(
			'branch_id'     => $branchId,
			'username'		=> $this->input->post('username'),
			'full_name'	    => $this->input->post('full_name'),
			'password'	    => md5($this->input->post('password')),
			'role'	        => 2,
			'created_at'	=> date("Y-m-d h:m:s"),
			'updated_at'	=> date("Y-m-d h:m:s")
        );
        $this->db->insert('users', $data);
        // NOTE : returning last inserted data row
        return $this->db
                ->select('users.id AS user_id, branch.id AS branch_id, branch.name, branch.address, users.full_name, users.username')
                ->join('branch','branch.id = users.branch_id')
                ->where('users.id', $this->db->insert_id())
                ->get('users')
                ->row();
    }

    public function checkUsernameAvailability($username) {
        return $this->db
                    ->where('username', $username)
                    ->get('users')
                    ->num_rows();
    }

    public function login(){
		$username = $this->input->post('username');
        $password = $this->input->post('password');
        
        $query = $this->db
                    ->where('username', $username)
                    ->where('password', md5($password))
                    ->get('users');

        if ($query->num_rows() == 0) {
            return false;
        }

        $data = array(
            'full_name'	=> $query->row()->full_name,
            'username'	=> $query->row()->username,
            'logged_in'	=> true,
            'role'		=> $query->row()->role
        );
        
        $this->session->set_userdata($data);
        return true;
    }
}