<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('produk_model');
	}

	public function index($halaman = 0)
	{
		$pageconfig = array(
			'base_url'			=> base_url('produk'),
			'total_rows'		=> $this->produk_model->total(FALSE),
			'per_page'			=> 20,
			'full_tag_open'		=> '<nav><ul class="pagination">',
			'full_tag_close'	=> '</ul></nav>',
			'first_tag_open'	=> '<li>',
			'first_tag_close'	=> '</li>',
			'last_tag_open'		=> '<li>',
			'last_tag_close'	=> '</li>',
			'next_link'			=> '<span aria-hidden="true">&raquo;</span>',
			'next_tag_open'		=> '<li>',
			'next_tag_close'	=> '</li>',
			'prev_link'			=> '<span aria-hidden="true">&laquo;</span>',
			'prev_tag_open'		=> '<li>',
			'prev_tag_close'	=> '</li>',
			'cur_tag_open'		=> '<li class="active"><a href="#">',
			'cur_tag_close'		=> '</a></li>',
			'num_tag_open'		=> '<li>',
			'num_tag_close'		=> '</li>'
		);
		$this->load->library('pagination');
		$this->pagination->initialize($pageconfig);
		$info['title'] = 'Daftar Produk';
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
		$this->load->view('frontend/breadcrumbs');

		$data['produk'] = $this->produk_model->show($pageconfig['per_page'], $halaman, FALSE);
		$data['pagination'] = $this->pagination->create_links();
		$this->load->view('frontend/produk/daftar', $data);

		$this->load->view('frontend/footer');
		$this->load->view('frontend/foot');
	}

	public function lihat($id = NULL)
	{
		$produk_item = $this->produk_model->get($id);
		if (empty($produk_item))
		{
			$info['title'] = 'Item tidak ditemukan';
			$info['meta'] = array(
				array(
					'name'		=> 'robots',
					'content'	=> 'noindex, nofollow'
				)
			);
			$this->load->view('frontend/head', $info);
			$this->load->view('frontend/navbar');
			$this->load->view('frontend/errors/item-not-found');
		}
		else
		{
			$info['title'] = $produk_item->nama OR 'Informasi Produk';
			$this->load->view('frontend/head', $info);
			$this->load->view('frontend/navbar');
			$data['produk_item'] = $produk_item;
			$this->load->view('frontend/produk/produk', $data);
		}

		$this->load->view('frontend/footer');
		$this->load->view('frontend/foot');
	}

	public function cari($katakunci = NULL)
	{
		$info['title'] = 'Cari produk';
		$this->load->view('frontend/head', $info);
		$this->load->view('frontend/navbar');

		$this->form_validation->set_data($this->input->get());
		$this->form_validation->set_rules('katakunci', 'Kata kunci', 'trim|required|alpha_numeric_spaces|min_length[3]|max_length[100]');
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('frontend/breadcrumbs');
			$this->load->view('frontend/produk/cari');
		}
		else
		{
			$katakunci = set_value('katakunci');
			$data['katakunci'] = $katakunci;
			$data['produk'] = $this->produk_model->find($katakunci);
			$this->load->view('frontend/produk/hasil-pencarian', $data);
		}

		$this->load->view('frontend/footer');
		$this->load->view('frontend/foot');
	}

	public function tambah_ke_keranjang($id, $jumlah = 1)
	{
		$this->load->helper('text');
		if ($this->input->get())
		{
			$id = (int) $this->input->get('id', TRUE);
			$jumlah = (int) $this->input->get('jumlah', TRUE);
		}
		if (!empty($id) && $jumlah > 0)
		{
			$produk = $this->produk_model->get($id);
			$data = array(
				'id'		=> $id,
				'qty'		=> $jumlah,
				'price'		=> $produk->harga,
				'name'		=> $produk->nama,
				'weight'	=> $produk->berat,
				'imagepath'	=> $produk->gambar
			);

			$this->cart->insert($data);
			$this->session->set_flashdata('success', 'Produk <strong>' . $produk->nama . '</strong> (&times;' . $jumlah .') telah ditambahkan ke dalam ' . anchor('/produk/keranjang', 'keranjang belanja anda') . '.');
		}
		redirect(base_url('produk/keranjang'));
	}

	public function hapus_dari_keranjang($id)
	{
		if (!empty($id))
		{				
			$this->cart->remove($id);
		}
		redirect(base_url('produk/keranjang'));
	}

	public function kosongkan_keranjang()
	{
		$this->cart->destroy();
		redirect(base_url());
	}

	public function keranjang()
	{
		$info['title'] = 'Keranjang Belanja';
		$this->load->view('frontend/head', $info);
		$this->load->view('frontend/navbar');
		$this->load->view('frontend/breadcrumbs');

		$data['datatable'] = 'shopCartTable';
		$this->load->view('frontend/pelanggan/keranjang', $data);

		$this->load->view('frontend/footer');
		$this->load->view('frontend/foot', $data);
	}
} 
?>