<?php 
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * 
 */
class Kritik_saran extends CI_controller
{
	
	public function index()
	{
		$data['title'] = 'Kritik & Saran Alumni';
		$data['kritiksaran'] = $this->db->get_where('kritik_saran', ['nisn' => $this->session->userdata('nisn')])->row_array();

		$this->form_validation->set_rules('kritik','Kritik','required|trim', ['required' => '{field} tidak boleh kosong']);
		$this->form_validation->set_rules('saran','Saran','required|trim', ['required' => '{field} tidak boleh kosong']);

		if($this->form_validation->run() == FALSE){
			getViews($data, 'v_alumni/v_kritiksaran');
		}else{
			$data = [
				'nisn' => $this->session->userdata('nisn'),
				'kritik' => $this->input->post('kritik', true),
				'saran' => $this->input->post('saran', true)
			];

			if($this->db->get_where('kritik_saran', ['nisn' => $this->session->userdata('nisn')])->num_rows() > 0){
				//update
				if($this->db->update('kritik_saran', $data, ['nisn' => $this->session->userdata('nisn')])){
					$this->session->set_flashdata('msg_success', 'Selamat, Data Kritik & Saran berhasil diperbarui');
                	redirect('alumni/kritik_saran');
				}else{
					$this->session->set_flashdata('msg_failed', 'Maaf, Data Kritik & Saran gagal diperbarui');
                	redirect('alumni/kritik_saran');
				}
			}else{
				//insert baru
				if(insertData('kritik_saran', $data)){
					$this->session->set_flashdata('msg_success', 'Selamat, Data Kritik & Saran berhasil ditambahkan');
                	redirect('alumni/kritik_saran');
				}else{
					$this->session->set_flashdata('msg_failed', 'Maaf, Data Kritik & Saran gagal ditambahkan');
                	redirect('alumni/kritik_saran');
				}
			}
		}
		
	}
}