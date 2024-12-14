<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ContohSoal extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        // Cek login
        if(!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        $this->load->model(['soal_model', 'progress_model']);
    }

    public function index()
    {
        // Redirect ke step terakhir yang dipelajari user
        $user_id = $this->session->userdata('user_id');
        $progress = $this->soal_model->get_user_progress($user_id);
        
        $current_step = ($progress) ? $progress->soal_selesai + 1 : 1;
        if($current_step > 2) $current_step = 2;
        
        redirect('contohsoal/step/' . $current_step);
    }
    
    public function step($step = 1) {
        // Validasi step
        if($step < 1 || $step > 2) {
            redirect('contohsoal');
        }
        
        $data['title'] = 'Contoh Soal';
        $data['user'] = $this->session->userdata();
        $data['current_step'] = $step;
        $data['soal'] = $this->soal_model->get_soal_by_step($step);
        
        // Update progress jika step valid
        $user_id = $this->session->userdata('user_id');
        $progress = $this->soal_model->get_user_progress($user_id);
        
        // Cek apakah progress ada dan memiliki property soal_selesai
        if($progress && isset($progress->soal_selesai) && $step > $progress->soal_selesai) {
            // Pastikan method update_progress ada di model
            if(method_exists($this->soal_model, 'update_progress')) {
                $this->soal_model->update_progress($user_id, $step);
            }
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('contoh_soal/index', $data);
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