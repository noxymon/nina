<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller
{
    public function index()
    {
        if($this->session->login_isLogin){
            $data = array(
                'user.namalengkap'=>$this->session->login_namaLengkap,
                'template.content'=>$this->load->view('fragment/dashboard','',true),
                'template.currentpage' => 'Dashboard',
                'template.breadcrumbs' => '<li class="active">Dashboard</li>'
            );
            $this->parser->parse('main', $data);
        }else{
            $this->load->view('login');
        }
    }
}