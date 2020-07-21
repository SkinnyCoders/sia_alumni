<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Pesan extends CI_controller
{
    /**
     * Constructs a new instance.
     */
    function __construct()
    {
        parent::__construct();
        //login cek and authentication
        getAuthAdmin();
        $this->load->model('m_alumni');
    }

    public function index()
    {
        $data['title'] = 'Pesan Masuk';
        $data['pesan'] = $this->m_alumni->getAllPesanAdmin();
        getViews($data, 'v_admin/v_list_pesan');
    }

    public function set_status(){
        $id = $this->input->post('code');
        if($id == 0){
            //set status diterima
            $data = [
                'status' => 'terima'
            ];
            if($this->db->update('pesan', $data, ['id_pesan' => $this->input->post('id_pesan')])){
                $this->session->set_flashdata('msg_success', 'Selamat, Data Pesan berhasil diubah statusnya');
                http_build_query(200);
            }else{
                $this->session->set_flashdata('msg_failed', 'Maaf, Data Pesan gagal diubah statusnya');
                http_response_code(404);
            }
        }else{
            //set status tolak
            $data = [
                'status' => 'tolak'
            ];
            if($this->db->update('pesan', $data, ['id_pesan' => $this->input->post('id_pesan')])){
                $this->session->set_flashdata('msg_success', 'Selamat, Data Pesan berhasil diubah statusnya');
                http_build_query(200);
            }else{
                $this->session->set_flashdata('msg_failed', 'Maaf, Data Pesan gagal diubah statusnya');
                http_response_code(404);
            }
        }
    }

    public function obrolan_send($id){
        //send obrolan alumni
        $this->form_validation->set_rules('message', 'Pesan Anda', 'required|trim');

        $data = [
            'obrolan_pesan' => $this->input->post('message', true),
            'id_pesan' => $id,
            'pengirim' => 'admin'
        ];

        if($this->db->insert('obrolan_pesan', $data)){
            http_response_code(200);
        }else{
            http_response_code(404);
        }
    }

    public function obrolan_get($id_pesan){
        $data_obrolan = $this->m_alumni->getObrolan($id_pesan);

        foreach($data_obrolan AS $obrolan){
            $tgl = DateTime::createFromFormat('Y-m-d H:i:s', $obrolan['tanggal'])->format('d F Y');
            $jam = DateTime::createFromFormat('Y-m-d H:i:s', $obrolan['tanggal'])->format('H:i');


            switch($obrolan['pengirim']){
                case 'admin' :
                    $class = 'right';
                    $date_class = 'left';
                    
                    $nama = 'Admin';
                    $foto = 'img/user/default.png';
                break;

                case 'alumni' :
                    $class = '';
                    $date_class = 'right';
                    $nama = $obrolan['nama'];
                    if(!empty($obrolan)){
                        $foto = 'img/user/'.$obrolan['foto'];
                    }else{
                        $foto = 'img/user/default.png';
                    }
                    
                break;
            }

            $data[] = '<div class="direct-chat-msg '.$class.'">
                        <div class="direct-chat-infos clearfix">
                        <span class="direct-chat-name float-'.$class.'">'.$nama.'</span>
                        <span class="direct-chat-timestamp float-'.$date_class.'">'.$tgl.' - '.$jam.'</span>
                        </div>
                        <!-- /.direct-chat-infos -->
                        <img class="direct-chat-img" src="../assets/'.$foto.'" alt="Message User Image">
                        <!-- /.direct-chat-img -->
                        <div class="direct-chat-text">
                        '.$obrolan['obrolan_pesan'].'
                        </div>
                        <!-- /.direct-chat-text -->
                    </div>';
        }
        

    echo json_encode($data);
    }

    public function getKritik(){
        if(isset($_POST['id'])){
            $id = $_POST['id'];

            $data = $this->db->query("SELECT kritik_saran.*, alumni.nama FROM `kritik_saran` JOIN alumni ON alumni.nisn=kritik_saran.nisn WHERE `id_kritik_saran` = ".$id)->row_array();

            echo json_encode($data);
        }
    }
}
