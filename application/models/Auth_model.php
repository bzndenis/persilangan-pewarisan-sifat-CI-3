<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function register($data) {
        // Hash password sebelum disimpan
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        return $this->db->insert('users', $data);
    }
    
    public function check_username($username) {
        $query = $this->db->get_where('users', ['username' => $username]);
        return $query->num_rows();
    }
    
    public function login($username, $password) {
        $user = $this->db->get_where('users', ['username' => $username])->row();
        if ($user) {
            if (password_verify($password, $user->password)) {
                return $user;
            }
        }
        return false;
    }
} 