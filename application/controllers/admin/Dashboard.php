<?php  
defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Dashboard extends CI_Controller
	{
		
	function __construct(){
		parent::__construct();
		$this->load->model('company_profile_model');
		$this->load->model('akun_model');

		if($this->session->userdata('usergroup') <> '2')
		{
			redirect('akun');
		}
	}

		function index(){
			$data['company'] = $this->company_profile_model->ambil_company_id('1');
			$data['user'] =  $this->akun_model->get_user_by_id($this->session->userdata('id'));
			$this->load->view('backend/dashboard',$data);
		}
	}

?>