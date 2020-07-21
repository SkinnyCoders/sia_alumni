<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Kritik_saran extends CI_controller
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
        $data['title'] = 'Kritik & Saran';
        $data['kritiks'] = $this->m_alumni->getAllKritik();
        getViews($data, 'v_admin/v_kritik_saran');
    }

    public function getKritik(){
        if(isset($_POST['id'])){
            $id = $_POST['id'];

            $data = $this->db->query("SELECT kritik_saran.*, alumni.nama FROM `kritik_saran` JOIN alumni ON alumni.nisn=kritik_saran.nisn WHERE `id_kritik_saran` = ".$id)->row_array();

            echo json_encode($data);
        }
    }
}
