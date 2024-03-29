<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Belanja extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_transaksi');
        
    }
    

    public function index()
    {
        if (empty($this->cart->contents())) {
            redirect('home');
        }
        $data = array(
            'title' => 'Keranjang Belanja',
            'isi' => 'v_belanja',
        );
        $this->load->view('layout/v_wrapper_frontend', $data, FALSE); 
    }

    public function add()
    {
        $redirect_page = $this->input->post('redirect_page');
        $data = array(
            'id'      => $this->input->post('id'),
            'qty'     => $this->input->post('qty'),
            'price'   => $this->input->post('price'),
            'name'    => $this->input->post('name'),
            
        );
    
        $this->cart->insert($data);
        
        redirect($redirect_page,'refresh');
        
    }

    public function delete($rowid)
    {
        $this->cart->remove($rowid);
        redirect('belanja');
    }
    public function update()
    {
        $i = 1;
        foreach ($this->cart->contents() as $items) {
            $data = array(
                'rowid' => $items['rowid'],
                'qty'   => $this->input->post($i . '[qty]'),
            );
            $this->cart->update($data);
            $i++;
        }
        redirect('belanja');
    }

    public function cekout()
    {
        $this->pelanggan_login->proteksi_halaman();
        $data = array(
                'title' => 'Check-Out',
                'isi' => 'v_cekout',
            );
        $this->load->view('layout/v_wrapper_frontend', $data, FALSE);
    
    }

    public function proses_cekout()
    {
        $data = array(
            'id_pelanggan'=> $this->session->userdata('id_pelanggan'),
            'no_order' => $this->input->post('no_order'),
            'tgl_order' => date('Y-m-d'),
            'provinsi' => $this->input->post('provinsi'),
            'kota' => $this->input->post('kota'),
            'expedisi' => $this->input->post('expedisi'),
            'paket' => $this->input->post('paket'),
            'alamat' => $this->input->post('alamat'),
            'kode_pos' => $this->input->post('kode_pos'),
            'nama_penerima' => $this->input->post('nama_penerima'),
            'hp_penerima' => $this->input->post('hp_penerima'),
            'berat' => $this->input->post('berat'),
            'grand_total' => $this->input->post('grand_total'),
            'total_bayar' => $this->input->post('total_bayar'),
            'status_bayar' => 0,
            'status_order' => 0,
        );
        $this->m_transaksi->simpan_transaksi($data);
        $i=1;
        foreach ($this->cart->contents() as $item){
            $data_rinci = array(
                'no_order' => $this->input->post('no_order'),
                'id_barang' => $item['id'],
                'qty' => $this->input->post('qty'.$i++)
            );
            $this->m_transaksi->simpan_rinci_transaksi($data_rinci);
            $this->cart->destroy();
        }
        redirect('pesanan_saya');
    }

    public function clear()
    {
        $this->cart->destroy();
        redirect('belanja');
    }

}   
