<?php 
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * 
 */
class Event extends CI_controller
{

	public function __construct(){
		parent::__construct();
		$this->load->model('m_alumni');
	}
	
	public function index()
	{
		$data['title'] = 'Event';
		$data['lowongans'] = $this->m_alumni->getEvent(date('m'));
		getViews($data, 'v_alumni/v_event');
	}

	public function detail(){
		$slug = $this->uri->segment(4);
		$data['title'] = 'Detail Event';
		$data['event'] = $this->m_alumni->getEventDetail($slug);

		if(!empty($data['event'])){
			getViews($data, 'v_alumni/v_event_detail');
		}else{
			$this->session->set_flashdata('msg_failed', 'Maaf, Detail Event tidak ditemukan');
            redirect('alumni/event');
		}
		
	}
}