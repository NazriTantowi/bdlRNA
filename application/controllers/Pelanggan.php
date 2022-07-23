<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller 
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_pelanggan');
        
    }
    

    public function register()
    {
        $this->form_validation->set_rules('nama_pelanggan', 'Nama', 'required', array('required' => '%s Harus diisi !'));
        $this->form_validation->set_rules('email', 'Email', 'required', array('required' => '%s Harus diisi !'));
        $this->form_validation->set_rules('password', 'Password', 'required', array('required' => '%s Harus diisi !'));
        $this->form_validation->set_rules('repassword', 'Repassword', 'required|matches[password]', array('required' => '%s Harus diisi !'));
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Register Customer',
                'isi' => 'v_register',
            );
            $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
        }else{
            $data = array(
                'nama_pelanggan' => $this->input->post('nama_pelanggan'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),

            );
            $this->m_pelanggan->register($data);
            $this->session->set_flashdata('pesan', 'Register Berhasil !');
            
            redirect('pelanggan/register');
        }
        
        
    }
}