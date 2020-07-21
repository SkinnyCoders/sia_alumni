<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class Jurusan extends CI_controller
{
    /**
     * Constructs a new instance.
     */
    function __construct()
    {
        parent::__construct();
        //login cek and authentication
        getAuthAdmin();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Jurusan',
            'jurusan' => $this->db->get('jurusan')->result_array()
        ];

        $this->form_validation->set_rules('jurusan', 'Jurusan', 'required|trim|callback_cekJurusan', ['required' => '{field} tidak boleh kosong', 'cekJurusan' => 'Nama {field} sudah digunakan']);

        if ($this->form_validation->run() == FALSE) {
            getViews($data, 'v_admin/v_jurusan');
        }else{
            $jurusan = strtolower($this->input->post('jurusan', true));

            $data = [
                'nama_jurusan' => $jurusan
            ];

            if ($this->db->insert('jurusan', $data)) {
                $this->session->set_flashdata('msg_success', 'Selamat, data jurusan berhasil ditambahkan');
                redirect('admin/jurusan');
            }else{
                $this->session->set_flashdata('msg_failed', 'Maaf, data jurusan gagal ditambahkan');
                redirect('admin/jurusan');
            }
        }
    }

    public function update(){
        if (isset($_POST['id_get_update']) && !empty($_POST['id_get_update'])) {
            $id_jurusan = $_POST['id_get_update'];

            $data = $this->db->get_where('jurusan', ['id_jurusan' => $id_jurusan])->row_array();

            echo json_encode($data);
        }

        if (isset($_POST['simpan'])) {
            $id_jurusan = $_POST['id_jurusan'];

            $this->form_validation->set_rules('jurusan_update', 'Jurusan', 'required|trim|callback_cekJurusan', ['required' => '{field} tidak boleh kosong', 'cekJurusan' => 'Nama {field} sudah digunakan']);

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('msg_failed', 'Maaf, data jurusan belum berhsil diperbarui');
            }else{
                $jurusan = strtolower($this->input->post('jurusan_update', true));

                $data = [
                    'nama_jurusan' => $jurusan
                ];

                if ($this->db->update('jurusan', $data, ['id_jurusan' => $id_jurusan])) {
                    $this->session->set_flashdata('msg_success', 'Selamat, data jurusan berhasil diperbarui');
                    redirect('admin/jurusan');
                }else{
                    $this->session->set_flashdata('msg_failed', 'Maaf, data jurusan gagal diperbarui');
                    redirect('admin/jurusan');
                }
            }
        }
    }

    public function delete($id){
        if ($this->db->delete('jurusan', ['id_jurusan' => $id])) {
            $this->session->set_flashdata('msg_success', 'Selamat, Data tahun ajaran berhasil dihapus');
            http_response_code(200);
        } else {
            $this->session->set_flashdata('msg_failed', 'Maaf, Data tahun ajaran gagal dihapus');
            http_response_code(404);
        }
    }

    public function cekJurusan($str){
        if ($this->db->get_where('jurusan', ['nama_jurusan' => $str])->num_rows() >= 1) {
            return false;
        }else{
            return true;
        }
    }
}
