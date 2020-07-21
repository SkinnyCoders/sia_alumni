<?php 
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * 
 */
class Lowongan extends CI_controller
{

	public function __construct(){
		parent::__construct();
		$this->load->model('m_alumni');
	}
	
	public function index()
	{
		$data['title'] = 'Lowongan Kerja';
		$data['lowongans'] = $this->m_alumni->getLowongan(date('m'));
		getViews($data, 'v_alumni/v_lowongan');
	}

	public function detail(){
		$slug = $this->uri->segment(4);
		$data['title'] = 'Lowongan Kerja';
		$data['lowongan'] = $this->m_alumni->getLowonganDetail($slug);

		if(!empty($data['lowongan'])){
			getViews($data, 'v_alumni/v_lowongan_detail');
		}else{
			$this->session->set_flashdata('msg_failed', 'Maaf, Detail Lowongan tidak ditemukan');
            redirect('alumni/lowongan');
		}
		
	}
}