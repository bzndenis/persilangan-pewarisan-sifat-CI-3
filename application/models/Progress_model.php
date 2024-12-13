<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Progress_model extends CI_Model {
    
    public function get_user_progress($user_id) {
        return $this->db->where('user_id', $user_id)
                        ->get('progress_belajar')
                        ->row();
    }
    
    public function create_progress($user_id) {
        $data = [
            'user_id' => $user_id,
            'materi_selesai' => 0,
            'latihan_selesai' => 0,
            'minigame_level' => 1
        ];
        
        return $this->db->insert('progress_belajar', $data);
    }
    
    public function update_progress($user_id, $data) {
        return $this->db->where('user_id', $user_id)
                       ->update('progress_belajar', $data);
    }
} 