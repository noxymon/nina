<?php

class Model_sekolah extends CI_Model
{
    public function __construct() 
    {
        $this->load->database();        
        $this->load->library('popo/ViewMasterSekolahDetail');                
    }

    public function fetch($limit = 99999)
    {
        return $this->db->get('view_master_sekolah_detail', $limit)->custom_result_object('ViewMasterSekolahDetail');
    }

    public function save(TbMasterSekolah $sekolah)
    {
        return $this->db->insert('tb_master_sekolah', $sekolah);
    }
}
