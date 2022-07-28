<?Php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_pelanggan extends CI_Model 
{
    public function register($data)
    {
        $this->db->insert('tbl_pelanggan', $data);
    }

    public function register_toko($data)
    {
        $this->db->insert('tbl_toko', $data);
    }
}