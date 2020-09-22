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
        return $this->db->affected_rows() > 0;
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