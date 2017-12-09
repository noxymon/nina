<?php

/**
 * @property Model_mentee $model_mentee
 */
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
        $hasil = $this->db->insert('tb_master_mentee', $mentee);
        if (!$hasil) {
            $db_error = $this->db->error();
            throw new Exception('Database error ! Error: ' . $db_error['message']);
            return false; // unreachable retrun statement !!!
        }else{
            return $hasil;
        }
    }

    public function saveKelasMentee(TbTransMenteeKelasDAO $menteeKelasDAO){
        $hasil = $this->db->insert('tb_trans_mentee_kelas', $menteeKelasDAO);
        if (!$hasil) {
            $db_error = $this->db->error();
            throw new Exception('Database error ! Error: ' . $db_error['message']);
            return false; // unreachable retrun statement !!!
        }else{
            return $hasil;
        }
    }

    public function deleteMentee($id){
        $this->db->trans_begin();
        $hasil1 = $this->db->delete('tb_trans_mentee_kelas', array('tmm_id'=>$id));
        $hasil =  $this->db->delete('tb_master_mentee', array('tbmm_id'=>$id));
        if (!$hasil1 || !$hasil) {
            $this->db->trans_rollback();
            $db_error = $this->db->error();
            throw new Exception('Database error ! Error: ' . $db_error['message']);
            return false; // unreachable retrun statement !!!
        }else{
            $this->db->trans_commit();
            return true;
        }
    }
}
