<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_pesanan_masuk');
        
    }

    public function index()
    {
        $this->load->view('toko/template_toko/header');
        $this->load->view('toko/template_toko/sidebar');
        $this->load->view('toko/v_dashboard');
        $this->load->view('toko/template_toko/footer');
    }
    
}