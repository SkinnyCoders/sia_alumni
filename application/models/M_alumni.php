<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class M_alumni extends CI_Model
{ 
	public function getTestimoni($nisn){
		return $this->db->get_where('testimoni', ['nisn' => $nisn])->row_array();
	}

	public function updateTestimoni($data, $nisn){
		$this->db->where('nisn', $nisn);
		return $this->db->update('testimoni', $data);
	}

	public function insertTestimoni($data){
		return $this->db->insert('testimoni', $data);
	}

	public function cekNisn($data){
		return $this->db->get_where('alumni', ['nisn' => $data])->num_rows();
	}

	public function getDataDiri($data){
		return $this->db->get_where('alumni', ['nisn' => $data])->row_array();
	}

	public function updateDataDiri($data, $nisn){
		return $this->db->update('alumni', $data, ['nisn' => $nisn]);
	}

	public function getLowongan($bulan){
		return $this->db->get_where('lowongan', ['MONTH(create_at)' => $bulan])->result_array();
	}

	public function getLowonganDetail($slug){
		return $this->db->get_where('lowongan', ['slug' => $slug])->row_array();
	}

	public function getEvent($bulan){
		return $this->db->get_where('event', ['MONTH(tanggal_event) => $bulan'])->result_array();
	}

	public function getEventDetail($slug){
		return $this->db->get_where('event', ['slug' => $slug])->row_array();
	}

	public function getStatus($nisn){
		return $this->db->get_where('status_alumni', ['nisn' => $nisn])->row_array();
	}

	public function updateStatus($data, $nisn){
		$this->db->where('nisn', $nisn);
		return $this->db->update('status_alumni', $data);
	}

	public function insertStatus($data){
		return $this->db->insert('status_alumni', $data);
	}

	public function getAllAlumni(){
		return $this->db->query('SELECT alumni.nisn, alumni.nama, alumni.jenis_kelamin, jurusan.nama_jurusan, status_alumni.status, alumni.telepon, alumni.tanggal_lahir, alumni.tempat_lahir, alumni.tahun_lulus, alumni.tahun_masuk, alumni.foto FROM `alumni` LEFT JOIN jurusan ON jurusan.id_jurusan=alumni.id_jurusan LEFT JOIN status_alumni ON status_alumni.nisn=alumni.nisn WHERE alumni.status = "aktif" ORDER BY alumni.nisn ASC')->result_array();
	}

	public function getAlumniAllNotEmpty($jurusan, $lulus, $masuk){
		return $this->db->query("SELECT alumni.nisn, alumni.nama, alumni.jenis_kelamin, jurusan.nama_jurusan, status_alumni.status, alumni.telepon, alumni.tanggal_lahir, alumni.tempat_lahir, alumni.tahun_lulus, alumni.tahun_masuk FROM `alumni` LEFT JOIN jurusan ON jurusan.id_jurusan=alumni.id_jurusan LEFT JOIN status_alumni ON status_alumni.nisn=alumni.nisn WHERE `tahun_lulus` = $lulus AND `tahun_masuk` = $masuk AND alumni.`id_jurusan` = $jurusan AND alumni.status = 'aktif' ORDER BY alumni.nisn ASC")->result_array();
	}

	public function getAlumniJurusanLulus($jurusan, $lulus){
		return $this->db->query("SELECT alumni.nisn, alumni.nama, alumni.jenis_kelamin, jurusan.nama_jurusan, status_alumni.status, alumni.telepon, alumni.tanggal_lahir, alumni.tempat_lahir, alumni.tahun_lulus, alumni.tahun_masuk FROM `alumni` LEFT JOIN jurusan ON jurusan.id_jurusan=alumni.id_jurusan LEFT JOIN status_alumni ON status_alumni.nisn=alumni.nisn WHERE `tahun_lulus` = $lulus AND alumni.`id_jurusan` = $jurusan AND alumni.status = 'aktif' ORDER BY alumni.nisn ASC")->result_array();
	}

	public function getAlumniJurusanMasuk($jurusan, $masuk){
		return $this->db->query("SELECT alumni.nisn, alumni.nama, alumni.jenis_kelamin, jurusan.nama_jurusan, status_alumni.status, alumni.telepon, alumni.tanggal_lahir, alumni.tempat_lahir, alumni.tahun_lulus, alumni.tahun_masuk FROM `alumni` LEFT JOIN jurusan ON jurusan.id_jurusan=alumni.id_jurusan LEFT JOIN status_alumni ON status_alumni.nisn=alumni.nisn WHERE `tahun_masuk` = $masuk AND alumni.`id_jurusan` = $jurusan AND alumni.status = 'aktif' ORDER BY alumni.nisn ASC")->result_array();
	}

	public function getAlumniLulusMasuk($lulus, $masuk){
		return $this->db->query("SELECT alumni.nisn, alumni.nama, alumni.jenis_kelamin, jurusan.nama_jurusan, status_alumni.status, alumni.telepon, alumni.tanggal_lahir, alumni.tempat_lahir, alumni.tahun_lulus, alumni.tahun_masuk FROM `alumni` LEFT JOIN jurusan ON jurusan.id_jurusan=alumni.id_jurusan LEFT JOIN status_alumni ON status_alumni.nisn=alumni.nisn WHERE `tahun_masuk` = $masuk AND `tahun_lulus` = $lulus AND alumni.status = 'aktif' ORDER BY alumni.nisn ASC")->result_array();
	}

	public function getAlumniJurusan($jurusan){
		return $this->db->query("SELECT alumni.nisn, alumni.nama, alumni.jenis_kelamin, jurusan.nama_jurusan, status_alumni.status, alumni.telepon, alumni.tanggal_lahir, alumni.tempat_lahir, alumni.tahun_lulus, alumni.tahun_masuk FROM `alumni` LEFT JOIN jurusan ON jurusan.id_jurusan=alumni.id_jurusan LEFT JOIN status_alumni ON status_alumni.nisn=alumni.nisn WHERE alumni.`id_jurusan` = $jurusan AND alumni.status = 'aktif' ORDER BY alumni.nisn ASC")->result_array();
	}

	public function getAlumniLulus($lulus){
		return $this->db->query("SELECT alumni.nisn, alumni.nama, alumni.jenis_kelamin, jurusan.nama_jurusan, status_alumni.status, alumni.telepon, alumni.tanggal_lahir, alumni.tempat_lahir, alumni.tahun_lulus, alumni.tahun_masuk FROM `alumni` LEFT JOIN jurusan ON jurusan.id_jurusan=alumni.id_jurusan LEFT JOIN status_alumni ON status_alumni.nisn=alumni.nisn WHERE `tahun_lulus` = $lulus AND alumni.status = 'aktif' ORDER BY alumni.nisn ASC")->result_array();
	}

	public function getAlumniMasuk($masuk){
		return $this->db->query("SELECT alumni.nisn, alumni.nama, alumni.jenis_kelamin, jurusan.nama_jurusan, status_alumni.status, alumni.telepon, alumni.tanggal_lahir, alumni.tempat_lahir, alumni.tahun_lulus, alumni.tahun_masuk FROM `alumni` LEFT JOIN jurusan ON jurusan.id_jurusan=alumni.id_jurusan LEFT JOIN status_alumni ON status_alumni.nisn=alumni.nisn WHERE `tahun_masuk` = $masuk AND alumni.status = 'aktif' ORDER BY alumni.nisn ASC")->result_array();
	}

	public function getDetailAlumni($nisn){
		return $this->db->query("SELECT alumni.*, status_alumni.status, status_alumni.deskripsi, jurusan.nama_jurusan FROM `alumni` JOIN jurusan ON jurusan.id_jurusan=alumni.id_jurusan LEFT JOIN status_alumni ON status_alumni.nisn=alumni.nisn WHERE alumni.nisn = $nisn")->row_array();
	}

	public function getPencarianAlumni($key){
		return $this->db->query("SELECT alumni.nisn, alumni.nama, alumni.jenis_kelamin, jurusan.nama_jurusan, status_alumni.status, alumni.telepon, alumni.tanggal_lahir, alumni.tempat_lahir, alumni.tahun_lulus, alumni.tahun_masuk, alumni.foto FROM `alumni` JOIN jurusan ON jurusan.id_jurusan=alumni.id_jurusan LEFT JOIN status_alumni ON status_alumni.nisn=alumni.nisn WHERE alumni.status = 'aktif' AND (alumni.nama LIKE '%$key%' OR alumni.nisn LIKE '%$key%' OR jurusan.nama_jurusan LIKE '%$key%') ORDER BY alumni.nisn ASC")->result_array();
	}

	public function getAllTestimoni(){
		$this->db->select('testimoni.*, alumni.nama, jurusan.*');
		$this->db->from('testimoni');
		$this->db->join('alumni', 'alumni.nisn=testimoni.nisn');
		$this->db->join('jurusan', 'alumni.id_jurusan=jurusan.id_jurusan');
		return $this->db->get()->result_array();
	}

	public function getAllKritik(){
		$this->db->select('kritik_saran.*, alumni.nama, jurusan.*');
		$this->db->from('kritik_saran');
		$this->db->join('alumni', 'alumni.nisn=kritik_saran.nisn');
		$this->db->join('jurusan', 'alumni.id_jurusan=jurusan.id_jurusan');
		return $this->db->get()->result_array();
	}

	public function getAllKomentar(){
		$this->db->select('*');
		$this->db->from('komentar');
		$this->db->join('kategori_komentar', 'kategori_komentar.id_komentar=komentar.id_komentar');
		return $this->db->get()->result_array();
	}

	public function getAllPesanAlumni($nisn){
		return $this->db->get_where('pesan', ['nisn' => $nisn])->result_array();
	}

	public function getObrolan($id){
		$this->db->select('obrolan_pesan.*, alumni.nama, alumni.foto');
		$this->db->from('obrolan_pesan');
		$this->db->join('pesan', 'pesan.id_pesan=obrolan_pesan.id_pesan');
		$this->db->join('alumni', 'alumni.nisn=pesan.nisn');
		$this->db->where('obrolan_pesan.id_pesan', $id);
		return $this->db->get()->result_array();
	}

	public function getAllPesanAdmin(){
		$this->db->select('pesan.*, alumni.nama, alumni.nisn, jurusan.nama_jurusan');
		$this->db->from('pesan');
		$this->db->join('alumni', 'alumni.nisn=pesan.nisn');
		$this->db->join('jurusan', 'jurusan.id_jurusan=alumni.id_jurusan');
		return $this->db->get()->result_array();
	}

	public function getTotal($nisn){
		$lowongan = $this->db->get("lowongan")->num_rows();
		$event = $this->db->get("event")->num_rows();
		$pesan = $this->db->get_where("pesan", ['nisn' => $nisn])->num_rows();
		return ['lowongan' => $lowongan, 'event' => $event, 'pesan' => $pesan];
	}

	public function getAlumniDaftar(){
		$this->db->select('*');
		$this->db->from('alumni');
		$this->db->where('status', 'menunggu');
		return $this->db->get()->result_array();
	}

}
