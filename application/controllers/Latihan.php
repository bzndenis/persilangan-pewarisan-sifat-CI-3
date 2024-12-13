<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Latihan extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        $this->load->model(['soal_model', 'progress_model']);
    }
    
    public function index() {
        // Redirect ke step terakhir yang dipelajari user
        $user_id = $this->session->userdata('user_id');
        $progress = $this->soal_model->get_user_progress($user_id);
        
        $current_step = ($progress && isset($progress->latihan_selesai)) ? $progress->latihan_selesai + 1 : 1;
        if($current_step > 2) $current_step = 2;
        
        redirect('latihan/step/' . $current_step);
    }
    
    public function step($step = 1) {
        $step = (int)$step;
        if($step < 1 || $step > 2) {
            redirect('latihan');
        }
        
        $data['title'] = 'Latihan Soal';
        $data['user'] = $this->session->userdata();
        $data['current_step'] = $step;
        $data['soal'] = $this->soal_model->get_soal_by_step($step);
        
        if(empty($data['soal'])) {
            redirect('latihan');
        }
        
        // Update progress jika step valid
        $user_id = $this->session->userdata('user_id');
        $progress = $this->progress_model->get_user_progress($user_id);
        
        // Update latihan_selesai di tabel progress
        if($progress) {
            $latihan_selesai = $step > $progress->latihan_selesai ? $step : $progress->latihan_selesai;
            $this->progress_model->update_progress($user_id, [
                'latihan_selesai' => $latihan_selesai
            ]);
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('latihan/index', $data);
        $this->load->view('templates/footer');
    }
    
    public function lihat_penjelasan($id) {
        $soal = $this->soal_model->get_soal_by_id($id);
        echo json_encode([
            'penjelasan' => $soal->penjelasan,
            'gambar_penjelasan' => $soal->gambar_penjelasan ? base_url($soal->gambar_penjelasan) : null
        ]);
    }
}