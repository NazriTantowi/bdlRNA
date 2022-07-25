<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan_saya extends CI_Controller 
{
    public function index()
    {
        $data = array(
            'title' => 'My Order',
            'isi' => 'v_pesanan_saya',
        );
        $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
    }
}