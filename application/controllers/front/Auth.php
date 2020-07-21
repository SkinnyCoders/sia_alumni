<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Auth extends CI_controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('m_auth');
    }

    public function login()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|trim', ['required' => 'Maaf, Email belum diisi!']);
        $this->form_validation->set_rules('password', 'Password', 'required', ['required' => 'Maaf, Password belum diisi!']);

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('v_home/v_home');
        } else {
            $user = $this->m_auth->cekUserAlmuni($this->input->post('email', TRUE));
            
            if (!empty($user)) {
                if (password_verify($this->input->post('password'), $user['password'])) {
                    $data = [
                        'is_login' => 'punten',
                        'nama' => $user['nama'],
                        'nama_role' => 'Alumni',
                        'foto' => $user['foto'],
                        'role' => 2,
                        'nisn' => $user['nisn']
                    ];

                    $this->session->set_userdata($data);
                    $this->session->set_flashdata('msg_success', 'Selamat, Anda berhasil login');
                    redirect('/');
                } else {
                    $this->session->set_flashdata('msg_failed', 'Ups!, Password anda salah!');
                    redirect('/');
                }
            } else {
                $this->session->set_flashdata('msg_failed', 'Ups!, Akun anda belum terdaftar!');
                redirect('/');
            }
        }
    }

    public function registrasi(){
        $this->form_validation->set_rules('nama', 'Nama', 'required', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('nisn', 'NISN', 'required|numeric', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('gender', 'Jenis Kelamin', 'required', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('email', 'Alamat Email', 'required', ['required' => '{field} tidak boleh kosong']);
        $this->form_validation->set_rules('password', 'Password' , 'required|callback_cekPassword', ['required' => '{field} tidak boleh kosong', 'cekPassword' => '{field} terlalu pendek']);
        $this->form_validation->set_rules('password1', 'Konfirmasi Password', 'required|matches[password]', ['required' => '{field} tidak boleh kosong', 'matches' => '{field} tidak sama']);

        if($this->cekEmail($this->input->post('email')) == false){
            $this->session->set_flashdata('msg_failed', 'Maaf, Email sudah digunakan');
            redirect('/');
        }

        if($this->cekNisn($this->input->post('nisn')) == false){
            $this->session->set_flashdata('msg_failed', 'Maaf, NISN sudah digunakan');
            redirect('/');
        }

        if($this->form_validation->run() == FALSE){
            $this->session->set_flashdata('msg_failed', 'Maaf, Registrasi Gagal');
            redirect('/');
        }else{
            $data = [
                'nisn' => $this->input->post('nisn'),
                'nama' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'jenis_kelamin' => $this->input->post('gender'),
                'foto' => 'default.png'
            ];

            if($this->db->insert('alumni', $data)){
                $this->session->set_flashdata('msg_success', 'Selamat,Registrasi berhasil, silahkan tunggu akun anda kami verifikasi');
                redirect('/');
            }else{
                $this->session->set_flashdata('msg_failed', 'Maaf, Registrasi Gagal');
                redirect('/');
            }

        }
    }

    public function logout()
    {
        $this->session->unset_userdata('is_login');
        $this->session->unset_userdata('nama');
        $this->session->unset_userdata('foto');
        $this->session->unset_userdata('nama_role');
        $this->session->unset_userdata('nisn');
        $this->session->set_flashdata('msg_success', 'Selamat, Anda berhasil logut');
        redirect('/');
    }

    public function logout_peserta()
    {

        //update login status
            $this->session->unset_userdata('is_login');
            $this->session->unset_userdata('nama');
            $this->session->set_flashdata('msg_success', 'Selamat, Anda berhasil logut');
            redirect('?p=login');
    }


    public function cekEmail($str){
		$cek = $this->db->get_where('alumni', ['email' => $str])->num_rows();

		if ($cek > 0) {
			return false;
		}else{
			return true;
		}
    }
    
    public function cekNisn($str){
		$cek = $this->db->get_where('alumni', ['nisn' => $str])->num_rows();

		if ($cek > 0) {
			return false;
		}else{
			return true;
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
}
