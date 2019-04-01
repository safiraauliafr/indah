<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Produk_model extends CI_Model
{
	
	public function __construct()
	{
		$this->load->database();
	}

	public function get_all($showemptystock = TRUE)
	{
		$hasil = NULL;
		if ($showemptystock)
		{
			$hasil = $this->db->get('produk');
		}
		else
		{
			$hasil = $this->db
						->where('persediaan >', 0)
						->get('produk');
		}
		return $hasil->result();
	}

	public function total($countemptystock = TRUE)
	{
		if ($countemptystock)
		{
			$hasil = $this->db
						->select('COUNT(*)')
						->where('persediaan >', 0)
						->get('produk');
			return $hasil->row();
		}
		else
		{
			return $this->db->count_all('produk');
		}
	}

	public function show($x, $y, $showemptystock = TRUE)
	{
		$hasil = NULL;
		if ($showemptystock)
		{
			$hasil = $this->db
						->limit($x, $y)
						->get('produk');
		}
		else
		{
			$hasil = $this->db
						->where('persediaan >', 0)
						->limit($x, $y)
						->get('produk');
		}
		return $hasil->result();
	}

	public function get($id)
	{
		$hasil = $this->db->where('id_produk', $id)
						->limit(1)
						->get('produk');
		return $hasil->row();
	}

	public function find($name, $limit = 10)
	{
		$hasil = $this->db->like('nama', $name)
						->limit($limit)
						->get('produk');
		return $hasil->result();
	}

	public function create($product)
	{
		return $this->db->insert('produk', $product);
	}

	public function update($id, $product)
	{
		return $this->db->where('id_produk', $id)
				->update('produk', $product);
	}

	public function delete($id)
	{
		return $this->db->where('id_produk', $id)
				->delete('produk');
	}
	

/*
	public function get_rating($id)
	{
		$hasil = $this->db->where('id_produk', $id)
						->select_avg('rating')
						->get('review');
		return $hasil->result();
	}
*/

	function upload_image($image)
	{
		$config['upload_path']          = './' . PRODUCT_UPLOAD_DIRECTORY;
		$config['allowed_types']        = 'jpg|jpeg|png';
		$config['max_size']             = 2048; // 2048 KB = 2 MB
		$config['max_filename']			= 250; // + 3 digits (100) CI increment

		if (!is_dir($config['upload_path']))
		{
			mkdir($config['upload_path']);
		}

		$this->load->library('upload', $config);

		return $this->upload->do_upload($image);
	}
}
?>