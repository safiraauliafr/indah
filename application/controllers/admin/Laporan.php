<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('company_profile_model');

		if($this->session->userdata('usergroup') <> '2')
		{
			redirect('akun');
		}
	}

	public function index()
	{
		$this->load->view('backend/form_laporan');
	}

	public function transaksi()
	{
		$this->load->model('invoice_model');
		$dt['transaksi'] = $this->invoice_model->laporan_transaksi($from, $to);
		$dt['form'] = date('d F Y', strtotime($form));
		$dt['to'] = date('d F Y', strtotime($to));
		$this->load->view('backend/laporan_transaksi', $dt);
	}
	public function pdf($from, $to)
	{
		
	}
}