<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Game_answers_model extends CI_Model {
    
    private $table = 'game_answers';
    
    public function save_answers($user_id, $level, $answers) {
        $existing = $this->db->where('user_id', $user_id)
                            ->where('level', $level)
                            ->get($this->table)
                            ->row();
                            
        $data = [
            'user_id' => $user_id,
            'level' => $level,
            'answers' => json_encode($answers)
        ];
        
        if ($existing) {
            return $this->db->where('user_id', $user_id)
                           ->where('level', $level)
                           ->update($this->table, $data);
        } else {
            return $this->db->insert($this->table, $data);
        }
    }
    
    public function get_answers($user_id, $level) {
        $result = $this->db->where('user_id', $user_id)
                          ->where('level', $level)
                          ->get($this->table)
                          ->row();
                          
        return $result ? json_decode($result->answers, true) : null;
    }
    
    public function save_single_answer($user_id, $level, $position, $answer) {
        $existing = $this->get_answers($user_id, $level);
        
        if ($existing === null) {
            $existing = array();
        }
        
        // Update atau tambah jawaban baru
        $existing[$position] = $answer;
        
        return $this->save_answers($user_id, $level, $existing);
    }
    
    public function get_current_game($user_id, $level) {
        return $this->db->where('user_id', $user_id)
                        ->where('level', $level)
                        ->get($this->table)
                        ->row();
    }
    
    public function save_current_game($user_id, $level, $game_id) {
        $data = [
            'user_id' => $user_id,
            'level' => $level,
            'game_id' => $game_id,
            'answers' => '{}' // Inisialisasi jawaban kosong
        ];
        
        return $this->db->insert($this->table, $data);
    }
}
