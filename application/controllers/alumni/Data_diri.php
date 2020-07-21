<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Data_diri extends CI_controller
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
        //prepare the data
    	$data['title'] = 'Data Diri Alumni';
        $nisn = $this->session->userdata('nisn');
        $data['data_diri'] = $this->m_alumni->getDataDiri($nisn);
        $data['jurusan'] = $this->db->get('jurusan')->result_array();
        $data['kelas'] = $this->db->get('kelas')->result_array();
        $data['nisn'] = $nisn;
        
        //validation
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim', ['required' => 'Nama tidak boleh kosong']);
        $this->form_validation->set_rules('nisn', 'NISN', 'required|trim|numeric', ['required' => '{field} tidak boleh kosong', 'numeric' => 'NISN harus berupa angka', 'CekNisn' => '{field} sudah digunakan']);
        $this->form_validation->set_rules('telp', 'No Telp', 'numeric|trim', ['numeric' => '{field} harus berupa angka']);
        $this->form_validation->set_rules('agama', 'Agama', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('thn_masuk', 'Tahun Masuk', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('thn_lulus', 'Tahun Lulus', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('kelas', 'Kelas', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('prodi', 'Prodi', 'required|trim', ['required' => '{field} tidak boleh kosong']);

        if ($this->form_validation->run() == false) {
            getViews($data, 'v_alumni/v_data_diri');
        }else{
            $tgl = $this->input->post('tgl_lahir', true);
            $tgl = DateTime::createFromFormat('m/d/Y', $tgl)->format('Y-m-d');

            $data = [
                'nisn' => $this->input->post('nisn', true),
                'nama' => $this->input->post('nama', true),
                'alamat' => $this->input->post('alamat', true),
                'jenis_kelamin' => $this->input->post('gender', true),
                'tanggal_lahir' => $tgl,
                'tempat_lahir' => $this->input->post('tempat_lahir', true),
                'agama' => $this->input->post('agama', true),
                'telepon' => $this->input->post('telp', true),
                'tahun_masuk' => $this->input->post('thn_masuk', true),
                'tahun_lulus' => $this->input->post('thn_lulus', true),
                'tentang' => $this->input->post('tentang', true),
                'id_kelas' => $this->input->post('kelas', true),
                'id_jurusan' => $this->input->post('prodi')
            ];

            if ($this->m_alumni->updateDataDiri($data, $nisn)) {
                $this->session->set_flashdata('msg_success', 'Selamat, Data berhasil diperbarui');
                redirect('alumni/data_diri');
            }else{
                $this->session->set_flashdata('msg_failed', 'Maaf, data Penghargaan gagal diperbarui');
                redirect('alumni/data_diri');
            }
        }

    }

    public function get_kelas(){
        $id = $_POST['id'];

        $kelas = $this->db->get_where('kelas', ['id_jurusan' => $id])->result_array();

        echo json_encode($kelas);

    }

    public function get_kelas_jurusan(){
        $id = $this->session->userdata('nisn');

        $kelas = $this->db->get_where('alumni', ['nisn' => $id])->row_array();

        echo json_encode($kelas);
    }

    public function CekNisn($nisn)
    {
        if ($this->m_alumni->cekNisn($nisn) > 0) {
            return false;
        } else {
            return true;
        }
    }
}