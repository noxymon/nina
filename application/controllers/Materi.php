<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Materi extends CI_Controller
{
    public function index()
    {
        $this->load->model('model_materi');
        $materi = $this->model_materi->fetch();
    }
}