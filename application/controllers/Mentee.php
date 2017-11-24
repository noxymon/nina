<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mentee extends CI_Controller
{
    public function index()
    {
        $this->load->model('model_mentee');
        $listMentee = new TbMasterMentee();
        $listMentee = $this->model_mentee->fetch();

        $resultTable = null;
        foreach ($listMentee as $mentee) {

            $statusAktif = "Non Aktif";
            $cssStatus = "label-danger";
            if ($mentee->tbmm_enabled == 1) {
                $statusAktif = "Aktif";
                $cssStatus = "label-success";
            }

            $rowTableResult = "
            <tr>
                <td>$mentee->tbmm_nama</td>
                <td>$mentee->tbmm_created</td>
                <td>$mentee->tbmm_telpon</td>
                <td>$mentee->tbmm_email</td>
                <td class='text-center'>
                    <ul class='icons-list icons-list-extended'>
                        <li class='pull-left'><a href='#'><i class='icon-pencil7 text-warning'></i></a></li>
                        <li><a href='#'><i class='icon-trash text-danger'></i></a></li>
                    </ul>
                </td>
            </tr>";
            $resultTable .= $rowTableResult;            
        }
        
        $dataFragment = array(
            'fragment.title' => 'Master Mentee',
            'data.content' => $resultTable
        );
        $fragmentView = $this->parser->parse('fragment/master/mentee',$dataFragment,true);
        
        $data = array(
            'user.namalengkap'=>$this->session->login_namaLengkap,
            'template.content'=>$fragmentView,
            'template.currentpage' => 'Master Mentee',
            'template.breadcrumbs' => '<li>Master</li> <li class="active">Dashboard</li>'
        );
        $this->parser->parse('main', $data);
    }

    public function edit($id)
    {
        # code...
    }

    public function save()
    {
        $this->load->model('model_mentee');
    }

    public function remove($id)
    {
        # code...
    }

    public function form()
    {
        $dataFragment = array(
            'fragment.title' => 'Register New Mentee',
            'data.content' => ''
        );
        $fragmentView = $this->parser->parse('fragment/master/form/mentee',$dataFragment,true);
        
        $data = array(
            'user.namalengkap'=>$this->session->login_namaLengkap,
            'template.content'=>$fragmentView,
            'template.currentpage' => 'Master Mentee',
            'template.breadcrumbs' => '<li>Master</li> <li class="active">Dashboard</li>'
        );
        $this->parser->parse('main', $data);
    }
}
