<?Php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_toko extends CI_Model 
{
    public function get_all_data()
    {
        $this->db->select('*');
        $this->db->from('tbl_toko');
        $this->db->order_by('id_toko', 'desc');
        return $this->db->get()->result();
        
    }
}