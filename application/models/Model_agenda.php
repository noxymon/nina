<?php

/**
* @property     model_agenda     Agenda Model
*/
class Model_agenda extends CI_Model
{
    public function __construct() {
        $this->load->database();
        $this->load->library('popo/TbMasterAgenda');
    }

    public function fetch($limit = 99999)
    {
        return $this->db->get('tb_master_agenda', $limit)->custom_result_object('TbMasterAgenda');
    }
}
