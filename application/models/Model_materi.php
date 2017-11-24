<?php

/**
 * @property Model_materi Materi Model
 */

 class Model_materi extends CI_Model
 {
     public function __construct() {
         $this->load->database();
         $this->load->library('popo/ViewMasterMateriLevel');         
     }

     public function fetch($limit = 99999)
     {
        return $this->db->get('view_master_materi_level', $limit)->custom_result_object('ViewMasterMateriLevel');
    }
 }