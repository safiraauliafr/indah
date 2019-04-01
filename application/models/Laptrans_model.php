<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laptrans_model extends CI_Model
{
	
	public function view_by_date($date)
	{
		$this->db->where('DATE(tanggal)', $date);

		return $this->db->get('invoice')->result();
	}

	public function view_by_month($month, $year)
	{
		$this->db->where('MONTH(tanggal)', $month);
		$this->db->where('YEAR(tanggal)', $year);

		return $this->db->get('invoice')->result();
	}

	public function view_all()
	{
		return $this->db->get('invoice')->result();
	}

	public function option_tahun()
	{
		$this->db->select('YEAR(tanggal) AS tahun');
		$this->db->from('invoice');
		$this->db->order_by('YEAR(tanggal)');
		$this->db->group_by('YEAR(tanggal)');

		return $this->db->get()->result();
	}
}