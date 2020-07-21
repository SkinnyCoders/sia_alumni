<?php 
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * 
 */
class Semua extends CI_controller
{

	public function __construct(){
		parent::__construct();
		$this->load->model('m_alumni');
	}
	
	public function index()
	{
        $data['title'] = 'Daftar Alumni';
        
        if(isset($_POST['cari']) && !empty($_POST['cari'])){
            $data['alumnis'] = $this->m_alumni->getPencarianAlumni($_POST['cari']);
        }else if(isset($_POST['cari']) && empty($_POST['cari'])){
            $data['alumnis'] = $this->m_alumni->getAllAlumni();
        }

		getViews($data, 'v_alumni/v_daftar_alumni');
    }
}