<?php 
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * 
 */
class Testimoni extends CI_controller
{

	public function __construct(){
        parent::__construct();
        getAuthAdmin();
		$this->load->model('m_alumni');
	}
	
	public function index()
	{
        $data['title'] = 'Testimoni Alumni';
        $data['testimonis'] = $this->m_alumni->getAllTestimoni();
        getViews($data, 'v_admin/v_testimoni');
    }

    public function getTestimoni(){
        if(isset($_POST['id_testimoni'])){
            $id = $_POST['id_testimoni'];

            $data = $this->db->query('SELECT alumni.nama, testimoni.* FROM `testimoni` JOIN alumni ON alumni.nisn=testimoni.nisn WHERE `id_testimoni` = '.$id)->row_array();

            echo json_encode($data);
        }
    }

    public function update(){
        $id = $_POST['id'];

        if(isset($id) && !empty($id)){
            $data = [
                'is_tampil' => $this->input->post('publish', true)
            ];

            if($this->db->update('testimoni', $data, ['id_testimoni' => $id])){
                $this->session->set_flashdata('msg_success', 'Selamat, data berhasil diperbarui');
                redirect('admin/testimoni');
            }else{
                $this->session->set_flashdata('msg_failed', 'Maaf, data gagal diperbarui');
                    redirect('admin/testimoni');
            }
        }
    }
}