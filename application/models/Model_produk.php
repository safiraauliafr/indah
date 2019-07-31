<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');
    
 
    class Model_produk extends CI_Model
    {        
            public function view_by_date($date)
    {
        $this->db->where('DATE(tanggal)', $date);

        return $this->db->get('laporan')->result();
    }

    public function view_by_month($month, $year)
    {
        $this->db->where('MONTH(tanggal)', $month);
        $this->db->where('YEAR(tanggal)', $year);

        return $this->db->get('laporan')->result();
    }

    public function view_all()
    {
        return $this->db->get('laporan')->result();
    }

    public function option_tahun()
    {
        $this->db->select('YEAR(tanggal) AS tahun');
        $this->db->from('laporan');
        $this->db->order_by('YEAR(tanggal)');
        $this->db->group_by('YEAR(tanggal)');

        return $this->db->get()->result();
    }  
    }
?>
