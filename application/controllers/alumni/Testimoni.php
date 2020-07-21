<?php 
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * 
 */
class Testimoni extends CI_controller
{

	public function __construct(){
		parent::__construct();
		$this->load->model('m_alumni');
	}
	
	public function index()
	{
		$nisn = $this->session->userdata('nisn');
		$data['title'] = 'Testimoni Alumni';
		$data['testimoni'] = $this->m_alumni->getTestimoni($nisn);


		$this->form_validation->set_rules('testimoni', 'Testimoni', 'required|trim', ['required' => '{field} tidak boleh kosong!']);

		if ($this->form_validation->run() == FALSE) {
			getViews($data , 'v_alumni/v_testimoni');
		}else{
			$data = [
				'nisn' => $nisn,
				'testimoni' => $this->input->post('testimoni', true)
			];

			if(!empty($this->m_alumni->getTestimoni($nisn))){
				if ($this->m_alumni->updateTestimoni($data, $nisn)) {
					$this->session->set_flashdata('msg_success', 'Selamat, Data Testimoni berhasil diperbarui');
                	redirect('alumni/testimoni');
				}else{
					$this->session->set_flashdata('msg_failed', 'Maaf, Data Testimoni gagal diperbarui');
                	redirect('alumni/testimoni');
				}
			}else{
				if ($this->m_alumni->insertTestimoni($data)) {
					$this->session->set_flashdata('msg_success', 'Selamat, Data Testimoni berhasil ditambahkan');
                	redirect('alumni/testimoni');
				}else{
					$this->session->set_flashdata('msg_failed', 'Maaf, Data Testimoni gagal ditambahkan');
                	redirect('alumni/testimoni');
				}
			}
		}
	}
}