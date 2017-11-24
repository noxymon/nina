<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sekolah extends CI_Controller
{
    public function index()
    {
        $this->load->model('model_sekolah');
        $listSekolah = new ViewMasterSekolahDetail();
        $listSekolah = $this->model_sekolah->fetch();

        $resultTable = null;
        foreach ($listSekolah as $sekolah) {

            $statusAktif = "Non Aktif";
            $cssStatus = "label-danger";
            if ($sekolah->tbms_enable == 1) {
                $statusAktif = "Aktif";
                $cssStatus = "label-success";
            }

            $rowTableResult = "
            <tr>
                <td>$sekolah->tbms_nama</td>
                <td>$sekolah->tbmts_nama</td>
                <td>$sekolah->tbms_alamat</td>
                <td>$sekolah->tbms_create_date</td>
                <td><span class=\"label $cssStatus\">$statusAktif</span></td>                
            </tr>";
            $resultTable .= $rowTableResult;            
        }
        
        $dataFragment = array(
            'fragment.title' => 'Master Sekolah',
            'data.content' => $resultTable
        );
        $fragmentView = $this->parser->parse('fragment/master/sekolah',$dataFragment,true);
        
        $data = array(
            'user.namalengkap'=>$this->session->login_namaLengkap,
            'template.content'=>$fragmentView,
            'template.currentpage' => 'Master Sekolah',
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

    }

    public function remove($id)
    {
        # code...
    }

    public function form()
    {

    }
}
