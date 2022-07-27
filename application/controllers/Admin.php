<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller 
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_admin');
        $this->load->model('m_pesanan_masuk');
        
        
    }
    

    public function index()
    {
        
        $data = array(
            'toko' => $this->db->query("SELECT tbl_toko.nama_toko, SUM(tbl_transaksi.total_bayar) AS jumlah, COUNT(tbl_rinci_transaksi.id_barang) AS produk
                                        FROM tbl_transaksi, tbl_toko, tbl_barang, tbl_rinci_transaksi
                                        WHERE tbl_transaksi.no_order = tbl_rinci_transaksi.no_order
                                        AND tbl_rinci_transaksi.id_barang = tbl_barang.id_barang
                                        AND tbl_toko.id_toko = tbl_barang.id_toko
                                        GROUP BY tbl_toko.id_toko
                                        ORDER BY jumlah DESC, produk DESC")->result(),
            'produk' => $this->db->query("  SELECT tbl_barang.nama_barang, COUNT(tbl_rinci_transaksi.id_barang) AS jumlah
                                            FROM tbl_transaksi, tbl_toko, tbl_barang, tbl_rinci_transaksi
                                            WHERE tbl_transaksi.no_order = tbl_rinci_transaksi.no_order
                                            AND tbl_rinci_transaksi.id_barang = tbl_barang.id_barang
                                            AND tbl_toko.id_toko = tbl_barang.id_toko
                                            GROUP BY tbl_barang.id_barang
                                            ORDER BY jumlah DESC")->result(),
            'cust' => $this->db->query("SELECT *, COUNT(tbl_transaksi.id_pelanggan) AS jumlah
                                        FROM tbl_transaksi, tbl_pelanggan
                                        WHERE tbl_pelanggan.id_pelanggan = tbl_transaksi.id_pelanggan
                                        GROUP BY tbl_pelanggan.id_pelanggan
                                        ORDER BY jumlah DESC")->result(),                            
            'title' => 'Dasboard',
            'total_barang' => $this->m_admin->total_barang(),
            'total_kategori' => $this->m_admin->total_kategori(),
            'isi' => 'v_admin',
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);
        
    }

    public function setting()
    {
        $this->form_validation->set_rules('nama_toko', 'Nama Toko', 'required', array('required' => '%s Harus diisi !'));
        $this->form_validation->set_rules('kota', 'Kota', 'required', array('required' => '%s Harus diisi !'));
        $this->form_validation->set_rules('alamat_toko', 'Alamat Toko', 'required', array('required' => '%s Harus diisi !'));
        $this->form_validation->set_rules('no_telepon', 'No Telepon', 'required', array('required' => '%s Harus diisi !'));
        if ($this->form_validation->run() == FALSE) {
            $data = array(
                'title' => 'Setting',
                'setting' => $this->m_admin->data_setting(),
                'isi' => 'v_setting',
            );
            $this->load->view('layout/v_wrapper_backend', $data, FALSE);
        }else{
            $data = array(
                'id' => 1,
                'lokasi' => $this->input->post('kota'),
                'nama_toko' => $this->input->post('nama_toko'),
                'alamat_toko' => $this->input->post('alamat_toko'),
                'no_telpon' => $this->input->post('no_telpon'),

            );
            $this->m_admin->edit($data);
            $this->session->set_flashdata('pesan', 'Berhasil diganti !');
            
            redirect('admin/setting');
        }
        
        
    }

    public function pesanan_masuk()
    {
        $data = array(
            'title' => 'Pesanan Masuk',
            'pesanan' => $this->m_pesanan_masuk->pesanan(),
            'pesanan_diproses' => $this->m_pesanan_masuk->pesanan_diproses(),
            'pesanan_dikirim' => $this->m_pesanan_masuk->pesanan_dikirim(),
            'pesanan_selesai' => $this->m_pesanan_masuk->pesanan_selesai(),
            'isi' => 'v_pesanan_masuk',
        );
        $this->load->view('layout/v_wrapper_backend', $data, FALSE);   
    }

    public function proses($id_transaksi)
    {
        $data = array(
            'id_transaksi' => $id_transaksi,
            'no_resi' => $this->input->post('no_resi'),
            'status_order' => '1'
        );
        $this->m_pesanan_masuk->update_order($data);
        $this->session->set_flashdata('pesan', 'Pesanan berhasil di proses dan sedang di kemas');
        redirect('admin/pesanan_masuk');
        
    }

    public function kirim($id_transaksi)
    {
        $data = array(
            'id_transaksi' => $id_transaksi,
            'no_resi' => $this->input->post('no_resi'),
            'status_order' => '2'
        );
        $this->m_pesanan_masuk->update_order($data);
        $this->session->set_flashdata('pesan', 'Pesanan berhasil di kirim');
        redirect('admin/pesanan_masuk');
        
    }
    
}