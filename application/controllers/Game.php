<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Game extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        // Load semua model yang dibutuhkan di constructor
        $this->load->model([
            'game_model',
            'progress_model',
            'game_answers_model',
            'game_correct_model'
        ]);
    }
    
    public function index() {
        $data['title'] = 'Mini Game';
        $data['user'] = $this->session->userdata();
        $data['current_level'] = ($this->session->userdata('minigame_level')) ? $this->session->userdata('minigame_level') : 1;
        
        // Ambil data game dari database
        $data['game'] = $this->db->where('level', $data['current_level'])
                                ->get('minigame')
                                ->row();
        
        // Ambil jawaban yang tersimpan
        $data['saved_answers'] = $this->game_answers_model->get_answers(
            $this->session->userdata('user_id'),
            $data['current_level']
        );
        
        if (!$data['game']) {
            $data['game'] = (object)[
                'title' => 'Level ' . $data['current_level'],
                'description' => 'Maaf, soal untuk level ini belum tersedia.'
            ];
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('game/index', $data);
        $this->load->view('templates/footer');
    }
    
    public function verify_answer() {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        
        $answers = $this->input->post('answers');
        $level = $this->input->post('level');
        $user_id = $this->session->userdata('user_id');
        
        // Ambil jawaban benar dari database
        $this->db->where('level', $level);
        $game = $this->db->get('minigame')->row();
        
        if (!$game) {
            echo json_encode(['success' => false, 'message' => 'Level tidak ditemukan']);
            return;
        }
        
        // Decode jawaban benar dari JSON
        $correct_answers = json_decode($game->correct_answers, true);
        
        // Bandingkan jawaban dengan pengecekan yang lebih ketat
        $incorrect = [];
        $allAnsweredCorrect = true;
        $correct_count = 0;
        
        foreach ($answers as $position => $answer) {
            if (!isset($correct_answers[$position])) {
                $allAnsweredCorrect = false;
                $incorrect[] = $position;
                continue;
            }

            $correct_answer = $correct_answers[$position];
            $is_valid = true;

            if (strlen($answer) !== strlen($correct_answer)) {
                $is_valid = false;
            } else {
                for ($i = 0; $i < strlen($answer); $i++) {
                    if ($answer[$i] !== $correct_answer[$i]) {
                        $is_valid = false;
                        break;
                    }
                }
            }

            if (!$is_valid) {
                $allAnsweredCorrect = false;
                $incorrect[] = $position;
            } else {
                $correct_count++;
            }
        }
        
        // Update progress di database
        $this->db->where('user_id', $user_id)
                 ->update('progress_belajar', [
                     'minigame_progress' => $correct_count,
                     'updated_at' => date('Y-m-d H:i:s')
                 ]);
        
        echo json_encode([
            'success' => $allAnsweredCorrect,
            'correct_answers' => $correct_answers,
            'incorrect' => $incorrect,
            'progress' => $correct_count
        ]);
    }
    
    public function verify_ratio() {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        
        $ratio = [
            $this->input->post('ratio1'),
            $this->input->post('ratio2'),
            $this->input->post('ratio3'),
            $this->input->post('ratio4')
        ];
        
        $level = $this->input->post('level');
        $user_id = $this->session->userdata('user_id');
        
        // Pastikan header response adalah JSON
        header('Content-Type: application/json');
        
        $result = $this->game_model->verify_ratio($ratio, $level);
        
        if($result['success']) {
            // Update progress untuk pertanyaan akhir
            $current_progress = $this->db->where('user_id', $user_id)
                                       ->get('progress_belajar')
                                       ->row()
                                       ->minigame_progress;
            
            $this->db->where('user_id', $user_id)
                     ->update('progress_belajar', [
                         'minigame_progress' => $current_progress + 1,
                         'updated_at' => date('Y-m-d H:i:s')
                     ]);
            
            $this->progress_model->update_game_progress($user_id, $level);
        }
        
        echo json_encode($result);
        exit;
    }
    
    public function next_level() {
        $user_id = $this->session->userdata('user_id');
        $progress = $this->progress_model->get_user_progress($user_id);
        
        if($progress) {
            $next_level = $progress->minigame_level + 1;
            // Cek apakah level berikutnya tersedia
            if($this->game_model->level_exists($next_level)) {
                $this->progress_model->update_game_progress($user_id, $next_level);
                redirect('game');
            } else {
                // Jika sudah tidak ada level berikutnya
                $this->session->set_flashdata('message', 'Selamat! Anda telah menyelesaikan semua level!');
                redirect('dashboard');
            }
        }
        
        redirect('game');
    }
    
    public function verify_single_answer() {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        
        $position = $this->input->post('position');
        $answer = $this->input->post('answer');
        $level = $this->input->post('level');
        
        // Ambil jawaban benar dari database
        $this->db->where('level', $level);
        $game = $this->db->get('minigame')->row();
        
        if (!$game) {
            echo json_encode(['correct' => false, 'message' => 'Level tidak ditemukan']);
            return;
        }
        
        // Decode jawaban benar dari JSON
        $correct_answers = json_decode($game->correct_answers, true);
        
        // Validasi jawaban untuk posisi tertentu dengan pengecekan yang lebih ketat
        $is_correct = false;
        if (isset($correct_answers[$position])) {
            $correct_answer = $correct_answers[$position];
            // Validasi panjang string
            if (strlen($answer) === strlen($correct_answer)) {
                // Validasi setiap karakter
                $is_valid = true;
                for ($i = 0; $i < strlen($answer); $i++) {
                    if ($answer[$i] !== $correct_answer[$i]) {
                        $is_valid = false;
                        break;
                    }
                }
                $is_correct = $is_valid;
            }
        }
        
        if ($is_correct) {
            // Simpan jawaban yang benar ke database
            $user_id = $this->session->userdata('user_id');
            $this->game_answers_model->save_single_answer($user_id, $level, $position, $answer);
        }
        
        echo json_encode([
            'correct' => $is_correct,
            'message' => $is_correct ? 'Benar!' : 'Coba lagi'
        ]);
    }
    
    public function save_correct_answer() {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        
        $user_id = $this->session->userdata('user_id');
        $level = $this->input->post('level');
        $position = $this->input->post('position');
        $answer = $this->input->post('answer');
        
        // Ambil jawaban yang sudah tersimpan
        $saved_answers = $this->game_answers_model->get_answers($user_id, $level);
        if (!$saved_answers) {
            $saved_answers = array();
        }
        
        // Update jawaban yang benar
        $saved_answers[$position] = $answer;
        
        // Simpan ke database
        $this->game_answers_model->save_answers($user_id, $level, $saved_answers);
        
        echo json_encode(['success' => true]);
    }
    
    public function get_saved_answers() {
        if (!$this->input->is_ajax_request()) {
            exit('No direct script access allowed');
        }
        
        $user_id = $this->session->userdata('user_id');
        $level = $this->input->post('level');
        
        $saved_answers = $this->game_answers_model->get_answers($user_id, $level);
        
        echo json_encode([
            'success' => true,
            'saved_answers' => $saved_answers
        ]);
    }
} 