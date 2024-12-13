<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Soal_model extends CI_Model {
    
    private $table = 'soal';
    
    public function __construct() {
        parent::__construct();
    }
    
    public function get_all_soal() {
        $query = $this->db->get($this->table);
        if($query->num_rows() > 0) {
            return $query->result();
        }
        return array(); // Return array kosong jika tidak ada data
    }
    
    public function get_soal_by_id($id) {
        $this->db->select('id, pertanyaan, gambar, pilihan_a, pilihan_b, pilihan_c, pilihan_d, jawaban_benar, penjelasan, gambar_penjelasan');
        $this->db->where('id', $id);
        return $this->db->get($this->table)->row();
    }
    
    public function check_answer($soal_id, $jawaban) {
        $soal = $this->get_soal_by_id($soal_id);
        if($soal) {
            return $soal->kunci_jawaban === $jawaban;
        }
        return false;
    }
    
    public function get_soal_by_step($step) {
        $this->db->select('id, pertanyaan, gambar, pilihan_a, pilihan_b, pilihan_c, pilihan_d, jawaban_benar, penjelasan, gambar_penjelasan');
        $this->db->where('step', $step);
        $query = $this->db->get($this->table);
        if($query->num_rows() > 0) {
            return $query->result();
        }
        return array();
    }

    public function get_user_progress($user_id) {
        $this->db->where('user_id', $user_id);
        return $this->db->get('progress_belajar')->row();
    }
} 