<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');
    
 
    class Company_profile_model extends CI_Model
    {        
        function __construct()
        {
                    $this->load->database();        
        }


        function ambil_company(){
            $this->db->order_by("company_id","asc"); 
            return $this->db->get('company_profile')->result();
        }      
        function hapus_company($company_id,$table){
        $this->db->where('company_id' , $company_id);
        $this->db->delete($table);
        }
        public function tambah_company($table,$data){
            $this->db->insert($table,$data);
        }
        public function ambil_company_id($company_id)
        {
            $this->db->select("*");
            $this->db->from('company_profile');
            $this->db->where('company_id',$company_id);
            $query = $this->db->get();

            return $query->result();
        }
        public function update_company($where, $data)
        {
            $this->db->update('company_profile', $data, $where);
            return $this->db->affected_rows();
        }
    }
?>
