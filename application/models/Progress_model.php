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
            'minigame_level' => 1,
            'minigame_progress' => 0
        ];
        
        return $this->db->insert('progress_belajar', $data);
    }
    
    public function update_progress($user_id, $data) {
        return $this->db->where('user_id', $user_id)
                       ->update('progress_belajar', $data);
    }

    public function update_game_progress($user_id, $level) {
        $data = [
            'minigame_level' => $level
        ];
        
        return $this->db->where('user_id', $user_id)
                       ->update('progress_belajar', $data);
    }

    public function get_leaderboard($limit = 15, $offset = 0, $search = '') {
        $this->db->select('users.id as user_id, users.nama_lengkap, progress_belajar.*');
        $this->db->from('progress_belajar');
        $this->db->join('users', 'users.id = progress_belajar.user_id');
        
        if (!empty($search)) {
            $this->db->like('users.nama_lengkap', $search);
        }
        
        $this->db->order_by('materi_selesai', 'DESC');
        $this->db->order_by('latihan_selesai', 'DESC');
        $this->db->order_by('minigame_progress', 'DESC');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result();
    }

    public function get_total_users($search = '') {
        $this->db->from('progress_belajar');
        $this->db->join('users', 'users.id = progress_belajar.user_id');
        
        if (!empty($search)) {
            $this->db->like('users.nama_lengkap', $search);
        }
        
        return $this->db->count_all_results();
    }
} 