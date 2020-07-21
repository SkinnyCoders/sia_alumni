<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Dashboard extends CI_controller
{
    /**
     * Constructs a new instance.
     */
    function __construct()
    {
        parent::__construct();
        //login cek and authentication
        getAuthAdmin();
        $this->load->model('m_admin');
    }

    public function index()
    {
        $data['title'] = 'Dashboard Admin';
        $data['total'] = $this->m_admin->getTotal();
        getViews($data, 'v_admin/dashboard');
    }

        //chart alumni berdasarkan status
    public function get_dataChart(){

        $total = $this->m_admin->chartStatus();
    
        $data = ['total' => $total];

        echo json_encode($data);
    
    }

    public function get_barChart(){

        $jurusan = $this->db->get('jurusan')->result_array();

        foreach ($jurusan as $jlabel) {
            $label[] = $jlabel['nama_jurusan'];

            //get status berkerja perjurusan
            $berkerja[] = $this->db->query("SELECT * FROM `status_alumni` JOIN alumni ON alumni.nisn=status_alumni.nisn WHERE alumni.id_jurusan = ".$jlabel['id_jurusan']." AND status_alumni.status ='bekerja'")->num_rows();
            $kuliah[] =  $this->db->query("SELECT * FROM `status_alumni` JOIN alumni ON alumni.nisn=status_alumni.nisn WHERE alumni.id_jurusan = ".$jlabel['id_jurusan']." AND status_alumni.status ='kuliah'")->num_rows();
            $nganggur[] =  $this->db->query("SELECT * FROM `status_alumni` JOIN alumni ON alumni.nisn=status_alumni.nisn WHERE alumni.id_jurusan = ".$jlabel['id_jurusan']." AND status_alumni.status ='tidak'")->num_rows();
            $kerja_kuliah[] =  $this->db->query("SELECT * FROM `status_alumni` JOIN alumni ON alumni.nisn=status_alumni.nisn WHERE alumni.id_jurusan = ".$jlabel['id_jurusan']." AND status_alumni.status ='bekerja kuliah'")->num_rows();
        }

        $result = [
            'label' => $label,
            'kerja' => $berkerja,
            'kuliah' => $kuliah,
            'kerja_kuliah' => $kerja_kuliah,
            'tidak' => $nganggur
        ];

        echo json_encode($result);

    }

    public function get_dataChart2(){
        $total = $this->m_admin->getGender();

        $data = ['jumlah' => $total];

        echo json_encode($data);
    }

    public function get_dataChart3(){

        $jurusan = $this->m_admin->chartJurusan();

        foreach ($jurusan as $jtotal) {
            $total = $jtotal['total'];
            $totalJurusan[] = $total;
        }

        foreach ($jurusan as $jlabel) {
            $label[] = $jlabel['nama_jurusan'];
        }

        $dataJurusan = ['jurusan' => $totalJurusan,
                        'nama_jurusan' => $label];
        echo json_encode($dataJurusan);
    }
}
 