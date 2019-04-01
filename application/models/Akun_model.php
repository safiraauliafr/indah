<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun_model extends CI_Model
{
	
	public function __construct()
	{
		$this->load->database();
	}

	public function periksa_kredensial()
	{
		$username = set_value('nama');
		// $type = set_value('jenis');
		$type = 'pengguna';

		$hasil = $this->db
					->where('nama', $username)
					//->where('password', $password)
					->limit(1)
					->get($type);
		$userdata = $hasil->row();
		$password = hash('sha512', set_value('password').$userdata->salt);
		if (strcmp($password, $userdata->password) == 0)
		{
			return $userdata;
		}
		return NULL;
	}

	public function create($user)
	{
		if (is_array($user) && $this->db->insert('pengguna', $user))
		{
			return $this->db->insert_id();
		}
		return FALSE;
	}

	public function update($id, $user)
	{
		return is_array($user) &&
				$this->db
					->where('id_pengguna', $id)
					->update('pengguna', $user);
	}

	public function delete($id)
	{
		return $this->db
				->where('id_pengguna', $id)
				->delete('pengguna');
	}
	public function get_all_user()
	{
		$hasil = $this->db
					->get('pengguna');
		return $hasil->result();
	}
	public function get_all_province()
	{
		$hasil = $this->db
					->get('provinces');
		return $hasil->result();
	}
		public function get_regency_by_id($province_id)
	{
		$hasil = $this->db
					->where('province_id' , $province_id)
					->get('regencies');
		return $hasil->result();
	}
		public function get_district_by_id($regency_id)
	{
		$hasil = $this->db
					->where('regency_id' , $regency_id)
					->get('districts');
		return $hasil->result();
	}

	public function get($id)
	{
		$hasil = $this->db
					->where('id_pengguna', $id)
					->limit(1)
					->get('pengguna');
		return $hasil->row();
	}

	public function get_full_name($id)
	{
		$hasil = $this->db
					->select('nama_depan, nama_belakang')
					->where('id_pengguna', $id)
					->limit(1)
					->get('pengguna');
		return $hasil->row();
	}

	function upload_image($image)
	{
		$config['upload_path']          = './' . PROFLE_UPLOAD_DIRECTORY;
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
		public function get_user_by_id($id)
	{
		$hasil = $this->db
					->where('id_pengguna', $id)
					->limit(1)
					->get('pengguna');
		return $hasil->result();
	}

	
}
?>