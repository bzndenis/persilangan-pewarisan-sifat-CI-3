<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Game_correct_model extends CI_Model {
    
    private $table = 'game_correct_answers';
    
    public function get_correct_answers($level) {
        return $this->db->where('level', $level)
                       ->order_by('position', 'ASC')
                       ->get($this->table)
                       ->result_array();
    }
    
    public function insert_default_answers($level) {
        // Data default untuk level 1
        $default_answers = [
            ['position' => '0_0', 'correct_answer' => 'BBKK'],
            ['position' => '0_1', 'correct_answer' => 'BBKk'],
            ['position' => '0_2', 'correct_answer' => 'BbKK'],
            ['position' => '0_3', 'correct_answer' => 'BbKk'],
            ['position' => '1_0', 'correct_answer' => 'BBKk'],
            ['position' => '1_1', 'correct_answer' => 'BBkk'],
            ['position' => '1_2', 'correct_answer' => 'BbKk'],
            ['position' => '1_3', 'correct_answer' => 'Bbkk'],
            ['position' => '2_0', 'correct_answer' => 'BbKK'],
            ['position' => '2_1', 'correct_answer' => 'BbKk'],
            ['position' => '2_2', 'correct_answer' => 'bbKK'],
            ['position' => '2_3', 'correct_answer' => 'bbKk'],
            ['position' => '3_0', 'correct_answer' => 'BbKk'],
            ['position' => '3_1', 'correct_answer' => 'Bbkk'],
            ['position' => '3_2', 'correct_answer' => 'bbKk'],
            ['position' => '3_3', 'correct_answer' => 'bbkk']
        ];
        
        foreach ($default_answers as $answer) {
            $data = [
                'level' => $level,
                'position' => $answer['position'],
                'correct_answer' => $answer['correct_answer']
            ];
            $this->db->insert($this->table, $data);
        }
    }
} 