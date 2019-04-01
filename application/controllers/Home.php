<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('produk_model');
	}
	
	public function index()
	{
		$info['title'] = 'Beranda';
		$info['meta'] = array(
			array(
				'name' 		=> 'description',
				'content'	=> 'Jual tanaman hias'
			),
			array(
				'name'		=> 'keywords',
				'content'	=> 'tanaman, hias'
			)
		);
		$this->load->view('frontend/head', $info);
		$this->load->view('frontend/navbar');
		$this->load->view('frontend/beranda');

		$data['produk'] = $this->produk_model->show(8, 0);
		$this->load->view('frontend/produk-home', $data);

		$this->load->view('frontend/footer');
		$this->load->view('frontend/foot');
	}
}
