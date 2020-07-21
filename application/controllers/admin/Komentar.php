<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Komentar extends CI_controller
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
        $data['title'] = 'Komentar';
        $data['komentar'] = $this->m_alumni->getAllKomentar();
        getViews($data, 'v_admin/v_list_komentar');
    }

    public function delete(){
        $id = $_POST['id'];
        $delete = $this->db->delete('komentar', ['id_komentar'=> $id]);

    	if ($delete) {
    		$this->session->set_flashdata('msg_success', 'Selamat, data berhasil dihapus');
    		http_response_code(200);
    	}else{
    		$this->session->set_flashdata('msg_failed', 'Selamat, data gagal dihapus');
    		http_response_code(404);
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
