<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller Mentee
 * @property Model_mentee $model_mentee
 * @property ArrayUtils $arrayutils
 */
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
                        <li><a href=\"index.php/mentee/remove/$mentee->tbmm_id\"><i class='icon-trash text-danger'></i></a></li>
                    </ul>
                </td>
            </tr>";
            $resultTable .= $rowTableResult;
        }

        $this->displayList($resultTable);
    }

    public function edit($id)
    {
        # code...
    }

    public function save()
    {
        $nama = $this->input->post('nama');
        $telpon = $this->input->post('telpon');
        $email = $this->input->post('email');
        $kelas = $this->input->post('kelas');

        $this->load->model('model_mentee');
        try{
            $this->load->library('popo/TbMasterMentee');

            $mentee = new TbMasterMentee();
            $mentee->tbmm_nama = $nama;
            $mentee->tbmm_telpon = $telpon;
            $mentee->tbmm_email = $email;
            $mentee->tbmm_enabled = 1;
            $this->model_mentee->save($mentee);
            $menteeId = $this->db->insert_id();

            $this->load->library('popo/TbTransMenteeKelasDAO');
            $kelasMentee = new TbTransMenteeKelasDAO();
            $kelasMentee->tmk_id = $kelas;
            $kelasMentee->tmm_id = $menteeId;
            $kelasMentee->tbtmk_status = 1;
            $this->model_mentee->saveKelasMentee($kelasMentee);

            $this->session->set_flashdata('save.result', 'success');
        }catch (Exception $e){
            error_log($e->getMessage());
            $this->session->set_flashdata('save.result', 'error');
        }
        redirect('mentee');
    }

    public function remove($id)
    {
        $this->load->model('model_mentee');
        try{
            $this->model_mentee->deleteMentee($id);
            $this->session->set_flashdata('delete.result', 'success');
        }catch (Exception $e){
            error_log($e->getMessage());
            $this->session->set_flashdata('delete.result', 'error');
        }
        redirect('mentee');
    }

    public function form()
    {
        $this->load->model('model_sekolah');
        $listSekolah = new ViewMasterSekolahDetail();
        $listSekolah = $this->model_sekolah->fetch();

        $cboSekolah = null;
        foreach ($listSekolah as $sekolah) {
            $_cboSekolah = "<option value='$sekolah->tbms_id'>$sekolah->tbms_nama</option>";
            $cboSekolah .= $_cboSekolah;
        }

        $this->displayForm($cboSekolah);
    }

    private function displayForm($sekolahList){
        $dataFragment = array(
            'fragment.title' => 'Register New Mentee',
            'mentee.sekolah' => $sekolahList
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

    private function displayList($dataContent){

        /*
         * TODO : Try to use 3 dimension array of flashdata
         */
        $isSuccess = $this->session->flashdata('save.result');
        $isDeleteSucess = $this->session->flashdata('delete.result');
        $hook = null;
        if($isSuccess === 'success'){
            $hook = "
                new PNotify({
                    title: 'Notification : Success !',
                    text: 'Data saved !',
                    icon: 'icon-checkmark3',
                    type: 'success'
                });";
        }else if($isSuccess === 'error'){
            $hook = "
                new PNotify({
                    title: 'Notification : Failed :(',
                    text: 'Data NOT saved !',
                    icon: 'icon-blocked',
                    type: 'danger'
                });";
        }

        if($isDeleteSucess === 'success'){
            $hook = "
                new PNotify({
                    title: 'Notification : Success !',
                    text: 'Delete success !',
                    icon: 'icon-checkmark3',
                    type: 'success'
                });";
        }else if($isDeleteSucess === 'error'){
            $hook = "
                new PNotify({
                    title: 'Notification : Failed :(',
                    text: 'Delete failed :(',
                    icon: 'icon-blocked',
                    type: 'danger'
                });";
        }

        $dataFragment = array(
            'fragment.title' => 'Master Mentee',
            'data.content' => $dataContent,
            'hook.finishload' => $hook
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
}
