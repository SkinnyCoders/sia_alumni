<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class M_pengunjung extends CI_Model
{

    public function countvisitor(){
        //whether ip is from the share internet  
         if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
            $ip = $_SERVER['HTTP_CLIENT_IP'];  
            }  
        //whether ip is from the proxy  
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];  
         }  
        //whether ip is from the remote address  
        else{  
            $ip = $_SERVER['REMOTE_ADDR'];  
         }  


        $this->load->library('user_agent');
        $browser =  $this->agent->browser();

        $data = [
            'browser' => $browser,
            'ip' => $ip
        ];

        $cek_ip = $this->db->query("SELECT * FROM `pengunjung` WHERE `ip` = '$ip' AND DATE(`tanggal`) = CURDATE()")->num_rows();
        if($cek_ip <= 0){
            $insert = $this->db->insert('pengunjung', $data);

            return $insert;
        }
    }
}
