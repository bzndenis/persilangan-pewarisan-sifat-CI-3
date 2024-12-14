<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function get_user($user_id) {
        return $this->db->where('user_id', $user_id)
                       ->get('users')
                       ->row();
    }
    
    public function get_all_users() {
        return $this->db->get('users')->result();
    }
    
    public function update_user($user_id, $data) {
        return $this->db->where('user_id', $user_id)
                       ->update('users', $data);
    }
    
    public function delete_user($user_id) {
        return $this->db->where('user_id', $user_id)
                       ->delete('users');
    }
} 