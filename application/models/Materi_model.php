<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Materi_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function get_all_materi() {
        return $this->db->order_by('step', 'ASC')
                        ->order_by('urutan', 'ASC')
                        ->get('materi')
                        ->result();
    }
    
    public function get_materi_by_step($step) {
        return $this->db->where('step', $step)
                        ->order_by('urutan', 'ASC')
                        ->get('materi')
                        ->row();
    }
    
    public function update_progress($user_id, $step) {
        // Update progress belajar user
        $this->db->where('user_id', $user_id)
                 ->update('progress_belajar', ['materi_selesai' => $step]);
                 
        // Update kolom materi_selesai di tabel users
        $this->db->where('id', $user_id)
                 ->update('users', ['materi_selesai' => $step]);
    }
    
    public function get_user_progress($user_id) {
        return $this->db->where('user_id', $user_id)
                        ->get('progress_belajar')
                        ->row();
    }
}