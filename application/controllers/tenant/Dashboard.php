<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function index()
    {
        $this->load->view('tenant/template_tenant/header');
        $this->load->view('tenant/template_tenant/sidebar');
        $this->load->view('tenant/dashboard');
        $this->load->view('tenant/template_tenant/footer');
    }
    
}