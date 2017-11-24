<?php

class Model_mentee extends CI_Model
{
    public function __construct() {
        $this->load->database();
        $this->load->library('popo/TbMasterMentee');        
    }

    public function fetch($limit = 99999)
    {
        return $this->db->get('tb_master_mentee', $limit)->custom_result_object('TbMasterMentee');
    }

    public function save(TbMasterMentee $mentee)
    {
        return $this->db->insert('tb_master_mentee', $mentee);
    }
}
