<?php

class Berlian extends CI_Controller
{
    public function generate()
    {
        if(is_cli()){
            $this->load->model('model_berlian');
            $tableIncludeStr = "tb_trans_mentee_kelas";
            $tableIncludeArray = explode(",", $tableIncludeStr);
            foreach ($tableIncludeArray as $key => $tbl) {
                if($tbl != null){
                    echo "processing Table : ".$tbl." \n";
                    $this->model_berlian->generate($tbl);    
                }
            }    
        }else{
            echo "ERROR : Only work if run via cmd !";
        }
    }

    public function clean()
    {
        if (is_cli()) {
            delete_files('./application/generated/dao/');
            delete_files('./application/generated/manager/');
        } else {
            echo "ERROR : Only work if run via cmd !";            
        }
        
    }
}