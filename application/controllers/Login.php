<?php
/**
 * Created by PhpStorm.
 * User: noxymon
 * Date: 31/10/17
 * Time: 4:36
 */

class Login extends CI_Controller
{
    public function index()
    {
        if($this->session->login_isLogin){
            redirect('/main');
        }else{
            $this->load->view('login');
        }
    }

    public function validateLogin()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $this->load->model('Model_login');
        $isCorrect = $this->Model_login->validateLogin($username, $password);

        if ($isCorrect) {
            redirect('/main');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('/');
    }
}