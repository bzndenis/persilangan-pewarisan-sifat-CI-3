<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Game_answers_model extends CI_Model {
    
    public function save_answers($user_id, $level, $position, $answer) {
        $data = array(
            'user_id' => $user_id,
            'level' => $level,
            'position' => $position,
            'answer' => $answer,
            'is_correct' => 1
        );
        
        // Cek apakah data sudah ada
        $existing = $this->db->get_where('game_answers', array(
            'user_id' => $user_id,
            'level' => $level,
            'position' => $position
        ))->row();
        
        if ($existing) {
            // Update jika sudah ada
            $this->db->where(array(
                'user_id' => $user_id,
                'level' => $level,
                'position' => $position
            ));
            return $this->db->update('game_answers', $data);
        } else {
            // Insert jika belum ada
            return $this->db->insert('game_answers', $data);
        }
    }
    
    public function get_answers($user_id, $level) {
        $answers = array();
        $query = $this->db->get_where('game_answers', array(
            'user_id' => $user_id,
            'level' => $level,
            'is_correct' => 1
        ));
        
        foreach ($query->result() as $row) {
            $answers[$row->position] = $row->answer;
        }
        
        return $answers;
    }

    public function save_single_answer($user_id, $level, $position, $answer) {
        $data = array(
            'user_id' => $user_id,
            'level' => $level,
            'position' => $position,
            'answer' => $answer,
            'is_correct' => 1
        );

        // Cek apakah data sudah ada
        $existing = $this->db->get_where('game_answers', array(
            'user_id' => $user_id,
            'level' => $level,
            'position' => $position
        ))->row();

        if ($existing) {
            $this->db->where(array(
                'user_id' => $user_id,
                'level' => $level,
                'position' => $position
            ));
            return $this->db->update('game_answers', $data);
        } else {
            return $this->db->insert('game_answers', $data);
        }
    }
}
