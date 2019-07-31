<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('akun_model');
	}

	public function index()
	{
		if (!$this->session->has_userdata('id'))
		{
			$this->session->set_flashdata('error', "Anda harus masuk untuk melanjutkan");
			$this->session->set_flashdata('redir', uri_string());
			redirect('akun/masuk');
		}

		$this->form_validation->set_rules('namadepan', 'Nama depan', 'trim|required|max_length[64]');
		$this->form_validation->set_rules('namabelakang', 'Nama belakang', 'trim|max_length[64]');
		$this->form_validation->set_rules('nomortelepon', 'Nomor telepon', ['trim', 'required', 'regex_match[/^(\+|[0])[0-9]+$/]']);
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'required|is_natural|max_length[2]');
		$this->form_validation->set_rules('alamat', 'Alamat utama', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('kodepos', 'Kode pos utama', 'trim|required|is_natural|max_length[8]');

		if ($this->form_validation->run() == FALSE)
		{
			$this->session->keep_flashdata('redir');
			$info['title'] = 'Pengaturan Pengguna';
			$this->load->view('frontend/head', $info);
			$this->load->view('frontend/navbar');
			$this->load->view('frontend/breadcrumbs');
			$data['akun'] = $this->akun_model->get($this->session->userdata('id'));
			$provinsi = $this->db->get('provinces');
			$data['provinces'] = $provinsi->result();
			$this->load->view('frontend/akun/akun', $data);
			$this->load->view('frontend/footer');
			$this->load->view('frontend/foot');
		}
		else
		{
			$updated = FALSE;
			$updated = $this->akun_model->update(
				$this->session->userdata('id'),
				array(
					'nama_depan' 	=> set_value('namadepan'),
					'nama_belakang' => set_value('namabelakang'),
					'nomor_telepon' => set_value('nomortelepon'),
					'province_id'	=> set_value('provinsi'),
					'alamat' 		=> set_value('alamat'),
					'kode_pos' 		=> set_value('kodepos')
				)
			);

			if ($updated)
			{
				$this->session->set_flashdata('success', 'Anda telah berhasil memperbarui informasi pelanggan anda');
				if ($this->session->flashdata('redir'))
				{
					redirect($this->session->flashdata('redir'));
				}
				else
				{
					redirect('akun');
				}
			}
			else
			{
				$this->session->set_flashdata('error', 'Gagal memperbarui informasi pelanggan');
			}
		}
	}

	public function masuk()
	{
		if ($this->session->has_userdata('id'))
		{
			$this->session->set_flashdata('warning', 'Anda harus keluar dari akun anda terlebih dahulu sebelum masuk kembali');
			redirect(site_url());
		}

		$this->form_validation->set_rules('nama', 'Nama pengguna', 'required|max_length[64]');
		// $this->form_validation->set_rules('jenis', 'Jenis akun', 'required|in_list[pengguna,admin]');
		$this->form_validation->set_rules('password', 'Kata sandi', 'required|max_length[32]');

		if ($this->form_validation->run() == FALSE)
		{
			$this->session->keep_flashdata('redir');
			$info['title'] = 'Masuk';
			$this->load->view('frontend/head', $info);
			$this->load->view('frontend/navbar');
			$this->load->view('frontend/breadcrumbs');
			$this->load->view('frontend/akun/masuk');
			$this->load->view('frontend/footer');
			$this->load->view('frontend/foot');
		}
		else
		{
			$valid_user = $this->akun_model->periksa_kredensial();

			if ($valid_user)
			{
				$this->session->set_userdata('id', $valid_user->id_pengguna);
				$this->session->set_userdata('username', $valid_user->nama);
				$this->session->set_userdata('usergroup', $valid_user->grup);

				$call_prefix = '';
				$gender = $valid_user->jenis_kelamin;
				if (!strcasecmp($gender, 'L'))
				{
					$call_prefix = 'Tn. ';
				}
				else if (!strcasecmp($gender, 'P'))
				{
					$call_prefix = 'Ny. ';
				}
				$group_name = '';
				switch ($valid_user->grup)
				{
					case 1:
					{
						$group_name = 'pengguna';
						break;
					}
					case 2:
					{
						$group_name = 'admin';
						redirect('admin/dashboard');
						break;
					}
					default:
					{
						$group_name = 'tidak diketahui';
					}
				}

				$this->session->set_flashdata('message', 'Selamat datang kembali ' . $call_prefix . ' <strong>' . $valid_user->nama_depan . '</strong>, anda telah berhasil masuk ke dalam sistem toko sebagai ' . $group_name . '.');

				if ($this->session->flashdata('redir'))
				{
					redirect($this->session->flashdata('redir'));
				}
				else
				{
					redirect(site_url());
				}
			}
			else
			{
				$this->session->set_flashdata('error', 'Nama pengguna / kata sandi salah');
				redirect('akun/masuk');
			}
		}
	}

	public function keluar()
	{
		$this->session->sess_destroy();
		redirect(site_url());
	}

	public function daftar()
	{
		if ($this->session->has_userdata('id'))
		{
			$this->session->set_flashdata('warning', 'Anda harus keluar dari akun anda terlebih dahulu sebelum mendaftar');
			redirect(site_url());
		}

		$this->form_validation->set_rules('namadepan', 'Nama depan', 'trim|required|max_length[64]');
		$this->form_validation->set_rules('namabelakang', 'Nama belakang', 'trim|max_length[64]');
		$this->form_validation->set_rules('nama', 'Nama pengguna', 'trim|required|valid_email|max_length[64]|is_unique[pengguna.nama]', ['is_unique' => 'Nama pengguna atau alamat email sudah terdaftar']);
		$this->form_validation->set_rules('nomor_telepon', 'Nomor telepon', ['trim', 'required', 'regex_match[/^(\+|[0])[0-9]+$/]']);
		$this->form_validation->set_rules('password', 'Kata sandi', 'trim|required|min_length[6]|max_length[32]');
		$this->form_validation->set_rules('konfirmasipassword', 'Konfirmasi kata sandi', 'trim|required|matches[password]');
		$this->form_validation->set_rules('bulanlahir', 'Tanggal lahir', 'required|is_natural_no_zero|greater_than_equal_to[1]|less_than_equal_to[12]');
		$this->form_validation->set_rules('tahunlahir', 'Tanggal lahir', ['required', 'is_natural', sprintf('greater_than_equal_to[%d]', date('Y', 0)), sprintf('less_than_equal_to[%d]', date('Y'))]);
		$this->form_validation->set_rules('tanggallahir', 'Tanggal lahir', 'required|is_natural_no_zero|greater_than_equal_to[1]|less_than_equal_to[31]|callback__cek_tanggal');
		$this->form_validation->set_rules('jeniskelamin', 'Jenis kelamin', 'required|in_list[L,P]');

		if ($this->form_validation->run() == FALSE)
		{
			$provinsi = $this->db->get('provinces');
			$data['provinces'] = $provinsi->result();
			$info['title'] = 'Mendaftar';
			$this->load->view('frontend/head', $info);
			$this->load->view('frontend/navbar');
			$this->load->view('frontend/breadcrumbs');
			$this->load->view('frontend/akun/daftar' , $data);
			$this->load->view('frontend/footer');
			$this->load->view('frontend/foot');
		}
		else
		{
			$username = set_value('nama');
			$usergroup = 1;
			$salt = uniqid('$6$');
			$password = hash('sha512', set_value('password').$salt);
			$userid = $this->akun_model->create(
				array(
					'nama' => $username,
					'password' => $password,
					'salt' => $salt,
					'grup' => $usergroup,
					'nama_depan' => set_value('namadepan'),
					'nama_belakang' => set_value('namabelakang'),
					'nomor_telepon' => set_value('nomor_telepon'),
					'tanggal_lahir' => date('Y-m-d', mktime(0, 0, 0, set_value('bulanlahir'), set_value('tanggallahir'), set_value('tahunlahir'))),
					'tanggal_daftar' => date('Y-m-d H:i:s'),
					'province_id' => set_value('provinsi'),
					'regency_id' => set_value('kota'),
					'district_id' => set_value('kecamatan'),
					'alamat' => set_value('alamat'),
					'kode_pos' => set_value('kode_pos'),

				)
			);

			if ($userid)
			{
				$this->session->set_userdata('id', $userid);
				$this->session->set_userdata('username', $username);
				$this->session->set_userdata('usergroup', $usergroup);

				if ($this->session->flashdata('redir'))
				{
					redirect($this->session->flashdata('redir'));
				}
				else
				{
					redirect('produk');
				}
			}
			else
			{
				$this->session->set_flashdata('error', 'Gagal membuat akun');
			}
		}
	}

	public function perbarui()
	{
		if (!$this->session->has_userdata('id'))
		{
			$this->session->set_flashdata('error', "Anda harus masuk untuk melanjutkan");
			$this->session->set_flashdata('redir', uri_string());
			return redirect('akun/masuk');
		}

		$this->form_validation->set_rules('nama', 'Nama pengguna', 'trim|required|valid_email|max_length[64]');
		$this->form_validation->set_rules('password', 'Kata sandi', 'trim|required|min_length[6]|max_length[32]');
		$this->form_validation->set_rules('newpassword', 'Kata sandi baru', 'trim|required|min_length[6]|max_length[32]|differs[password]');
		$this->form_validation->set_rules('confirmpassword', 'Konfirmasi kata sandi baru', 'trim|required|min_length[6]|max_length[32]|matches[newpassword]');

		if ($this->form_validation->run() == TRUE)
		{
			$password = set_value('password');
			$newpassword = set_value('newpassword');
			$confirmnewpassword = set_value('confirmpassword');
			$userdata = $this->akun_model->periksa_kredensial();
			if ($userdata !== NULL && $userdata->id_pengguna == $this->session->userdata('id'))
			{
				$updated = FALSE;
				$salt = uniqid('$6$');
				$newpassword = hash('sha512', $newpassword.$salt);
				$updated = $this->akun_model->update(	
					$this->session->userdata('id'),
					array(
						'password'	=> $newpassword,
						'salt'		=> $salt
					)
				);

				if ($updated)
				{
					$this->session->set_flashdata('success', 'Anda telah berhasil memperbarui data akun anda');
				}
				else
				{
					$this->session->set_flashdata('error', 'Gagal memperbarui data akun anda');
				}
			}
			else
			{
				$this->session->set_flashdata('error', 'Nama pengguna / kata sandi salah');
			}
		}

         $pesan['message'] =    "Pendaftaran berhasil";
             
             $this->load->view('frontend/v_success',$pesan);

		return redirect('akun');
	}

	function _cek_tanggal($tanggal)
	{
		if (!checkdate(set_value('bulanlahir'), $tanggal, set_value('tahunlahir')))
		{
			$this->form_validation->set_message('cek_tanggal', 'Tanggal yang anda masukkan tidak benar.');
			return FALSE;
		}
		return TRUE;
	}
	public function get_regencies($province_id){
   	//$nama2 = str_replace('_', ' ', $nama);
      $query = $this->db->get_where('regencies',array('province_id'=>$province_id));
      $data = "<option value=''>Kota / Kabupaten</option>";
      foreach ($query->result() as $value) {
          $data .= "<option value='".$value->id."'>".$value->name."</option>";
      }
      echo $data;

	}
	public function get_districts($regency_id){
   	//$nama2 = str_replace('_', ' ', $nama);
      $query = $this->db->get_where('districts',array('regency_id'=>$regency_id));
      $data = "<option value=''>Kecamatan</option>";
      foreach ($query->result() as $value) {
          $data .= "<option value='".$value->id."'>".$value->name."</option>";
      }
      echo $data;

	}
	
}
?>