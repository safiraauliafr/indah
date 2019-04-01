<?php

    if (!defined('BASEPATH'))exit('No direct script access allowed');

    class Pekerjaan_model extends CI_Model
    {
        
        function __construct()
        {
             parent::__construct();
        }        
    

    function ambil_pekerjaan(){
        $this->db->order_by("pekerjaan_id","asc"); 
        return $this->db->get('tbl_pekerjaan')->result();
    }      
    function hapus_pekerjaan($pekerjaan_id,$table){
    $this->db->where('pekerjaan_id' , $pekerjaan_id);
    $this->db->delete($table);
    }
    public function tambah_pekerjaan($table,$data){
        $this->db->insert($table,$data);
    }
    public function ambil_pekerjaan_id($pekerjaan_id)
    {
        $this->db->select("*");
        $this->db->from('tbl_pekerjaan');
        $this->db->where('pekerjaan_id',$pekerjaan_id);
        $query = $this->db->get();

        return $query->row();
    }
     public function ambil_pekerjaan_by_name($nama_pekerja , $status)
    {
        $this->db->select("*");
        $this->db->from('tbl_pekerjaan');
        $this->db->where('nama_pekerja',$nama_pekerja);
        $this->db->where('status',$status);
        $this->db->order_by("pekerjaan_id","asc");
        $query = $this->db->get();

        return $query->result();
    }
       public function ambil_pekerjaan_by_status($status)
    {
        $this->db->select("*");
        $this->db->from('tbl_pekerjaan');
        $this->db->where('status',$status);
        $this->db->order_by("pekerjaan_id","desc");
        $query = $this->db->get();

        return $query->result();
    }

    public function update_pekerjaan($where, $data)
    {
        $this->db->update('tbl_pekerjaan', $data, $where);
        return $this->db->affected_rows();

    }
    public function ambil_deadline_pekerjaan(){
         $this->db->select("tbl_pekerjaan.pekerjaan_id , tbl_pekerjaan.deskripsi , tbl_pekerjaan.nama_pekerja , tbl_pekerjaan.nama_asset , tbl_pekerjaan.nama_brand , tbl_pekerjaan.nama_lokasi , tbl_pekerjaan.tanggal_mulai , tbl_pekerjaan.tanggal_selesai , tbl_user.email");
        $this->db->from('tbl_pekerjaan');
        $this->db->join('tbl_user' , 'tbl_user.nama = tbl_pekerjaan.nama_pekerja');
        $this->db->where('date_format(tanggal_mulai,"%Y-%m-%d")','CURDATE()' , FALSE);
        $query = $this->db->get();

        return $query->result();
    }
    }
?>
