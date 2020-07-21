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
        getAuthAlumni();
        $this->load->model('m_alumni');
        $this->load->library('parser');
    }

    public function index()
    {
        $data['title'] = 'Pesan Masuk';
        $data['pesan'] = $this->m_alumni->getAllPesanAlumni($this->session->userdata('nisn'));
        getViews($data, 'v_alumni/v_list_pesan');
    }

    public function tambah(){
        $this->form_validation->set_rules('subjek', 'Subjek Pesan', 'required|trim', ['required' => '{field} tidak boleh kosong!']);
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required|trim', ['required' => '{field} tidak boleh kosong!']);

        if($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('msg_failed', 'Maaf, Gagal membuat pesan baru!');
            redirect('alumni/pesan');
        }else{
            $data = [
                'nisn' => $this->session->userdata('nisn'),
                'subjek' => $this->input->post('subjek', true),
                'keterangan' => $this->input->post('keterangan', true)
            ];

            if($this->db->insert('pesan', $data)){
                $this->session->set_flashdata('msg_success', 'Selamat, Pesan berhasil dibuat');
                redirect('alumni/pesan');
            }else{
                $this->session->set_flashdata('msg_failed', 'Maaf, Gagal membuat pesan baru!');
                redirect('alumni/pesan');
            }
        }
    }

    public function obrolan_send($id){
        //send obrolan alumni
        $this->form_validation->set_rules('message', 'Pesan Anda', 'required|trim');

        $data = [
            'obrolan_pesan' => $this->input->post('message', true),
            'id_pesan' => $id,
            'pengirim' => 'alumni'
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
                    $class = '';
                    $date_class = 'right';
                    $nama = 'Admin';
                    $foto = 'img/user/default.png';
                break;

                case 'alumni' :
                    $class = 'right';
                    $date_class = 'left';
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

    public function delete($id){
        if ($this->db->delete('pesan', ['id_pesan' => $id])) {
            $this->session->set_flashdata('msg_success', 'Selamat, Data Pesan berhasil dihapus');
            http_response_code(200);
        } else {
            $this->session->set_flashdata('msg_failed', 'Maaf, Data Pesan gagal dihapus');
            http_response_code(404);
        }
    }

    public function error($id){
        switch($id){
            case '1' :
                $this->session->set_flashdata('msg_failed', 'Maaf, pesan anda belum disetujui oleh admin');
                http_response_code(500);
            break;
            case '2' :
                $this->session->set_flashdata('msg_failed', 'Maaf, pesan anda tidak disetujui oleh admin');
                http_response_code(500);
            break;
        }
    }

    public function getKritik(){
        if(isset($_POST['id'])){
            $id = $_POST['id'];

            $data = $this->db->query("SELECT kritik_saran.*, alumni.nama FROM `kritik_saran` JOIN alumni ON alumni.nisn=kritik_saran.nisn WHERE `id_kritik_saran` = ".$id)->row_array();

            echo json_encode($data);
        }
    }
}
