<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('usergroup') == 2)
		{
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->load->model('produk_model');
			$this->load->model('akun_model');
			$this->load->model('company_profile_model');

		}
		else
		{
			$this->session->set_flashdata('error', "Anda harus masuk sebagai Admin untuk melanjutkan");
			$this->session->set_flashdata('redir', uri_string());
			redirect('akun/masuk');
		}
	}

	public function index()
	{
		$this->load->helper('text');

		$info['title'] = 'ADMIN | Daftar Produk';
		$info['meta'] = array(
			array(
				'name' 		=> 'description',
				'content'	=> 'Kelola produk tanaman hias'
			)
		);
		$data['produk'] = $this->produk_model->get_all();
		$data['datatable'] = 'productTable';
		$data['user'] =  $this->akun_model->get_user_by_id($this->session->userdata('id'));
		$data['company'] = $this->company_profile_model->ambil_company_id('1');
		$this->load->view('backend/produk/index', $data);
		}

	public function tambah()
	{
		$info['title'] = 'ADMIN | Tambah Produk';
		$info['meta'] = array(
			array(
				'name' 		=> 'description',
				'content'	=> 'Tambah produk baru tanaman hias'
			)
		);

		$this->form_validation->set_rules('nama', 'Nama produk', 'trim|required|max_length[64]');
		$this->form_validation->set_rules('harga', 'Harga produk', 'required|integer|greater_than_equal_to[0]');
		$this->form_validation->set_rules('persediaan', 'Jumlah persediaan', 'required|is_natural|greater_than_equal_to[0]');
		$this->form_validation->set_rules('berat', 'Berat produk', 'required|numeric|greater_than[0.0]|regex_match[/^[0-9,.]+$/]');
		$this->form_validation->set_rules('panjang', 'Panjang produk', 'numeric|greater_than[0.0]|regex_match[/^[0-9,.]+$/]');
		$this->form_validation->set_rules('lebar', 'Lebar produk', 'numeric|greater_than[0.0]|regex_match[/^[0-9,.]+$/]');
		$this->form_validation->set_rules('tinggi', 'Tinggi produk', 'numeric|greater_than[0.0]|regex_match[/^[0-9,.]+$/]');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi produk', 'trim|max_length[255]');

		if ($this->form_validation->run() == FALSE)
		{
			$data['company'] = $this->company_profile_model->ambil_company_id('1');
			$data['user'] =  $this->akun_model->get_user_by_id($this->session->userdata('id'));
			$this->load->view('backend/produk/tambah' , $data);
		}
		else
		{
			if(!$this->produk_model->upload_image('gambar'))
			{
				$data['error'] = $this->upload->display_errors('<div class="alert alert-danger">Gagal memproses gambar: ', '</div>');
				$this->load->view('backend/produk/tambah', $data);
			}
			else
			{
				$gambar = $this->upload->data();
				$produk = array(
					'nama'			=> 	set_value('nama'),
					'harga'			=>	set_value('harga'),
					'persediaan'	=>	set_value('persediaan'),
					'berat'			=>	set_value('berat'),
					'panjang'		=>	set_value('panjang'),
					'lebar'			=>	set_value('lebar'),
					'tinggi'		=>	set_value('tinggi'),
					'deskripsi'		=>	set_value('deskripsi'),
					'gambar'		=>	$gambar['file_name']
				);
				$created = $this->produk_model->create($produk);
				if ($created)
				{
					redirect('admin/produk');
				}
				else
				{
					unlink(PRODUCT_UPLOAD_DIRECTORY . $gambar['file_name']);
					$this->session->set_flashdata('error', 'Gagal menambahkan produk ke dalam basis data');
					redirect('admin/produk/tambah');
				}
			}
		}
	}

	public function edit($id)
	{
		if (empty($id))
		{
			redirect('admin/produk');
		}

		$info['title'] = 'ADMIN | Edit Produk';
		$info['meta'] = array(
			array(
				'name' 		=> 'description',
				'content'	=> 'Edit produk'
			)
		);
		
		$this->form_validation->set_rules('nama', 'Nama produk', 'trim|required|max_length[64]');
		$this->form_validation->set_rules('harga', 'Harga produk', 'required|integer|greater_than_equal_to[0]');
		$this->form_validation->set_rules('persediaan', 'Jumlah persediaan', 'required|is_natural|greater_than_equal_to[0]');
		$this->form_validation->set_rules('berat', 'Berat produk', 'required|numeric|greater_than[0.0]|regex_match[/^[0-9,.]+$/]');
		$this->form_validation->set_rules('panjang', 'Panjang produk', 'numeric|greater_than[0.0]|regex_match[/^[0-9,.]+$/]');
		$this->form_validation->set_rules('lebar', 'Lebar produk', 'numeric|greater_than[0.0]|regex_match[/^[0-9,.]+$/]');
		$this->form_validation->set_rules('tinggi', 'Tinggi produk', 'numeric|greater_than[0.0]|regex_match[/^[0-9,.]+$/]');
		$this->form_validation->set_rules('deskripsi', 'Deskripsi produk', 'trim|max_length[255]');

		$data['produk'] = $this->produk_model->get($id);
		if (empty($data['produk']))
		{
			redirect('admin/produk');
		}
		else if ($this->form_validation->run() == FALSE)
		{
			$data['company'] = $this->company_profile_model->ambil_company_id('1');
			$data['user'] =  $this->akun_model->get_user_by_id($this->session->userdata('id'));
			$this->load->view('backend/produk/edit', $data);
		}
		else
		{
			$produk = array(
				'nama'			=>	set_value('nama'),
				'harga'			=>	set_value('harga'),
				'persediaan'	=>	set_value('persediaan'),
				'berat'			=>	set_value('berat'),
				'panjang'		=>	set_value('panjang'),
				'lebar'			=>	set_value('lebar'),
				'tinggi'		=>	set_value('tinggi'),
				'deskripsi'		=>	set_value('deskripsi')
			);
			if ($_FILES && $_FILES['gambar']['name'])
			{
				if (!$this->produk_model->upload_image('gambar'))
				{
					$data['error'] = $this->upload->display_errors('<div class="alert alert-warning">Gagal memproses gambar: ', '</div>');
					$this->load->view('backend/produk/edit', $data);
				}
				else
				{
					$gambar = $this->upload->data();
					$produk['gambar'] = $gambar['file_name'];
				}
			}
			
			$this->produk_model->update($id, $produk);
			redirect('admin/produk');
		}	}

	public function hapus($id)
	{
		if (empty($id))
		{
			redirect('admin/produk');
		}
		else
		{
			$this->produk_model->delete($id);
			redirect('admin/produk');
		}
	}
}
?>