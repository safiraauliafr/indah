<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');
    
 
    class Invoice_model extends CI_Model
    {        
        function __construct()
        {
                    $this->load->database();        
        }


        function ambil_invoice(){
            $this->db->order_by("invoice_id","asc"); 
            return $this->db->get('invoice')->result();
        }
         function ambil_invoice_confirm(){
            $this->db->order_by("invoice_id","asc"); 
            return $this->db->get('invoice')->where('status' , 'confirmed')->result();
        }            
        function hapus_invoice($invoice_id,$table){
        $this->db->where('id_invoice' , $invoice_id);
        $this->db->delete($table);
        }
        public function tambah_invoice($table,$data){
            $this->db->insert($table,$data);
        }
        public function ambil_invoice_id($invoice_id)
        {
            $this->db->select("*");
            $this->db->from('invoice');
            $this->db->where('id_invoice',$invoice_id);
            $query = $this->db->get();

            return $query->result();
        }
        public function update_invoice($id_invoice, $data)
        {
            return $this->db->where('id_invoice' , $id_invoice)
                     ->update('invoice', $data);
        }
        public function laporan_transaksi($from, $to)
    {
        $sql = "
            SELECT 
                DISTINCT(SUBSTR(a.`tanggal`, 1, 10)) AS tanggal,
                (
                    SELECT 
                        SUM(b.`total_belanja`) 
                    FROM 
                        `invoice` AS b 
                    WHERE 
                        SUBSTR(b.`tanggal`, 1, 10) = SUBSTR(a.`tanggal`, 1, 10) 
                    LIMIT 1
                ) AS total_penjualan 
            FROM 
                `invoice` AS a 
            WHERE 
                SUBSTR(a.`tanggal`, 1, 10) >= '".$from."' 
                AND SUBSTR(a.`tanggal`, 1, 10) <= '".$to."' 
            ORDER BY 
                a.`tanggal` ASC
        ";

        return $this->db->query($sql);
    }
    
    }
?>
