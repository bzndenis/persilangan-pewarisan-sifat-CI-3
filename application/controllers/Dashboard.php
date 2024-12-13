<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        // Cek apakah user sudah login
        if(!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        $this->load->model(['materi_model', 'progress_model']);
    }
    
    public function index() {
        $data['title'] = 'Dashboard';
        $user_id = $this->session->userdata('user_id');
        
        // Ambil data progress dari database
        $progress = $this->progress_model->get_user_progress($user_id);
        
        // Jika belum ada data progress, buat baru
        if (!$progress) {
            $this->progress_model->create_progress($user_id);
            $progress = $this->progress_model->get_user_progress($user_id);
        }
        
        // Gabungkan data user dengan progress
        $user_data = $this->session->userdata();
        $data['user'] = array_merge($user_data, [
            'materi_selesai' => $progress->materi_selesai,
            'latihan_selesai' => $progress->latihan_selesai,
            'minigame_level' => $progress->minigame_level
        ]);
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('templates/footer');
    }
} 