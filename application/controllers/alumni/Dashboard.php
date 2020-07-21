<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Dashboard extends CI_controller
{
    function __construct()
    {
        parent::__construct();
        //login cek and authentication
        getAuthAlumni();
        $this->load->model('m_alumni');
    }

    public function index()
    {
        $data['title'] = 'Dashboard Alumni';
        $data['total'] = $this->m_alumni->getTotal($this->session->userdata('nisn'));
        getViews($data, 'v_alumni/dashboard');
    }
}