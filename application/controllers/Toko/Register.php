<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_pelanggan');
        $this->load->model('m_auth');
        
    }
    

    public function index()
    {
        $this->form_validation->set_rules('nama_toko', 'Nama', 'required', array('required' => '%s Harus diisi !'));
        $this->form_validation->set_rules('email', 'Email', 'required', array('required' => '%s Harus diisi !'));
        $this->form_validation->set_rules('kontak_toko', 'Kontak_toko', 'required', array('required' => '%s Harus diisi !'));
        $this->form_validation->set_rules('password', 'Password', 'required', array('required' => '%s Harus diisi !'));
        $this->form_validation->set_rules('repassword', 'Repassword', 'required|matches[password]', array('required' => '%s Harus diisi !'));
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Register Toko',
                'isi' => 'toko/v_register',
            );
            $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
        }else{
            $data = array(
                'nama_toko' => $this->input->post('nama_toko'),
                'kontak_toko' => $this->input->post('kontak_toko'),
                'email' => $this->input->post('email'),
                'deskripsi_toko' => $this->input->post('deskripsi_toko'),
                'password' => $this->input->post('password'),

            );
            $this->m_pelanggan->register_toko($data);
            $this->session->set_flashdata('pesan', 'Register Berhasil !');
            
            redirect('auth/login_toko');
        }
        
        
    }

    
    
}