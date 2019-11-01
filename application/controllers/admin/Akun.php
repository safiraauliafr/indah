<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Akun extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->model('akun_model');
		$this->load->model('company_profile_model');
	}

	public function index()
	{
		$row = $this->akun_model->get_user_by_id($this->session->userdata('id'));
		foreach ($row as $row1) {
			$data['province_id'] = $row1->province_id;
			$data['regency_id'] = $row1->regency_id;
			$data['district_id'] = $row1->district_id;
			$data['jenis_kelamin'] = $row1->jenis_kelamin;
		}
		$data['company'] = $this->company_profile_model->ambil_company_id('1');

		$data['province'] =  $this->akun_model->get_all_province();
		$data['user'] =  $this->akun_model->get_user_by_id($this->session->userdata('id'));
		$data['dd_province'] = $this->akun_model->get_all_province();
		$data['dd_regency'] =  $this->akun_model->get_regency_by_id($data['province_id']);
		$data['dd_district'] =  $this->akun_model->get_district_by_id($data['regency_id']);
		$this->load->view('backend/profile', $data);
	}



	public function keluar()
	{
		$this->session->sess_destroy();
		redirect(site_url());
	}


	public function perbaharui_akun()
	{
		if (!$this->session->has_userdata('id')) {
			$this->session->set_flashdata('error', "Anda harus masuk untuk melanjutkan");
			$this->session->set_flashdata('redir', uri_string());
			return redirect('akun/masuk');
		}

		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[64]');
		$this->form_validation->set_rules('password', 'Kata sandi', 'trim|required|min_length[6]|max_length[32]');
		$this->form_validation->set_rules('newpassword', 'Kata sandi baru', 'trim|required|min_length[6]|max_length[32]|differs[password]');
		$this->form_validation->set_rules('confirmpassword', 'Konfirmasi kata sandi baru', 'trim|required|min_length[6]|max_length[32]|matches[newpassword]');

		if ($this->form_validation->run() == TRUE) {
			$password = set_value('password');
			$newpassword = set_value('newpassword');
			$confirmnewpassword = set_value('confirmpassword');
			$updated = FALSE;
			$salt = uniqid('$6$');
			$newpassword = hash('sha512', $newpassword . $salt);
			$updated = $this->akun_model->update(
				$this->session->userdata('id'),
				array(
					'nama'		=> set_value('email'),
					'password'	=> $newpassword,
					'salt'		=> $salt
				)
			);

			if ($updated) {
				$this->session->set_flashdata('success', 'Anda telah berhasil memperbarui data akun anda');
			} else {
				$this->session->set_flashdata('error', 'Gagal memperbarui data akun anda');
			}
			redirect('admin/akun');
		}
		redirect('admin/dashboard');
	}
	public function perbaharui_profil()
	{
		if (!$this->session->has_userdata('id')) {
			$this->session->set_flashdata('error', "Anda harus masuk untuk melanjutkan");
			$this->session->set_flashdata('redir', uri_string());
			redirect('akun/masuk');
		}

		$this->form_validation->set_rules('nama_depan', 'Nama depan', 'trim|required|max_length[64]');
		$this->form_validation->set_rules('nama_belakang', 'Nama belakang', 'trim|max_length[64]');
		$this->form_validation->set_rules('nomor_telepon', 'Nomor telepon', ['trim', 'required', 'regex_match[/^(\+|[0])[0-9]+$/]']);
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'required|is_natural|max_length[2]');
		$this->form_validation->set_rules('alamat', 'Alamat utama', 'trim|required|max_length[255]');
		// $this->form_validation->set_rules('kode_pos', 'Kode pos utama', 'trim|required|is_natural|max_length[8]');

		$config['upload_path'] = './assets/uploads/' . set_value('avatar'); //path folder
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
		$config['max_size'] = '0'; //maksimum besar file 2M
		$config['file_name'] = set_value('avatar'); //nama yang terupload nantinya
		$this->load->library('upload', $config);
		$this->upload->initialize($config);


		if ($this->form_validation->run() == FALSE) {
			$this->session->keep_flashdata('redir');
			$data['akun'] = $this->akun_model->get($this->session->userdata('id'));
			$provinsi = $this->db->get('provinces');
			$data['provinces'] = $provinsi->result();
			$data['company'] = $this->company_profile_model->ambil_company_id('1');
			$this->load->view('backend/akun', $data);
		} else {
			if (empty($_FILES['avatar']['name'])) {
				$updated = FALSE;
				$updated = $this->akun_model->update(
					$this->session->userdata('id'),
					array(
						'nama_depan' 	=> set_value('nama_depan'),
						'nama_belakang' => set_value('nama_belakang'),
						'nomor_telepon' => set_value('nomor_telepon'),
						'province_id'	=> set_value('provinsi'),
						'regency_id'	=> set_value('kota'),
						'district_id'	=> set_value('kecamatan'),
						'tanggal_lahir'	=> set_value('tanggal_lahir'),
						'jenis_kelamin'	=> set_value('jenis_kelamin'),
						'alamat' 		=> set_value('alamat')
						// 'kode_pos' 		=> set_value('kode_pos')
					)
				);

				if ($updated) {
					$this->session->set_flashdata('success', 'Anda telah berhasil memperbarui informasi pelanggan anda');
					if ($this->session->flashdata('redir')) {
						redirect($this->session->flashdata('redir'));
					} else {
						redirect('admin/akun');
					}
				} else {
					$this->session->set_flashdata('error', 'Gagal memperbarui informasi pelanggan');
				}
			} elseif (isset($_FILES['avatar']['name'])) {
				if ($this->upload->do_upload('avatar')) {
					$file =
						$this->upload->data();

					$config['image_library'] = 'gd2';
					$config['source_image'] = './assets/uploads/' . $file['file_name'];
					$config['create_thumb'] = FALSE;
					$config['maintain_ratio'] = FALSE;
					$config['quality'] = '50%';
					$config['width'] = 200;
					$config['height'] = 200;
					$config['new_image'] = './assets/uploads/' . $file['file_name'];
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();

					$this->akun_model->update(
						$this->session->userdata('id'),
						array(
							'nama_depan' 	=> set_value('nama_depan'),
							'nama_belakang' => set_value('nama_belakang'),
							'nomor_telepon' => set_value('nomor_telepon'),
							'province_id'	=> set_value('provinsi'),
							'regency_id'	=> set_value('kota'),
							'district_id'	=> set_value('kecamatan'),
							'tanggal_lahir'	=> set_value('tanggal_lahir'),
							'jenis_kelamin'	=> set_value('jenis_kelamin'),
							'alamat' 		=> set_value('alamat'),
							'kode_pos' 		=> set_value('kode_pos'),
							'avatar' 		=> $file['file_name'],
						)
					);
					redirect('admin/dashboard');
				} else {
					$error = array('error' => $this->upload->display_errors());
					$this->load->view('dashboard/admin/akun', $error);
				}
				# code...
			}
		}
	}

	/*public function keluar()
	{
		$this->session->sess_destroy();
		redirect('akun');
	}*/



	function _cek_tanggal($tanggal)
	{
		if (!checkdate(set_value('bulanlahir'), $tanggal, set_value('tahunlahir'))) {
			$this->form_validation->set_message('cek_tanggal', 'Tanggal yang anda masukkan tidak benar.');
			return FALSE;
		}
		return TRUE;
	}
	public function get_regencies($province_id)
	{
		//$nama2 = str_replace('_', ' ', $nama);
		$query = $this->db->get_where('regencies', array('province_id' => $province_id));
		$data = "<option value=''>Kota / Kabupaten</option>";
		foreach ($query->result() as $value) {
			$data .= "<option value='" . $value->id . "'>" . $value->name . "</option>";
		}
		echo $data;
	}
	public function get_districts($regency_id)
	{
		//$nama2 = str_replace('_', ' ', $nama);
		$query = $this->db->get_where('districts', array('regency_id' => $regency_id));
		$data = "<option value=''>Kecamatan</option>";
		foreach ($query->result() as $value) {
			$data .= "<option value='" . $value->id . "'>" . $value->name . "</option>";
		}
		echo $data;
	}
}