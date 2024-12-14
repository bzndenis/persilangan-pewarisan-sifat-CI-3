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
        
        // Ambil parameter pencarian
        $search = $this->input->get('search');
        
        // Konfigurasi pagination
        $this->load->library('pagination');
        
        // Base URL dengan parameter pencarian
        $config['base_url'] = base_url('dashboard/index');
        $config['total_rows'] = $this->progress_model->get_total_users($search);
        $config['per_page'] = 15;
        $config['uri_segment'] = 3;
        
        // Tambahkan parameter pencarian ke pagination
        if ($search) {
            $config['suffix'] = '?search=' . urlencode($search);
            $config['first_url'] = $config['base_url'] . '?search=' . urlencode($search);
        }
        
        // Styling pagination
        $config['full_tag_open'] = '<nav><ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul></nav>';
        
        $config['first_link'] = 'Pertama';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        
        $config['last_link'] = 'Terakhir';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        
        $config['next_link'] = '&raquo;';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        
        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        
        $config['attributes'] = array('class' => 'page-link');
        
        $this->pagination->initialize($config);
        
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        // Ambil data progress dari database
        $progress = $this->progress_model->get_user_progress($user_id);
        
        // Jika belum ada data progress, buat baru
        if (!$progress) {
            $this->progress_model->create_progress($user_id);
            $progress = $this->progress_model->get_user_progress($user_id);
        }
        
        // Pastikan minigame_progress memiliki nilai default
        if (!isset($progress->minigame_progress)) {
            $progress->minigame_progress = 0;
            $this->db->where('user_id', $user_id)
                     ->update('progress_belajar', ['minigame_progress' => 0]);
        }
        
        // Gabungkan data user dengan progress
        $user_data = $this->session->userdata();
        $data['user'] = array_merge($user_data, [
            'materi_selesai' => $progress->materi_selesai,
            'latihan_selesai' => $progress->latihan_selesai,
            'minigame_level' => $progress->minigame_level,
            'minigame_progress' => $progress->minigame_progress
        ]);
        
        // Ambil data leaderboard dengan pagination dan pencarian
        $data['leaderboard'] = $this->progress_model->get_leaderboard($config['per_page'], $page, $search);
        $data['pagination'] = $this->pagination->create_links();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('dashboard/index', $data);
        $this->load->view('templates/footer');
    }
} 