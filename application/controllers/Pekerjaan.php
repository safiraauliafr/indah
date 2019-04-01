<?php  
defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Pekerjaan extends CI_Controller
	{

		function __construct(){
			parent::__construct();	
			$this->load->helper('template_helper');	
			$this->load->model('pekerjaan_model');
			$this->load->model('user_model');
			$this->load->model('assets_model');	
			$this->load->model('tempat_model');
			$this->load->model('department_model');
			$this->load->model('brand_model');
			$this->load->model('company_profile_model');
			$this->load->library('session');
		}

	function index(){
		$data = array(
				'pekerjaan' => $this->pekerjaan_model->ambil_pekerjaan(),
				'department' => $this->department_model->ambil_department(),
				'deadline_pekerjaan' => $this->pekerjaan_model->ambil_deadline_pekerjaan(),
				'tempat' => $this->tempat_model->ambil_tempat(),
				'brand' => $this->brand_model->ambil_brand(),
				'assets' => $this->assets_model->ambil_asset(),
				'users' => $this->user_model->ambil_user_by_level('teknisi'),
						);
		$pekerjaan = $this->pekerjaan_model->ambil_deadline_pekerjaan();
		/*foreach ($pekerjaan as $pekerjaan1) {
			if ($this->pekerjaan_model->ambil_deadline_pekerjaan()) {
			$config = Array(
				  'protocol' => 'smtp',
				  'smtp_host' => 'ssl://smtp.googlemail.com',//,
				  'smtp_port' => 465,
				  'smtp_user' => 'arinur360@gmail.com',
				  'smtp_pass' => 'rasta203',
				);
				  $this->load->library('email', $config);
				  $this->email->set_newline("\r\n");
				  $this->email->from('arinur203@gmail.com', 'arinur360');
				  $this->email->to($pekerjaan1->email);
				  $this->email->subject($pekerjaan1->deskripsi);
				  $this->email->message("Nama Brand : ".$pekerjaan1->nama_brand."\n"."Nama Lokasi : ".$pekerjaan1->nama_lokasi);
				  if (!$this->email->send()) {
				  	//echo $pekerjaan1->email;

				   show_error($this->email->print_debugger()); 
				  }
				  else {
				    echo 'Your e-mail has been sent!';
		}
	}
		}*/
		/*if ($this->pekerjaan_model->ambil_deadline_pekerjaan()) {
			$config = Array(
				  'protocol' => 'smtp',
				  'smtp_host' => 'ssl://smtp.googlemail.com',//,
				  'smtp_port' => 465,
				  'smtp_user' => 'arinur203@gmail.com',
				  'smtp_pass' => '123456',
				);
				  $this->load->library('email', $config);
				  $this->email->set_newline("\r\n");
				  $this->email->from('arinur203@gmail.com', 'arinur203');
				  $this->email->to('arinur360@gmail.com');
				  $this->email->subject('coba');
				  $this->email->message('Ajaaa');
				  if (!$this->email->send()) {
				    show_error($this->email->print_debugger()); }
				  else {
				    echo 'Your e-mail has been sent!';
		}
	}*/
			$this->load->view('dashboard/operator/pekerjaan' , $data);		
		
	}
	/*public function tambah_pekerjaan2(){
		$data = array(
				'pekerjaan' => $this->pekerjaan_model->ambil_pekerjaan(),
				'deadline_pekerjaan' => $this->pekerjaan_model->ambil_deadline_pekerjaan(),
				'tempat' => $this->tempat_model->ambil_tempat(),
				'assets' => $this->assets_model->ambil_asset(),
				'users' => $this->user_model->ambil_user_by_level('teknisi'),
						);
			
			$post = $this->input->post();

			/*$data = array(
							'deskripsi' =>$post['deskripsi'],
							'nama_pekerja' => $post['nama_pekerja'],
							'nama_asset' =>$post['nama_aset'],
							'nama_brand' => $post['nama_brand'],
							'nama_lokasi' =>$post['nama_lokasi'],
							'tanggal_mulai' => $post['tanggal_mulai'],
							'tanggal_selesai' =>$post['tanggal_selesai'],
						);
			$this->pekerjaan_model->tambah_pekerjaan('tbl_pekerjaan' , $data);*/
			//$email = $this->user_model->ambil_user_with_name($post['nama_pekerja']);
		//	foreach ($email as $email1) {
			
			/*$config = Array(
				  'protocol' => 'smtp',
				  'smtp_host' => 'ssl://smtp.googlemail.com',//,
				  'smtp_port' => 465,
				  'smtp_user' => 'arinur360@gmail.com',
				  'smtp_pass' => 'rasta203',
				);
				  $this->load->library('email', $config);
				  $this->email->set_newline("\r\n");
				  $this->email->from('arinur203@gmail.com', 'arinur360');
				  $this->email->to('arinur360@gmail.com');
				  $this->email->subject("test");
				  $this->email->message("123");
				  if (!$this->email->send()) {
				  	//echo $pekerjaan1->email;

				   show_error($this->email->print_debugger()); 
				  }
				  else {
				    echo 'Your e-mail has been sent!';
				    redirect('operator/pekerjaan');
		}
	//}
	$this->load->view('dashboard/operator/tambah_pekerjaan' , $data);
		}*/

	public function tambah_pekerjaan(){
			$post = $this->input->post();

			$data = array(
							'deskripsi' =>$post['deskripsi'],
							'nama_pekerja' => $post['nama_pekerja'],
							'nama_asset' =>$post['nama_aset'],
							'nama_brand' => $post['nama_brand'],
							'nama_department' => $post['nama_department'],
							'nama_lokasi' =>$post['nama_lokasi'],
							'tanggal_mulai' => $post['tanggal_mulai'],
							'tanggal_selesai' =>$post['tanggal_selesai'],
							'status' =>'Belum Selesai',

						);
			$this->pekerjaan_model->tambah_pekerjaan('tbl_pekerjaan' , $data);
			$email = $this->user_model->ambil_user_with_name($post['nama_pekerja']);
			foreach ($email as $email1) {
				$config = Array(
				  'protocol' => 'smtp',
				  'smtp_host' => 'ssl://smtp.googlemail.com',//,
				  'smtp_port' => 465,
				  'smtp_user' => 'simmedisku@gmail.com',
				  'smtp_pass' => '@bcd1234',
				);
				  $this->load->library('email', $config);
				  $this->email->set_newline("\r\n");
				  $this->email->from('simmedisku@gmail.com', 'simmedisku@gmail.com');
				  $this->email->to($email1->email);
				  $this->email->subject($post['deskripsi']);
				  $this->email->message($post['nama_aset']);
				  echo $this->email->print_debugger();
				  if (!$this->email->send()) {
				  	//echo $pekerjaan1->email;

				   show_error($this->email->print_debugger()); 
				  }
				  else {
				    echo 'Your e-mail has been sent!';
		}
		
			}
			echo $email;


			echo json_encode(array("status" => TRUE));
			redirect('operator/pekerjaan');
		}
	public function hapus_pekerjaan($pekerjaan_id=0){
        $this->pekerjaan_model->hapus_pekerjaan($pekerjaan_id , 'tbl_pekerjaan');
       	echo json_encode(array("status" => TRUE));
    }
    public function edit_pekerjaan($id){
			$data = $this->pekerjaan_model->ambil_pekerjaan_id($id);
			echo json_encode($data);
		}
    public function update_pekerjaan(){
    		$post = $this->input->post();
			$data = array(
							'deskripsi' =>$post['deskripsi'],
							'nama_pekerja' => $post['nama_pekerja'],
							'nama_asset' =>$post['nama_aset'],
							'nama_brand' => $post['nama_brand'],
							'nama_department' => $post['nama_department'],
							'nama_lokasi' =>$post['nama_lokasi'],
							'tanggal_mulai' => $post['tanggal_mulai'],
							'tanggal_selesai' =>$post['tanggal_selesai'],
							'status' =>'Belum Selesai',
						);
		$this->pekerjaan_model->update_pekerjaan(array('pekerjaan_id' => $this->input->post('pekerjaan_id')), $data);
		echo json_encode(array("status" => TRUE));
    	}

   	public function tampil_brand($nama){
   	//$nama2 = str_replace('_', ' ', $nama);
      $query = $this->db->get_where('tbl_asset',array('nama'=>$nama));
      $data = "<option value=''>-- Pilih Brand --</option>";
      foreach ($query->result() as $value) {
          $data .= "<option value='".$value->brand."'>".$value->brand."</option>";
      }
      echo $data;
  }	
    function cetakpdf() {
       	$this->load->library('pdf');
       	$data['company'] = $this->company_profile_model->ambil_company();
       	$data['pekerjaan'] = $this->pekerjaan_model->ambil_pekerjaan();

        $html = $this->load->view('dashboard/operator/cetak/cetak_pekerjaan', $data, true);
	    }
	}
?>