<?php  
defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Pemesanan extends CI_Controller
	{
		
	function __construct(){
		parent::__construct();
		$this->load->model('invoice_model');
		$this->load->model('pemesanan_model');
		$this->load->model('company_profile_model');



		if($this->session->userdata('usergroup') <> '2')
		{
			redirect('akun');

		}
	}

		function index(){
			$data['company'] = $this->company_profile_model->ambil_company_id('1');
			$data['invoice'] = $this->invoice_model->ambil_invoice_confirm();
			$this->load->view('backend/pemesanan' , $data);
		}
		public function lihat_invoice($id){
			$data = $this->invoice_model->get_pemesanan_confirm($id);
			echo json_encode($data);
		}
		function update_stok($id_invoice){
			$post = $this->input->post();
			$data = array(
							'status_terjual' =>'1'
						);
		$this->invoice_model->update_stok(array('invoice_id' => $id_invoice, $data));
			redirect()
		}
	}

?>