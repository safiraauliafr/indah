<?php  
defined('BASEPATH') OR exit('No direct script access allowed');
	
	class User extends CI_Controller
	{
		
	function __construct(){
		parent::__construct();
		$this->load->model('akun_model');
		$this->load->model('company_profile_model');
		$this->load->helper('form');
		$this->load->library('form_validation');


		if($this->session->userdata('usergroup') <> '2')
		{
			redirect('login');
		}
	}

	function index(){
			$provinsi = $this->db->get('provinces');
			$data = array(
					'user' => $this->akun_model->get_all_user(),
					'userlogin' =>  $this->akun_model->get_user_by_id($this->session->userdata('id')),
					'provinces' =>   $this->akun_model->get_all_province(),
					'company' =>  $this->company_profile_model->ambil_company_id('1'),

					);
			
			$this->load->view('backend/user/index' , $data);
		}
	public function tambah()
	{

		$this->form_validation->set_rules('namadepan', 'Nama depan', 'trim|required|max_length[64]');
		$this->form_validation->set_rules('namabelakang', 'Nama belakang', 'trim|max_length[64]');
		$this->form_validation->set_rules('nama', 'Nama pengguna', 'trim|required|valid_email|max_length[64]|is_unique[pengguna.nama]', ['is_unique' => 'Nama pengguna atau alamat email sudah terdaftar']);
		$this->form_validation->set_rules('nomortelepon', 'Nomor telepon', ['trim', 'required', 'regex_match[/^(\+|[0])[0-9]+$/]']);
		$this->form_validation->set_rules('password', 'Kata sandi', 'trim|required|min_length[6]|max_length[32]');
		$this->form_validation->set_rules('konfirmasipassword', 'Konfirmasi kata sandi', 'trim|required|matches[password]');
		$this->form_validation->set_rules('bulanlahir', 'Tanggal lahir', 'required|is_natural_no_zero|greater_than_equal_to[1]|less_than_equal_to[12]');
		$this->form_validation->set_rules('tahunlahir', 'Tanggal lahir', ['required', 'is_natural', sprintf('greater_than_equal_to[%d]', date('Y', 0)), sprintf('less_than_equal_to[%d]', date('Y'))]);
		$this->form_validation->set_rules('tanggallahir', 'Tanggal lahir', 'required|is_natural_no_zero|greater_than_equal_to[1]|less_than_equal_to[31]');
		$this->form_validation->set_rules('jeniskelamin', 'Jenis kelamin', 'required|in_list[L,P]');

		if ($this->form_validation->run() == FALSE)
		{
			$info['title'] = 'Mendaftar';
			$provinsi = $this->db->get('provinces');
			$data['provinces'] = $provinsi->result();
			$data['company'] = $this->company_profile_model->ambil_company_id('1');
			$data['user'] =  $this->akun_model->get_user_by_id($this->session->userdata('id'));
			$this->load->view('backend/user/tambah' , $data);
		}
		else
		{
			$username = set_value('nama');
			$usergroup = set_value('grup');
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
					'province_id' => set_value('provinsi'),
					'regency_id' => set_value('kota'),
					'district_id' => set_value('kecamatan'),
					'kode_pos' => set_value('kode_pos'),
					'nomor_telepon' => set_value('nomortelepon'),
					'alamat' => set_value('alamat'),
					'tanggal_lahir' => date('Y-m-d', mktime(0, 0, 0, set_value('bulanlahir'), set_value('tanggallahir'), set_value('tahunlahir'))),
					'tanggal_daftar' => date('Y-m-d H:i:s')
				)
			);
			redirect('admin/user');
		}
	}

	public function edit($user_id)
	{
		$row = $this->akun_model->get_user_by_id($user_id);
		foreach ($row as $row1) {
			$data['province_id'] = $row1->province_id;
			$data['regency_id'] = $row1->regency_id;		
			$data['district_id'] = $row1->district_id;
			$data['jenis_kelamin'] = $row1->jenis_kelamin;				
		}
		$data['province' ] =  $this->akun_model->get_all_province();
		$data['user'] =  $this->akun_model->get_user_by_id($user_id);
		$data['dd_province'] = $this->akun_model->get_all_province();
		$data['dd_regency'] =  $this->akun_model->get_regency_by_id($data['province_id']);
		$data['dd_district'] =  $this->akun_model->get_district_by_id($data['regency_id']);
		$data['company'] = $this->company_profile_model->ambil_company_id('1');
		$this->load->view('backend/user/edit' , $data);
		
	}
	public function update(){
		$this->form_validation->set_rules('email', 'Alamat Email', 'trim|required|valid_email|max_length[64]');
		$this->form_validation->set_rules('password', 'Kata sandi', 'trim|required|min_length[6]|max_length[32]');
		$this->form_validation->set_rules('newpassword', 'Kata sandi baru', 'trim|required|min_length[6]|max_length[32]|differs[password]');
		$this->form_validation->set_rules('confirmpassword', 'Konfirmasi kata sandi baru', 'trim|required|min_length[6]|max_length[32]|matches[newpassword]');

		if ($this->form_validation->run() == FALSE){
			redirect('admin/user/index/');
		}else{
			$password = set_value('password');
			$newpassword = set_value('newpassword');
			$confirmnewpassword = set_value('confirmpassword');
			
				$updated = FALSE;
				$salt = uniqid('$6$');
				$newpassword = hash('sha512', $newpassword.$salt);
				$updated = $this->akun_model->update(	
					set_value('id'),
					array(
						'nama'		=> set_value('email'),
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
				redirect('admin/user/index');

		}
	}
	public function perbaharui_akun()
	{
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[64]');
		$this->form_validation->set_rules('password', 'Kata sandi', 'trim|required|min_length[6]|max_length[32]');
		$this->form_validation->set_rules('newpassword', 'Kata sandi baru', 'trim|required|min_length[6]|max_length[32]|differs[password]');
		$this->form_validation->set_rules('confirmpassword', 'Konfirmasi kata sandi baru', 'trim|required|min_length[6]|max_length[32]|matches[newpassword]');

		if ($this->form_validation->run() == TRUE)
		{
			$password = set_value('password');
			$newpassword = set_value('newpassword');
			$confirmnewpassword = set_value('confirmpassword');
			$userdata = $this->akun_model->periksa_kredensial();
			if ($userdata !== NULL && $userdata->id_pengguna == set_value('id'))
			{
				$updated = FALSE;
				$salt = uniqid('$6$');
				$newpassword = hash('sha512', $newpassword.$salt);
				$updated = $this->akun_model->update(	
					set_value('id'),
					array(
						'nama'		=> set_value('email'),
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
		return redirect('admin/dashboard');
	}
	public function perbaharui_profil(){
		if (!$this->session->has_userdata('id'))
		{
			$this->session->set_flashdata('error', "Anda harus masuk untuk melanjutkan");
			$this->session->set_flashdata('redir', uri_string());
			redirect('akun/masuk');
		}

		$this->form_validation->set_rules('nama_depan', 'Nama depan', 'trim|required|max_length[64]');
		$this->form_validation->set_rules('nama_belakang', 'Nama belakang', 'trim|max_length[64]');
		$this->form_validation->set_rules('nomor_telepon', 'Nomor telepon', ['trim', 'required', 'regex_match[/^(\+|[0])[0-9]+$/]']);
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'required|is_natural|max_length[2]');
		$this->form_validation->set_rules('alamat', 'Alamat utama', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('kode_pos', 'Kode pos utama', 'trim|required|is_natural|max_length[8]');

		$config['upload_path'] = './assets/uploads/'.set_value('avatar'); //path folder
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp'; 
        $config['max_size'] = '0'; //maksimum besar file 2M
        $config['file_name'] = set_value('avatar'); //nama yang terupload nantinya
        $this->load->library('upload' , $config);
        $this->upload->initialize($config);


		if ($this->form_validation->run() == FALSE)
		{
			$this->session->keep_flashdata('redir');
			$info['title'] = 'Pengaturan Pengguna';
			$data['akun'] = $this->akun_model->get($this->session->userdata('id'));
			$provinsi = $this->db->get('provinces');
			$data['provinces'] = $provinsi->result();
			$data['company'] = $this->company_profile_model->ambil_company_id('1');
			$this->load->view('backend/user/edit', $data);
		}
		else
		{
	        if(empty($_FILES['avatar']['name'])){
        	$updated = FALSE;
			$updated = $this->akun_model->update(
				$this->session->userdata('id'),
				array(
					'nama_depan' 	=> set_value('nama_depan'),
					'nama_belakang' => set_value('nama_belakang'),
					'nomor_telepon' => set_value('nomor_telepon'),
					'grup'			=> set_value('grup'),
					'province_id'	=> set_value('provinsi'),
					'regency_id'	=> set_value('kota'),
					'district_id'	=> set_value('kecamatan'),
					'tanggal_lahir'	=> set_value('tanggal_lahir'),
					'jenis_kelamin'	=> set_value('jenis_kelamin'),
					'alamat' 		=> set_value('alamat'),
					'kode_pos' 		=> set_value('kode_pos')
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
					redirect('admin/user');
				}
			}
			else
			{
				$this->session->set_flashdata('error', 'Gagal memperbarui informasi pelanggan');
			}
        }elseif (isset($_FILES['avatar']['name'])) {
        	if ($this->upload->do_upload('avatar')){
        		$config['image_library']='gd2';
                $config['source_image']='./assets/uploads/'.set_value('avatar');
                $config['create_thumb']= FALSE;
                $config['maintain_ratio']= FALSE;
                $config['quality']= '50%';
                $config['width']= 200;
                $config['height']= 200;
                $config['new_image']= './assets/uploads/'.set_value('avatar');
                $this->load->library('image_lib', $config);
                $this->image_lib->resize();

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
					'alamat' 		=> set_value('alamat'),
					'kode_pos' 		=> set_value('kode_pos'),
					'avatar' 		=> set_value('avatar'),
				)
			);

            }else{
		          $error = array('error' => $this->upload->display_errors());
		          print_r($error);         
		      }
        	# code...
        }
			
		}
	}
	public function hapus($user_id)
	{
		if (!empty($user_id))
		{
			$hasil = $this->akun_model->delete($user_id);
			if ($hasil)
			{
				$this->session->set_flashdata('success', 'Anda telah berhasil menghapus tagihan #<strong>' . $user_id . '</strong> secara permanen.');
			}
			else
			{
				$this->session->set_flashdata('error', 'Gagal menghapus tagihan #<strong>' . $user_id . '</strong>.');
			}
		}
		return redirect('admin/user/index');
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