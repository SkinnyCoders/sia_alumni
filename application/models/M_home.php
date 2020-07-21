<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class M_home extends CI_Model
{
    public function getLowongan()
    {
        return $this->db->query("SELECT * FROM `lowongan` ORDER BY `create_at` DESC LIMIT 4")->result_array();
    }

    public function getEvent(){
        return $this->db->query("SELECT * FROM `event` ORDER BY `create_at` DESC LIMIT 4")->result_array();
    }

    public function getLowonganAll(){
        return $this->db->query("SELECT * FROM `lowongan` ORDER BY `create_at` DESC")->result_array();
    }

    public function getEventAll(){
        return $this->db->query("SELECT * FROM `event` ORDER BY `create_at` DESC")->result_array();
    }

    public function getTestimoni(){
        return $this->db->query("SELECT testimoni, alumni.nama, alumni.foto FROM `testimoni` JOIN alumni ON alumni.nisn=testimoni.nisn WHERE is_tampil = 'ya' LIMIT 3")->result_array();
    }

    public function getDetailLowongan($slug){
        return $this->db->get_where('lowongan', ['slug' => $slug])->row_array();
    }

    public function getDetailEvent($slug){
        return $this->db->get_where('event', ['slug' => $slug])->row_array();
    }
}
