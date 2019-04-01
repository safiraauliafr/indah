<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_produk extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('pdf_report');
		$this->load->model('produk_model');
	}

	public function index()
	{
		$data = $this->produk_model->total();
		$this->load->view('backend/v_produk', ['data'=>$data]);
	}
}