<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Latihan extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        if(!$this->session->userdata('logged_in')) {
            redirect('auth/login');
        }
        $this->load->model('soal_model');
    }
    
    public function index() {
        $data['title'] = 'Contoh Soal';
        $data['user'] = $this->session->userdata();
        $data['soal'] = $this->soal_model->get_all_soal();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('latihan/index', $data);
        $this->load->view('templates/footer');
    }
    
    public function check() {
        if (!$this->input->is_ajax_request()) {
            exit('Akses langsung tidak diizinkan');
        }
        
        $jawaban = $this->input->post('jawaban');
        $soal_id = $this->input->post('soal_id');
        
        $is_correct = $this->soal_model->check_answer($soal_id, $jawaban);
        
        $response = [
            'status' => $is_correct ? 'success' : 'error',
            'message' => $is_correct ? 'Jawaban benar!' : 'Jawaban salah, coba lagi!'
        ];
        
        echo json_encode($response);
    }
} 