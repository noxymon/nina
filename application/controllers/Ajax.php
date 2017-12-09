<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller
{
    public function getClassFromSchool($id)
    {
        $this->load->model('model_sekolah');        
        $kelasBySekolah = new TbMasterKelasDAO();
        $kelasBySekolah = $this->model_sekolah->fetchKelasBySekolah($id);

        echo json_encode($kelasBySekolah);
    }
}