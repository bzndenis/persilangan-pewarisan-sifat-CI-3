<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('auth_model');
        $this->load->library(['form_validation']);
    }
    
    public function index() {
        // Redirect ke login
        redirect('auth/login');
    }
    
    public function login() {
        if($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }
        
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        
        if($this->form_validation->run() == FALSE) {
            $data['title'] = 'Login';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            $this->_login();
        }
    }
    
    private function _login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        
        $user = $this->auth_model->login($username, $password);
        
        if($user) {
            $data = [
                'user_id' => $user->id,
                'username' => $user->username,
                'nama_lengkap' => $user->nama_lengkap,
                'kelas' => $user->kelas,
                'logged_in' => TRUE
            ];
            $this->session->set_userdata($data);
            redirect('dashboard');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger">Username atau password salah!</div>');
            redirect('auth/login');
        }
    }
    
    public function register() {
        if($this->session->userdata('logged_in')) {
            redirect('dashboard');
        }
        
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[6]');
        $this->form_validation->set_rules('konfirmasi_password', 'Konfirmasi Password', 'required|trim|matches[password]');
        $this->form_validation->set_rules('kelas', 'Kelas', 'required|trim');
        
        if($this->form_validation->run() == FALSE) {
            $data['title'] = 'Register';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/register');
            $this->load->view('templates/auth_footer');
        } else {
            $data = [
                'nama_lengkap' => htmlspecialchars($this->input->post('nama_lengkap', true)),
                'username' => htmlspecialchars($this->input->post('username', true)),
                'password' => $this->input->post('password'),
                'kelas' => htmlspecialchars($this->input->post('kelas', true))
            ];
            
            if($this->auth_model->register($data)) {
                $this->session->set_flashdata('message', '<div class="alert alert-success">Akun berhasil dibuat! Silakan login.</div>');
                redirect('auth/login');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger">Terjadi kesalahan!</div>');
                redirect('auth/register');
            }
        }
    }
    
    public function logout() {
        $this->session->unset_userdata(['user_id', 'username', 'nama_lengkap', 'kelas', 'logged_in']);
        $this->session->set_flashdata('message', '<div class="alert alert-success">Berhasil logout!</div>');
        redirect('auth/login');
    }
} 