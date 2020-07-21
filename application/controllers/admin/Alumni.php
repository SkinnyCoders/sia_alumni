<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Alumni extends CI_controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('m_alumni');
    }

    public function index(){
    	$data = [
            'title' => 'Daftar Alumni',
            'jurusan' => $this->db->get('jurusan')->result_array(),
            'alumnis' => $this->m_alumni->getAllAlumni()
        ];

        getViews($data, 'v_admin/v_daftar_alumni');
    }

    public function tambah(){
        $data = [
            'title' => 'Tambah Alumni',
            'jurusan' => $this->db->get('jurusan')->result_array()
        ];

        //form validation
        $this->form_validation->set_rules('nisn', 'NISN', 'required|trim|numeric|callback_CekNisn', ['required' => '{field} tidak boleh kosong', 'numeric' => '{field} hanya berupa angka', 'CekNisn' => '{field} sudah digunakan']);
        $this->form_validation->set_rules('password', 'Password' , 'required|callback_cekPassword', ['required' => '{field} tidak boleh kosong', 'cekPassword' => '{field} terlalu pendek']);
		$this->form_validation->set_rules('password1', 'Konfirmasi Password', 'required|matches[password]', ['required' => '{field} tidak boleh kosong', 'matches' => '{field} tidak sama']);
        $this->form_validation->set_rules('gender', 'Jenis Kelamin', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim', ['required' => 'Nama tidak boleh kosong']);
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('thn_masuk', 'Tahun Masuk', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('thn_lulus', 'Tahun Lulus', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('kelas', 'Kelas', 'required|trim', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('prodi', 'Prodi', 'required|trim', ['required' => '{field} tidak boleh kosong']);

        if($this->form_validation->run() == FALSE){
            getViews($data, 'v_admin/v_add_alumni');
        }else{
            //convert date format
            $tgl = $this->input->post('tgl_lahir', true);
            $tgl = DateTime::createFromFormat('m/d/Y', $tgl)->format('Y-m-d');

            if (!empty($_FILES['foto']['name'])) {
    			$file = $this->_uploadFile();
    		}else{
    			$file = 'default.png';
    		}

            $data = [
                'nisn' => $this->input->post('nisn', true),
                'nama' => $this->input->post('nama', true),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'jenis_kelamin' => $this->input->post('gender', true),
                'tanggal_lahir' => $tgl,
                'tempat_lahir' => $this->input->post('tempat_lahir', true),
                'tahun_masuk' => $this->input->post('thn_masuk', true),
                'tahun_lulus' => $this->input->post('thn_lulus', true),
                'foto' => $file,
                'id_kelas' => $this->input->post('kelas', true),
                'id_jurusan' => $this->input->post('prodi'),
                'status' => 'aktif'
            ];

            if (insertData('alumni', $data)) {
    			$this->session->set_flashdata('msg_success', 'Selamat, data alumni berhasil ditambahkan');
                redirect('admin/alumni');
    		}else{
    			$this->session->set_flashdata('msg_failed', 'Maaf, data gagal ditambahkan');
                redirect('admin/alumni');
    		}
        }
        
    }

    public function alumni_daftar(){
        $data = $this->m_alumni->getAlumniDaftar();

        echo json_encode($data);
    }

    public function verifikasi(){
        if(isset($_POST['simpan'])){
            $terima = $_POST['terima'];
            $total = count($terima);

            $flag = true;
            foreach ($terima as $t) {
                $nisn = $_POST['nisn' . $t];

                $this->db->set('status', 'aktif');
                $this->db->where('nisn', $nisn);
                $proses = $this->db->update('alumni');

                if($proses){
                    $flag = true;
                }else{
                    $flag = false;
                }
            }

            if ($flag) {
                $this->session->set_flashdata('msg_success', 'Selamt, berhasil melakukan verifikasi alumni');
                redirect('admin/alumni');
            } else {
                $this->session->set_flashdata('msg_failed', 'Maaf, gagal melakukan verifikasi alumni');
                redirect('admin/alumni');
            }
        }elseif(isset($_POST['tolak']) && $_POST['tolak'] == 'true'){
            $terima = $_POST['terima'];
            $total = count($terima);

            $flag = true;
            foreach ($terima as $t) {
                $nisn = $_POST['nisn' . $t];

                $this->db->set('status', 'nonaktif');
                $this->db->where('nisn', $nisn);
                $proses = $this->db->update('alumni');

                if($proses){
                    $flag = true;
                }else{
                    $flag = false;
                }
            }

            if ($flag) {
                $this->session->set_flashdata('msg_success', 'Selamt, berhasil melakukan penolakan alumni');
                redirect('admin/alumni');
            } else {
                $this->session->set_flashdata('msg_failed', 'Maaf, gagal melakukan penolakan alumni');
                redirect('admin/alumni');
            }
        }
    }

    public function detail(){
        if(isset($_POST['nisn']) && !empty($_POST['nisn'])){
            $nisn = $_POST['nisn'];
            $data = $this->m_alumni->getDetailAlumni($nisn);

            if(!empty($data)){
                switch($data['jenis_kelamin']){
                    case 'L' :
                        $gender = 'Laki - Laki';
                    break;

                    case 'P' :
                        $gender = 'Perempuan';
                    break;
                }

                switch($data['status']){
                      case 'bekerja':
                        $status = 'Bekerja';
                      break;
  
                      case 'kuliah':
                        $status = 'Kuliah';
                      break;
  
                      case 'tidak':
                        $status = 'Belum / Tidak Kuliah';
                      break;
  
                      case 'bekerja kuliah':
                        $status = 'Bekerja & Kuliah';
                      break;
                }

                $foto = base_url('assets/img/user/'.$data['foto']);

                $alumni = [
                    'nisn' => $data['nisn'],
                    'nama' => $data['nama'],
                    'jenis_kelamin' => $gender,
                    'agama' => !empty($data['agama'])?$data['agama']:"Belum diisi",
                    'alamat' => !empty($data['alamat'])?$data['alamat']:"Belum diisi",
                    'deskripsi' => !empty($data['deskripsi'])?$data['deskripsi']:"Belum diisi",
                    'email' => !empty($data['email'])?$data['email']:"Belum diisi",
                    'foto' => $foto,
                    'jurusan' => $data['nama_jurusan'],
                    'status' => !empty($data['status'])?$status:"Belum diisi",
                    'telepon' => !empty($data['telepon'])?$data['telepon']:"Belum diisi",
                    'tahun_lulus' => $data['tahun_lulus'],
                    'tahun_masuk' => $data['tahun_masuk'],
                    'tanggal_lahir' => DateTime::createFromFormat('Y-m-d', $data['tanggal_lahir'])->format('d F Y'),
                    'tempat_lahir' => $data['tempat_lahir'],
                    'tentang' => !empty($data['tentang'])?$data['tentang']:"Belum diisi",
                ]; 
            }

            echo json_encode($alumni);
        }
    }

    public function cekPassword($str){
		$cek = strlen($str);
		if ($cek <= 6) {
			return false;
		}else{
			return true;
		}
    }

    public function CekNisn($nisn)
    {
        if ($this->m_alumni->cekNisn($nisn) > 0) {
            return false;
        } else {
            return true;
        }
    }
    
    private function _uploadFile()
    {
        $config['upload_path']          = './assets/img/user/';
        $config['allowed_types']        = 'jpg|png';
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

    public function get_kelas(){
        $id = $_POST['id'];

        $kelas = $this->db->get_where('kelas', ['id_jurusan' => $id])->result_array();

        echo json_encode($kelas);

    }

    public function delete($id){
    	$file = $this->db->get_where('alumni', ['nisn' => $id])->row_array();
    	$file = $file['foto'];
    	$delete = $this->db->delete('alumni', ['nisn' => $id]);
    	
    	if ($delete) {
    		if (!empty($file)) {
    			unlink('assets/img/user/'.$file);
    		}
    		$this->session->set_flashdata('msg_success', 'Selamat, data berhasil dihapus');
    		http_response_code(200);
    	}else{
    		$this->session->set_flashdata('msg_failed', 'Maaf, data gagal dihapus');
    		http_response_code(500);
    	}
    }

    public function rekap(){
        $jurusan = $this->input->post('jurusan');
        if(!empty($jurusan)){
            $nama_jurusan = $this->db->get_where('jurusan', ['id_jurusan' => $jurusan])->row_array();
            $nama_jurusan = $nama_jurusan['nama_jurusan'];
        }
        
        $thn_masuk = $this->input->post('thn_masuk');
        $thn_lulus = $this->input->post('thn_lulus');

        if(!empty($jurusan) && !empty($thn_masuk) && !empty($thn_lulus)){
            //all 
            $data = [
                'header' => 'Semua Jurusan',
                'alumni' => $this->m_alumni->getAlumniAllNotEmpty($jurusan, $thn_lulus, $thn_masuk)
            ];
        }elseif(!empty($jurusan) && !empty($thn_masuk)){
            //jurusan & thn masuk
            $data = [
                'header' => 'Jurusan '.$nama_jurusan.' Tahun Masuk '.$thn_masuk,
                'alumni' => $this->m_alumni->getAlumniJurusanMasuk($jurusan, $thn_masuk)
            ];
        }elseif(!empty($jurusan) && !empty($thn_lulus)){
            //jurusan & thn lulus
            $data = [
                'header' => 'Jurusan '.$nama_jurusan.' Tahun Lulus '.$thn_lulus,
                'alumni' => $this->m_alumni->getAlumniJurusanLulus($jurusan, $thn_lulus)
            ];
        }elseif(!empty($thn_lulus) && !empty($thn_masuk)){
            //thn masuk & thn lulus
            $data = [
                'header' => 'Tahun Masuk '.$thn_masuk.' Tahun Lulus'.$thn_lulus,
                'alumni' => $this->m_alumni->getAlumniLulusMasuk($thn_lulus, $thn_masuk)
            ];
        }elseif(!empty($jurusan)){
            //jurusan
            $data = [
                'header' => 'Jurusan '.$nama_jurusan,
                'alumni' => $this->m_alumni->getAlumniJurusan($jurusan)
            ];
        }elseif(!empty($thn_masuk)){
            //thn masuk
            $data = [
                'header' => 'Tahun Masuk '.$thn_masuk,
                'alumni' => $this->m_alumni->getAlumniLulus($thn_masuk)
            ];
        }elseif(!empty($thn_lulus)){
            //thn lulus
            $data = [
                'header' => 'Tahun Lulus '.$thn_lulus,
                'alumni' => $this->m_alumni->getAlumniMasuk($thn_lulus)
            ];
        }else{
            //kosong semua
            $data = [
                'header' => 'Semua Jurusan, tahun masuk, dan tahun lulus',
                'alumni' => $this->m_alumni->getAllAlumni()
            ];
        }

        $this->load->library('pdf');

        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->filename = "rekap_Lowongan.pdf";
        $this->pdf->load_view('v_admin/v_laporan_alumni', $data);
    }
}

