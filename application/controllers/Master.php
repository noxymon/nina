<?php
/**
 * Created by PhpStorm.
 * User: noxymon
 * Date: 15/11/17
 * Time: 7:12
 */

class Master extends CI_Controller
{
    public function agenda()
    {
        $this->load->model('model_agenda');
        $listAgenda = new TbMasterAgenda();
        $listAgenda = $this->model_agenda->fetch();

        $resultTable = null;
        foreach ($listAgenda as $agenda) {

            $statusAktif = "Non Aktif";
            $cssStatus = "label-danger";
            if ($agenda->tbma_enable == 1) {
                $statusAktif = "Aktif";
                $cssStatus = "label-success";
            }

            $rowTableResult = "
            <tr>
                <td>$agenda->tbma_nama</td>
                <td>$agenda->tbma_created</td>
                <td>$agenda->tbma_updated</td>
                <td><span class=\"label $cssStatus\">$statusAktif</span></td>
            </tr>";
            $resultTable .= $rowTableResult;            
        }
        
        $dataFragment = array(
            'fragment.title' => 'Master Agenda',
            'data.content' => $resultTable
        );
        $fragmentView = $this->parser->parse('fragment/master/agenda',$dataFragment,true);
        
        $data = array(
            'user.namalengkap'=>$this->session->login_namaLengkap,
            'template.content'=>$fragmentView,
            'template.currentpage' => 'Master Agenda',
            'template.breadcrumbs' => '<li>Master</li> <li class="active">Dashboard</li>'
        );
        $this->parser->parse('main', $data);
    }

    public function materi()
    {
        # code...
    }
}