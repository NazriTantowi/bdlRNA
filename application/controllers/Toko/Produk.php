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
    
    public function add()
    {
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required', array('required' => '%s Harus diisi!'));
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required', array('required' => '%s Harus diisi!'));
        $this->form_validation->set_rules('harga', 'Harga', 'required', array('required' => '%s Harus diisi!'));
        $this->form_validation->set_rules('berat', 'Berat', 'required', array('required' => '%s Harus diisi!'));
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required', array('required' => '%s Harus diisi!'));
        $this->form_validation->set_rules('stok', 'Stok', 'required', array('required' => '%s Harus diisi!'));
        $data['toko'] = $this->db->get_where('tbl_toko', ['email' => $this->session->userdata('email')])->row_array();

        if ($this->form_validation->run() == TRUE) {
            $config['upload_path'] = './assets/gambar/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|ico|jfif';
            $config['max_size']     = '2000';
            $this->upload->initialize($config);
            $field_name = "gambar";
            if (!$this->upload->do_upload($field_name)) {
                $data = array(
                    'title' => 'Add barang',
                    'kategori' => $this->m_kategori->get_all_data(),
                    'error_upload' => $this->upload->display_errors(),
                    'isi' => 'toko/v_add',
                );
            } else {
                $upload_data = array('uploads'=> $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/gambar/' . $upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);
                $data = array(
                    'nama_barang' => $this->input->post('nama_barang'),
                    'id_kategori' => $this->input->post('id_kategori'),
                    'id_toko' => $data['toko']['id_toko'],
                    'harga' => $this->input->post('harga'),
                    'berat' => $this->input->post('berat'),
                    'stok' => $this->input->post('stok'),
                    'deskripsi' => $this->input->post('deskripsi'),
                    'gambar' => $upload_data['uploads']['file_name'],
                );
                $this->m_barang->add($data);
                $this->session->set_flashdata('pesan', 'Data Berhasil Ditambahkan !');
                redirect('toko/produk');
            }

        }
        
        
        $data['kategori'] = $this->m_kategori->get_all_data();
        $this->load->view('toko/template_toko/header', $data);
        $this->load->view('toko/template_toko/sidebar', $data);
        $this->load->view('toko/v_add', $data);
        $this->load->view('toko/template_toko/footer', $data);
    }

    //Update one item
    public function edit( $id_barang = NULL )
    {
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required', array('required' => '%s Harus diisi !'));
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required', array('required' => '%s Harus diisi !'));
        $this->form_validation->set_rules('harga', 'Harga', 'required', array('required' => '%s Harus diisi !'));
        $this->form_validation->set_rules('berat', 'Berat', 'required', array('required' => '%s Harus diisi !'));
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required', array('required' => '%s Harus diisi !'));

        if ($this->form_validation->run() == TRUE) {
            $config['upload_path'] = './assets/gambar/';
            $config['allowed_types'] = 'gif|jpg|png|jpeg|ico|jfif';
            $config['max_size']     = '2000';
            $this->upload->initialize($config);
            $field_name = "gambar";
            if (!$this->upload->do_upload($field_name)) {
                $data = array(
                    'kategori' => $this->m_kategori->get_all_data(),
                    'barang' => $this->m_barang->get_data($id_barang),
                    'error_upload' => $this->upload->display_errors(),
                );
                $this->load->view('toko/template_toko/header', $data);
                $this->load->view('toko/template_toko/sidebar', $data);
                $this->load->view('toko/v_edit_produk', $data);
                $this->load->view('toko/template_toko/footer', $data);
            } else {
                 //hapus gambar
                 $barang = $this->m_barang->get_data($id_barang);
                 if ($barang->gambar !="") {
                    unlink('./assets/gambar/' . $barang->gambar);
                }

                $upload_data = array('uploads'=> $this->upload->data());
                $config['image_library'] = 'gd2';
                $config['source_image'] = './assets/gambar/' . $upload_data['uploads']['file_name'];
                $this->load->library('image_lib', $config);
                $data = array(
                    'id_barang' => $id_barang,
                    'nama_barang' => $this->input->post('nama_barang'),
                    'id_kategori' => $this->input->post('id_kategori'),
                    'harga' => $this->input->post('harga'),
                    'berat' => $this->input->post('berat'),
                    'deskripsi' => $this->input->post('deskripsi'),
                    'gambar' => $upload_data['uploads']['file_name'],
                );
                $this->m_barang->edit($data);
                $this->session->set_flashdata('pesan', 'Data Berhasil Diedit !');
                redirect('toko/produk');
            }
            //jika tanpa ganti gambar
            $data = array(
                'id_barang' => $id_barang,
                'nama_barang' => $this->input->post('nama_barang'),
                'id_kategori' => $this->input->post('id_kategori'),
                'harga' => $this->input->post('harga'),
                'berat' => $this->input->post('berat'),
                'deskripsi' => $this->input->post('deskripsi'),
            );
            $this->m_barang->edit($data);
            $this->session->set_flashdata('pesan', 'Data Berhasil Diedit !');
            redirect('toko/produk');

        }
        
        $data = array(
            'title' => 'Edit Barang',
            'kategori' => $this->m_kategori->get_all_data(),
            'barang' => $this->m_barang->get_data($id_barang),
            'isi' => 'toko/v_edit_produk',
        );
        $this->load->view('toko/template_toko/header', $data);
        $this->load->view('toko/template_toko/sidebar', $data);
        $this->load->view('toko/v_edit_produk', $data);
        $this->load->view('toko/template_toko/footer', $data);
    }

    //Delete one item
    public function delete( $id_barang = NULL )
    {
        //hapus gambar
        $barang = $this->m_barang->get_data($id_barang);
        if ($barang->gambar !="") {
            unlink('./assets/gambar/' . $barang->gambar);
        }

        $data = array('id_barang' => $id_barang);
        $this->m_barang->delete($data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus !');
        
        redirect('toko/produk');
    }
}