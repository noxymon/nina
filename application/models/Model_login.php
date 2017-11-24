<?php
/**
 * Created by PhpStorm.
 * User: noxymon
 * Date: 31/10/17
 * Time: 4:44
 */

/**
* @property     Model_login     Login model
*/
class Model_login extends CI_Model
{

    /**
     * Model_login constructor.
     */
    public function __construct()
    {
        $this->load->database();
    }

    public function validateLogin($username, $password){
        $query = $this->db->get_where('tb_master_user', array('tbmu_status'=>1, 'tbmu_username'=>$username, 'tbmu_password'=> md5($password)))->row();
        if (isset($query)) {
            $this->session->login_namaLengkap = $query->tbmu_nama_lengkap;
            $this->session->login_isLogin = true;
            return true;
        }else{
            return false;
        }
    }
}