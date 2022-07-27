<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Toko_login
{
    protected $ci;

    public function __construct()
    {
        $this->ci =& get_instance();
        $this->ci->load-> model('m_auth');
        
    }

    public function login($email, $password)
    {
        $cek = $this->ci->m_auth->login_toko($email, $password);
        if ($cek) {
            $id_toko = $cek->id_toko;
            $nama_toko = $cek->nama_toko;
            $email = $cek->email;
            //buat session
            $this->ci->session->set_userdata('id_toko', $id_toko);
            $this->ci->session->set_userdata('nama_toko', $nama_toko);
            $this->ci->session->set_userdata('email', $email);
            redirect('toko/dashboard');
        } else{
            //jika salah
            $this->ci->session->set_flashdata('error', 'email atau Passsword salah');
            redirect('auth/login_toko');
        }
    }

    public function proteksi_halaman()
    {
        if ($this->ci->session->userdata('nama_toko')=='') {
            $this->ci->session->set_flashdata('error', 'Anda Belum Login!');
            redirect('auth/login_toko');
        }
    }

    public function logout()
    {
        $this->ci->session->unset_userdata('id_toko');
        $this->ci->session->unset_userdata('nama_toko');
        $this->ci->session->unset_userdata('email');
        $this->ci->session->set_flashdata('pesan', 'Anda Berhasil Logout!');
        redirect('auth/login_toko');
    }
}

/* End of file User_login.php */
