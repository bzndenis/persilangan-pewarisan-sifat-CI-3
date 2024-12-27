<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Game_model extends CI_Model {
    
    private $table = 'minigame';
    
    public function get_game_by_level($level) {
        return $this->db->where('level', intval($level))
                        ->get($this->table)
                        ->row();
    }
    
    public function verify_answers($answers, $level) {
        $game = $this->get_game_by_level($level);
        $correct_answers = json_decode($game->correct_answers, true);
        
        $result = [
            'success' => true,
            'incorrect' => []
        ];
        
        foreach($answers as $position => $answer) {
            if(!isset($correct_answers[$position]) || 
               strtoupper($answer) !== strtoupper($correct_answers[$position])) {
                $result['success'] = false;
                $result['incorrect'][] = $position;
            }
        }
        
        return $result;
    }
    
    public function verify_ratio($ratio, $level) {
        $game = $this->get_game_by_level($level);
        $correct_ratio = json_decode($game->correct_ratio, true);
        
        $result = [
            'success' => true,
            'message' => 'Selamat! Rasio yang Anda masukkan benar!'
        ];
        
        // Verifikasi rasio
        if($ratio[0] != 9 || $ratio[1] != 3 || 
           $ratio[2] != 3 || $ratio[3] != 1) {
            $result['success'] = false;
            $result['message'] = 'Rasio yang Anda masukkan belum tepat. Silakan coba lagi!';
        }
        
        return $result;
    }
    
    public function level_exists($level) {
        return $this->db->where('level', $level)
                       ->get($this->table)
                       ->num_rows() > 0;
    }
    
    public function insert_default_game($data) {
        // Cek apakah data untuk level ini sudah ada
        $existing = $this->db->where('level', $data->level)
                            ->get($this->table)
                            ->num_rows();
        
        if ($existing == 0) {
            $insert_data = [
                'level' => $data->level,
                'title' => $data->title,
                'description' => $data->description,
                'correct_answers' => $data->correct_answers,
                'correct_ratio' => $data->correct_ratio
            ];
            
            return $this->db->insert($this->table, $insert_data);
        }
        
        return false;
    }
} 