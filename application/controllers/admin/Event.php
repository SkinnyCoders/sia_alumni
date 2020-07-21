<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Event extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        getAuthAdmin();
    }

    public function index()
    {
    	$data = [
            'title' => 'Daftar Event',
            'events' => $this->db->get('event')->result_array()
        ];

    	getViews($data, 'v_admin/v_event');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Event';

    	$this->form_validation->set_rules('nama','Nama Event','required|trim',['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('lokasi','Lokasi','required|trim',['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('tgl','Tanggal','required|trim',['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('waktu','Waktu','required|trim',['required' => '{field} tidak boleh kosong']);
    	$this->form_validation->set_rules('des','Deskripsi','required|trim',['required' => '{field} tidak boleh kosong']);

    	if ($this->form_validation->run() == FALSE) {
    		getViews($data, 'v_admin/v_event_add');
    	}else{

    		if (!empty($_FILES['foto']['name'])) {
    			$file = $this->_uploadFile();
    		}else{
    			$file = 'default-event.jpg';
            }

            //make slug
            $slug = str_replace(' ', '-', $this->input->post('nama'));

            //ubah format tanggal
            $tanggal = DateTime::createFromFormat('m/d/Y', $this->input->post('tgl', true))->format('Y-m-d');

    		$data = [
    			'judul_event' => $this->input->post('nama', true),
    			'gambar_event' => $file,
                'tanggal_event' => $tanggal,
                'lokasi_event' =>  $this->input->post('lokasi', true),
                'waktu_event' => $this->input->post('waktu', true),
    			'deskripsi_event' => $this->input->post('des', true),
                'slug' => $slug,
                'author' => $this->session->userdata('username')
    		];

    		if (insertData('event', $data)) {
    			$this->session->set_flashdata('msg_success', 'Selamat, data berhasil ditambahkan');
                redirect('admin/event');
    		}else{
    			$this->session->set_flashdata('msg_failed', 'Maaf, data gagal ditambahkan');
                redirect('admin/event');
    		}
    	}
    }

    public function update(){
        if (isset($_POST['id_get_update']) && !empty($_POST['id_get_update'])) {
            $dataEvent = $this->db->get_where('event', ['id_event' => $_POST['id_get_update']])->row_array();

            $gambar = 'assets/uploads/file_berita/'.$dataEvent['gambar_event'];
            $tanggal = DateTime::createFromFormat('Y-m-d', $dataEvent['tanggal_event'])->format('m/d/Y');

            $data = [
                'id' => $dataEvent['id_event'],
                'nama' => $dataEvent['judul_event'],
                'lokasi' => $dataEvent['lokasi_event'],
                'deskripsi' => $dataEvent['deskripsi_event'],
                'thumbnail' => base_url($gambar),
                'waktu' => $dataEvent['waktu_event'],
                'tanggal' => $tanggal
            ];

            echo json_encode($data);
        }

        if (isset($_POST['simpan'])) {
            $id_event = $_POST['id'];

            $this->form_validation->set_rules('nama','Nama Event','required|trim',['required' => '{field} tidak boleh kosong']);
            $this->form_validation->set_rules('lokasi','Lokasi','required|trim',['required' => '{field} tidak boleh kosong']);
            $this->form_validation->set_rules('tgl','Tanggal','required|trim',['required' => '{field} tidak boleh kosong']);
            $this->form_validation->set_rules('waktu','Waktu','required|trim',['required' => '{field} tidak boleh kosong']);
            $this->form_validation->set_rules('des','Deskripsi','required|trim',['required' => '{field} tidak boleh kosong']);

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('msg_failed', 'Maaf, data gagal diperbarui');
                redirect('admin/event');
            }else{
                $file_old = $this->db->get_where('event', ['id_event' => $id_event])->row_array();
                $img_old = $file_old['gambar_event'];

                if (!empty($_FILES['foto']['name'])) {
                    $file = $this->_uploadFile();
                    if ($file !== false) {
                        unlink('assets/uploads/file_berita/'.$img_old);
                    }
                }else{
                    $file = $img_old;
                }

                //make slug
                $slug = str_replace(' ', '-', $this->input->post('nama'));

                //ubah format tanggal
                $tanggal = DateTime::createFromFormat('m/d/Y', $this->input->post('tgl', true))->format('Y-m-d');

                $data = [
                    'judul_event' => $this->input->post('nama', true),
                    'gambar_event' => $file,
                    'tanggal_event' => $tanggal,
                    'lokasi_event' =>  $this->input->post('lokasi', true),
                    'waktu_event' => $this->input->post('waktu', true),
                    'deskripsi_event' => $this->input->post('des', true),
                    'slug' => $slug
                ];

                if ($this->db->update('event', $data, ['id_event' => $id_event])) {
                    $this->session->set_flashdata('msg_success', 'Selamat, data berhasil diperbarui');
                    redirect('admin/event');
                }else{
                    $this->session->set_flashdata('msg_failed', 'Maaf, data gagal diperbarui');
                    redirect('admin/event');
                }
            }

        }
    }

    public function delete($id){
    	$file = $this->db->get_where('event', ['id_event' => $id])->row_array();
    	$file = $file['gambar'];
    	$delete = $this->db->delete('event', ['id_event' => $id]);
    	
    	if ($delete) {
    		if (!empty($file)) {
    			unlink('assets/uploads/file_berita/'.$file);
    		}
    		$this->session->set_flashdata('msg_success', 'Selamat, data berhasil dihapus');
    		http_response_code(200);
    	}else{
    		$this->session->set_flashdata('msg_failed', 'Maaf, data gagal dihapus');
    		http_response_code(500);
    	}
    }

    public function rekap(){
        $data['title'] = "Laporan"; 
        $data['event'] = $this->db->get('event')->result_array();
        $this->load->library('pdf');

        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "rekap_event.pdf";
        $this->pdf->load_view('v_admin/v_laporan_event', $data);
    }

    private function _uploadFile()
    {
        $config['upload_path']          = './assets/uploads/file_berita/';
        $config['allowed_types']        = 'jpg|png|pdf|doc|docx';
        $config['encrypt_name']         = TRUE;
        $config['overwrite']            = true;
        $config['max_size']             = 2048; //2mb

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('foto')) {
            return false;
        } else {
            return $this->upload->data('file_name');
        }
    }
}