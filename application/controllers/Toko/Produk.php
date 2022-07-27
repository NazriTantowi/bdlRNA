<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_barang');
        $this->load->model('m_kategori');
        $this->load->model('m_toko');
        
    }

    public function index()
    {
        $data['toko'] = $this->db->get_where('tbl_toko', ['email' => $this->session->userdata('email')])->row_array();
        $data['produk'] = $this->m_barang->get_all_data_toko($data['toko']['id_toko']);
        
        $this->load->view('toko/template_toko/header', $data);
        $this->load->view('toko/template_toko/sidebar', $data);
        $this->load->view('toko/v_produk', $data);
        $this->load->view('toko/template_toko/footer', $data);
    }
    
}