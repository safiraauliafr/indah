<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_produk extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('usergroup') == 2)
		{
			$this->load->model('Model_produk');
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
		if (isset($_GET['filter']) && ! empty($_GET['filter'])) {

			$filter = $_GET['filter'];
			
			if ($filter == '1') {
				$tgl = $_GET['tanggal'];

				$ket = 'Data Produk Tanggal '.date('d-m-y', strtotime($tgl));
				$url_cetak = 'produk/cetak?filter=1&tahun='.$tgl;
				$produk = $this->Model_produk->view_by_date($tgl);

			} else if ($filter == '2') {
				$bulan = $_GET['bulan'];
				$tahun = $_GET['tahun'];
				$nama_bulan = array('' => 'Januari','Februari','Maret','April','Mei',
											'Juni','Juli','Agustus','September','Oktober','November','Desember');
				$ket = 'Data Produk Bulan '.$nama_bulan[$bulan].''.$tahun;
				$url_cetak = 'produk/cetak?filter=2&bulan='.$bulan.'&tahun='.$tahun;
				$produk = $this->Model_produk->view_by_month($bulan, $tahun);
			
			} 

		} else {
			$ket = 'Semua Data Produk';
			$url_cetak = 'produk/cetak';
			$produk = $this->Model_produk->view_all();

		}

		$data['ket'] = $ket;
		$data['url_cetak'] = base_url('index.php/'.$url_cetak);
		$data['produk'] = $produk;
		$data['option_tahun'] = $this->Model_produk->option_tahun();

		$this->load->view('view', $data);
	}

	public function cetak(){
		if (isset($_GET['filter']) && ! empty($_GET['filter'])) {
			
			$filter = $_GET['filter'];

			if ($filter == '1') {
				
				$tgl = $_GET['tanggal'];

				$ket = 'Data Transaksi Tanggal '.date('d-m-y', strtotime($tgl));
				$produk = $this->Model_produk->view_by_date($tgl);
			
			} else if ($filter == '2') {
				
				$bulan = $_GET['bulan'];
				$tahun = $_GET['tahun'];
				$nama_bulan = array('' => 'Januari','Februari','Maret','April','Mei',
											'Juni','Juli','Agustus','September','Oktober','November','Desember');
				$ket = 'Data Transaksi Bulan '.$nama_bulan[$bulan].''.$tahun;
				$produk = $this->Model_produk->view_by_month($bulan, $tahun);
			
			} 
		
		} else {
			$ket = 'Semua Data Transaksi';
			$transaksi = $this->Model_produk->view_all();
		}
	
		$data['ket'] = $ket;
		$data['transaksi'] = $transaksi;

		ob_start();
		$this->load->view('print', $data);
		$html = ob_get_contents();
				ob_end_clean();


				require_once('./assets/html2pdf/html2pdf.class.php');

			$pdf = new HTML2PDF('P','A4','en');
			$pdf->WriteHTML($html);
			$pdf->Output('Data Transaksi.pdf', 'D');

	}
}
