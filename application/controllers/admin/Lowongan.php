<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Lowongan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        getAuthAdmin();
    }

    public function index()
    {
    	$data = [
            'title' => 'Daftar Lowongan Pekerjaan',
            'lowongans' => $this->db->get('lowongan')->result_array()
        ];

    	getViews($data, 'v_admin/v_lowongan');
    }

    public function tambah()
    {
    	$data['title'] = 'Tambah Lowongan Pekerjaan';
    	$this->form_validation->set_rules('posisi','Posisi','required|trim',['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('perusahaan','Perusahaan','required|trim',['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('penempatan','Penempatan','required|trim',['required' => '{field} tidak boleh kosong']);
    	$this->form_validation->set_rules('des','Deskripsi','required|trim',['required' => '{field} tidak boleh kosong']);

    	if ($this->form_validation->run() == FALSE) {
    		getViews($data, 'v_admin/v_lowongan_add');
    	}else{

    		if (!empty($_FILES['foto']['name'])) {
    			$file = $this->_uploadFile();
    		}else{
    			$file = 'default-job.jpg';
            }

            //make slug
            $slug = str_replace(' ', '-', $this->input->post('posisi'));
            $slug .= '-';
            $slug .= str_replace(' ', '-', $this->input->post('perusahaan'));

            //ubah format tanggal
            $tanggal = DateTime::createFromFormat('m/d/Y', $this->input->post('tgl_berakhir', true))->format('Y-m-d');

    		$data = [
    			'posisi_pekerjaan' => $this->input->post('posisi', true),
    			'perusahaan' => $this->input->post('perusahaan', true),
                'penempatan' => $this->input->post('penempatan', true),
                'deskripsi' => $this->input->post('des', true),
                'thumbnail' => $file,
    			'berakhir' => $tanggal,
                'author' => $this->session->userdata('username'),
                'slug' => $slug
    		];

    		if (insertData('lowongan', $data)) {
    			$this->session->set_flashdata('msg_success', 'Selamat, data berhasil ditambahkan');
                redirect('admin/lowongan');
    		}else{
    			$this->session->set_flashdata('msg_failed', 'Maaf, data gagal ditambahkan');
                redirect('admin/lowongan');
    		}
    	}
    }

    public function update(){
        if (isset($_POST['id_get_update']) && !empty($_POST['id_get_update'])) {
            $dataLowongan = $this->db->get_where('lowongan', ['id_lowongan' => $_POST['id_get_update']])->row_array();

            $gambar = 'assets/uploads/file_berita/'.$dataLowongan['thumbnail'];
            $berakhir = DateTime::createFromFormat('Y-m-d', $dataLowongan['berakhir'])->format('m/d/Y');

            $data = [
                'id' => $dataLowongan['id_lowongan'],
                'posisi' => $dataLowongan['posisi_pekerjaan'],
                'perusahaan' => $dataLowongan['perusahaan'],
                'deskripsi' => $dataLowongan['deskripsi'],
                'thumbnail' => base_url($gambar),
                'penempatan' => $dataLowongan['penempatan'],
                'berakhir' => $berakhir
            ];

            echo json_encode($data);
        }

        if (isset($_POST['simpan'])) {
            $id_lowongan = $_POST['id'];

            $this->form_validation->set_rules('posisi','Posisi','required|trim',['required' => '{field} tidak boleh kosong']);
            $this->form_validation->set_rules('perusahaan','Perusahaan','required|trim',['required' => '{field} tidak boleh kosong']);
            $this->form_validation->set_rules('penempatan','Penempatan','required|trim',['required' => '{field} tidak boleh kosong']);
            $this->form_validation->set_rules('des','Deskripsi','required|trim',['required' => '{field} tidak boleh kosong']);

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('msg_failed', 'Maaf, data gagal diperbarui');
                redirect('admin/lowongan');
            }else{
                $file_old = $this->db->get_where('lowongan', ['id_lowongan' => $id_lowongan])->row_array();
                $img_old = $file_old['thumbnail'];

                if (!empty($_FILES['foto']['name'])) {
                    $file = $this->_uploadFile();
                    if ($file !== false) {
                        unlink('assets/uploads/file_berita/'.$img_old);
                    }
                }else{
                    $file = $img_old;
                }

                //make slug
                $slug = str_replace(' ', '-', $this->input->post('posisi'));
                $slug .= '-';
                $slug .= str_replace(' ', '-', $this->input->post('perusahaan'));

                //ubah format tanggal
                $tanggal = DateTime::createFromFormat('m/d/Y', $this->input->post('tgl_berakhir', true))->format('Y-m-d');

                $data = [
                    'posisi_pekerjaan' => $this->input->post('posisi', true),
                    'perusahaan' => $this->input->post('perusahaan', true),
                    'penempatan' => $this->input->post('penempatan', true),
                    'deskripsi' => $this->input->post('des', true),
                    'thumbnail' => $file,
                    'berakhir' => $tanggal,
                    'author' => $this->session->userdata('username'),
                    'slug' => $slug
                ];

                if ($this->db->update('lowongan', $data, ['id_lowongan' => $id_lowongan])) {
                    $this->session->set_flashdata('msg_success', 'Selamat, data berhasil diperbarui');
                    redirect('admin/lowongan');
                }else{
                    $this->session->set_flashdata('msg_failed', 'Maaf, data gagal diperbarui');
                    redirect('admin/lowongan');
                }
            }

        }
    }

    public function delete($id){
    	$file = $this->db->get_where('lowongan', ['id_lowongan' => $id])->row_array();
    	$file = $file['thumbnail'];
    	$delete = $this->db->delete('lowongan', ['id_lowongan' => $id]);
    	
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

    private function _uploadFile()
    {
        $config['upload_path']          = './assets/uploads/file_berita/';
        $config['allowed_types']        = 'jpg|png|pdf|doc|docx';
        $config['encrypt_name']         = TRUE;
        $config['overwrite']            = true;
        $config['max_size']             = 2048; //2mb

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('foto')) {
            return $this->upload->display_errors();
        } else {
            return $this->upload->data('file_name');
        }
    }

    public function rekap(){
        $data['title'] = "Laporan"; 
        $data['lowongans'] = $this->db->get_where('lowongan', ['MONTH(create_at)' => date('m')])->result_array();
        $this->load->library('pdf');

        $this->pdf->setPaper('A4', 'potrait');
        $this->pdf->filename = "rekap_Lowongan.pdf";
        $this->pdf->load_view('v_admin/v_laporan_lowongan', $data);
    }

    public function provinsi(){
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "GET",
          CURLOPT_HTTPHEADER => array(
            "key: e6d06e1e8ef5fa5fa2e60bf9bd11a2ca"
          ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          echo $response;
        }
    }
}