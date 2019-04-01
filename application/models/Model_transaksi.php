<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');
    
 
    class Model_transaksi extends CI_Model
    {        
            public function view_by_date($date)
    {
        $this->db->where('DATE(tgl)', $date);

        return $this->db->get('laporan')->result();
    }

    public function view_by_month($month, $year)
    {
        $this->db->where('MONTH(tgl)', $month);
        $this->db->where('YEAR(tgl)', $year);

        return $this->db->get('laporan')->result();
    }

    public function view_all()
    {
        return $this->db->get('laporan')->result();
    }

    public function option_tahun()
    {
        $this->db->select('YEAR(tgl) AS tahun');
        $this->db->from('laporan');
        $this->db->order_by('YEAR(tgl)');
        $this->db->group_by('YEAR(tgl)');

        return $this->db->get()->result();
    }  
    }
?>
