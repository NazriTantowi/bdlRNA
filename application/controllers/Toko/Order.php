<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_pesanan_masuk');
        
    }

    public function index()
    {
        $data['toko'] = $this->db->get_where('tbl_toko', ['email' => $this->session->userdata('email')])->row_array();
        $id_toko = $data['toko']['id_toko'];
        $data['pesanan'] = $this->db->query(" SELECT      *
                                            FROM        tbl_transaksi, tbl_rinci_transaksi, tbl_barang, tbl_toko
                                            WHERE       tbl_transaksi.no_order = tbl_rinci_transaksi.no_order
                                            AND         tbl_rinci_transaksi.id_barang = tbl_barang.id_barang
                                            AND	        tbl_barang.id_toko = tbl_toko.id_toko
                                            AND         tbl_toko.id_toko = $id_toko
                                            AND         tbl_transaksi.status_order = '1'
                                            ORDER BY    tbl_rinci_transaksi.no_order DESC")->result();
        
        $data['terkirim'] = $this->db->query(" SELECT      *
                                            FROM        tbl_transaksi, tbl_rinci_transaksi, tbl_barang, tbl_toko
                                            WHERE       tbl_transaksi.no_order = tbl_rinci_transaksi.no_order
                                            AND         tbl_rinci_transaksi.id_barang = tbl_barang.id_barang
                                            AND	        tbl_barang.id_toko = tbl_toko.id_toko
                                            AND         tbl_toko.id_toko = $id_toko
                                            AND         tbl_transaksi.status_order = '2'
                                            ORDER BY    tbl_rinci_transaksi.no_order DESC")->result();

        $data['selesai'] = $this->db->query(" SELECT      *
                                            FROM        tbl_transaksi, tbl_rinci_transaksi, tbl_barang, tbl_toko
                                            WHERE       tbl_transaksi.no_order = tbl_rinci_transaksi.no_order
                                            AND         tbl_rinci_transaksi.id_barang = tbl_barang.id_barang
                                            AND	        tbl_barang.id_toko = tbl_toko.id_toko
                                            AND         tbl_toko.id_toko = $id_toko
                                            AND         tbl_transaksi.status_order = '3'
                                            ORDER BY    tbl_rinci_transaksi.no_order DESC
                                            LIMIT       5")->result();

        
        $this->load->view('toko/template_toko/header');
        $this->load->view('toko/template_toko/sidebar');
        $this->load->view('toko/v_order', $data);
        $this->load->view('toko/template_toko/footer');
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
        redirect('toko/order');
        
    }
}