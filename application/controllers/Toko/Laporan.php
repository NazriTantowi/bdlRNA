<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_laporan');
        $this->load->model('m_barang');
        
    }

    public function index()
    {
        $data['toko'] = $this->db->get_where('tbl_toko', ['email' => $this->session->userdata('email')])->row_array();
        $data['produk'] = $this->m_barang->get_all_data_toko($data['toko']['id_toko']);
        $this->load->view('toko/template_toko/header');
        $this->load->view('toko/template_toko/sidebar');
        $this->load->view('toko/v_laporan', $data);
        $this->load->view('toko/template_toko/footer');
    }

    public function lap_harian()
    {
        $data['toko'] = $this->db->get_where('tbl_toko', ['email' => $this->session->userdata('email')])->row_array();
        $id_toko = $data['toko']['id_toko'];
        $tanggal = $this->input->post('tanggal');
        $bulan = $this->input->post('bulan');
        $tahun= $this->input->post('tahun');
        $data = array(
            'tanggal' => $tanggal,
            'bulan' => $bulan,
            'tahun' => $tahun,
        );

        $data['harian'] = $this->db->query("SELECT *
                                            FROM tbl_rinci_transaksi, tbl_transaksi, tbl_barang, tbl_toko
                                            WHERE tbl_transaksi.no_order = tbl_rinci_transaksi.no_order
                                            AND tbl_rinci_transaksi.id_barang = tbl_barang.id_barang
                                            AND tbl_toko.id_toko = tbl_barang.id_toko
                                            AND tbl_toko.id_toko = $id_toko
                                            AND DAY(tbl_transaksi.tgl_order) = $tanggal
                                            AND MONTH(tbl_transaksi.tgl_order) = $bulan
                                            AND YEAR(tbl_transaksi.tgl_order) = $tahun
                                            ORDER BY tbl_transaksi.id_transaksi DESC")->result();
        $this->load->view('toko/template_toko/header');
        $this->load->view('toko/template_toko/sidebar');
        $this->load->view('toko/v_lap_harian', $data);
        $this->load->view('toko/template_toko/footer');
    }

    public function lap_bulanan()
    {
        $data['toko'] = $this->db->get_where('tbl_toko', ['email' => $this->session->userdata('email')])->row_array();
        $id_toko = $data['toko']['id_toko'];
        $bulan = $this->input->post('bulan');
        $tahun= $this->input->post('tahun');
        $data = array(
            'bulan' => $bulan,
            'tahun' => $tahun,
        );

        $data['bulanan'] = $this->db->query("SELECT *
                                            FROM tbl_rinci_transaksi, tbl_transaksi, tbl_barang, tbl_toko
                                            WHERE tbl_transaksi.no_order = tbl_rinci_transaksi.no_order
                                            AND tbl_rinci_transaksi.id_barang = tbl_barang.id_barang
                                            AND tbl_toko.id_toko = tbl_barang.id_toko
                                            AND tbl_toko.id_toko = $id_toko
                                            AND MONTH(tbl_transaksi.tgl_order) = $bulan
                                            AND YEAR(tbl_transaksi.tgl_order) = $tahun
                                            ORDER BY tbl_transaksi.id_transaksi DESC")->result();
        $this->load->view('toko/template_toko/header');
        $this->load->view('toko/template_toko/sidebar');
        $this->load->view('toko/v_lap_bulanan', $data);
        $this->load->view('toko/template_toko/footer');
    }

    public function lap_tahunan()
    {
        $data['toko'] = $this->db->get_where('tbl_toko', ['email' => $this->session->userdata('email')])->row_array();
        $id_toko = $data['toko']['id_toko'];
        $bulan = $this->input->post('bulan');
        $tahun= $this->input->post('tahun');
        $data = array(
            'tahun' => $tahun,
        );

        $data['tahunan'] = $this->db->query("SELECT *
                                            FROM tbl_rinci_transaksi, tbl_transaksi, tbl_barang, tbl_toko
                                            WHERE tbl_transaksi.no_order = tbl_rinci_transaksi.no_order
                                            AND tbl_rinci_transaksi.id_barang = tbl_barang.id_barang
                                            AND tbl_toko.id_toko = tbl_barang.id_toko
                                            AND tbl_toko.id_toko = $id_toko
                                            AND YEAR(tbl_transaksi.tgl_order) = $tahun
                                            ORDER BY tbl_transaksi.id_transaksi DESC")->result();
        $this->load->view('toko/template_toko/header');
        $this->load->view('toko/template_toko/sidebar');
        $this->load->view('toko/v_lap_tahunan', $data);
        $this->load->view('toko/template_toko/footer');
    }
    
}