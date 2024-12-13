<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Materi extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        // Cek login
        if(!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        $this->load->model('materi_model');
    }
    
    public function index() {
        // Redirect ke step terakhir yang dipelajari user
        $user_id = $this->session->userdata('user_id');
        $progress = $this->materi_model->get_user_progress($user_id);
        
        $current_step = ($progress) ? $progress->materi_selesai + 1 : 1;
        if($current_step > 3) $current_step = 3;
        
        redirect('materi/step/' . $current_step);
    }
    
    public function step($step = 1) {
        // Validasi step
        if($step < 1 || $step > 3) {
            redirect('materi');
        }
        
        $data['title'] = 'Materi Pembelajaran';
        $data['user'] = $this->session->userdata();
        $data['current_step'] = $step;
        $data['materi'] = $this->materi_model->get_materi_by_step($step);
        
        // Update progress jika step valid
        $user_id = $this->session->userdata('user_id');
        $progress = $this->materi_model->get_user_progress($user_id);
        
        if($progress && $step > $progress->materi_selesai) {
            $this->materi_model->update_progress($user_id, $step);
        }
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('materi/index', $data);
        $this->load->view('templates/footer');
    }
}