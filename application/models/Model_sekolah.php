<?php

class Model_sekolah extends CI_Model
{
    public function __construct() 
    {
        $this->load->database();        
        $this->load->library('popo/ViewMasterSekolahDetail');                
        $this->load->library('popo/TbMasterKelasDAO');                
    }

    public function fetch($limit = 99999)
    {
        return $this->db->get('view_master_sekolah_detail', $limit)->custom_result_object('ViewMasterSekolahDetail');
    }

    public function save(TbMasterSekolah $sekolah)
    {
        return $this->db->insert('tb_master_sekolah', $sekolah);
    }

    public function fetchById($id)
    {
        return $this->db->get_where('view_master_sekolah_detail', array('tbms_id' => $id), 1)->custom_result_object('ViewMasterSekolahDetail')[0];        
    }

    public function fetchKelasBySekolah($idSekolah)
    {
        return $this->db->get_where('tb_master_kelas', array('tbms_id' => $idSekolah))->custom_result_object('TbMasterKelasDAO');
    }
}
