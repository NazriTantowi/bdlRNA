<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function login_user()
    {
        $this->form_validation->set_rules('username', 'username', 'required', array(
            'required'=>'%s Harus Diisi !!!'
        ));
        $this->form_validation->set_rules('password', 'password', 'required', array(
            'required'=>'%s Harus Diisi !!!'
        ));

        if ($this->form_validation->run()== TRUE) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $this->user_login->login($username, $password);
        }
        $data = array(
            'title' => 'Login User',
        );
        $this->load->view('v_login_user', $data, FALSE);
        
    }

    public function logout_user()
    {
        $this->user_login->logout();
    }

    public function login_toko()
    {
        $this->form_validation->set_rules('email', 'email', 'required', array(
            'required'=>'%s Harus Diisi !!!'
        ));
        $this->form_validation->set_rules('password', 'password', 'required', array(
            'required'=>'%s Harus Diisi !!!'
        ));

        if ($this->form_validation->run()== TRUE) {
            $email = $this->input->post('email');
            $password = $this->input->post('password');
            $this->toko_login->login($email, $password);
        }
        $data = array(
            'title' => 'Login Toko',
        );
        $this->load->view('toko/v_login_toko', $data, FALSE);
        
    }

    public function logout_toko()
    {
        $this->toko_login->logout();
    }
}
