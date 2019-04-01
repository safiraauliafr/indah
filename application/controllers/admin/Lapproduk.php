<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lapproduk extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('usergroup') == 2)
		{
			$this->load->model('laporantrans_model');
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

	public function cetak(){
		$this->load->library('pdf');
		$this->load->view('backend/cetak_produk');
	}
	
	public function index()
	{
		$this->load->view('backend/cetak_produk');
	}
		public function transaksi($from, $to)
	{
		$this->load->model('laporantrans_model');
		$dt['transaksi'] 	= $this->laporantrans_model->laporan_transaksi($from, $to);
		$dt['from']			= date('d F Y', strtotime($from));
		$dt['to']			= date('d F Y', strtotime($to));
		$this->load->view('backend/laporan_transaksi', $dt);
	}

	public function excel($from, $to)
	{
		$this->load->model('laporantrans_model');
		$transaksisi 	= $this->laporantrans_model->laporan_transaksi($from, $to);
		if($transaksi->num_rows() > 0)
		{
			$filename = 'Laporan_Transaksi_'.$from.'_'.$to;
			header("Content-type: application/x-msdownload");
			header("Content-Disposition: attachment; filename=".$filename.".xls");

			echo "
				<h4>Laporan Transaksi Tanggal ".date('d/m/Y', strtotime($from))." - ".date('d/m/Y', strtotime($to))."</h4>
				<table border='1' width='100%'>
					<thead>
						<tr>
							<th>No</th>
							<th>Tanggal</th>
							<th>Total Transaksi</th>
						</tr>
					</thead>
					<tbody>
			";

			$no = 1;
			$total_transaksi = 0;
			foreach($transaksi->result() as $t)
			{
				echo "
					<tr>
						<td>".$no."</td>
						<td>".date('d F Y', strtotime($t->tanggal))."</td>
						<td>Rp. ".str_replace(",", ".", number_format($t->total_transaksi))."</td>
					</tr>
				";

				$total_transaksi = $total_transaksi + $p->total_transaksi;
				$no++;
			}

			echo "
				<tr>
					<td colspan='2'><b>Total Seluruh Transaksi</b></td>
					<td><b>Rp. ".str_replace(",", ".", number_format($total_transaksi))."</b></td>
				</tr>
			</tbody>
			</table>
			";
		}
	}

	public function pdf($from, $to)
	{
		$this->load->library('cfpdf');
					
		$pdf = new FPDF();
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',10);

		$pdf->SetFont('Arial','',10);
		$pdf->Cell(0, 8, "Laporan Transaksi Tanggal ".date('d/m/Y', strtotime($from))." - ".date('d/m/Y', strtotime($to)), 0, 1, 'L'); 

		$pdf->Cell(15, 7, 'No', 1, 0, 'L'); 
		$pdf->Cell(85, 7, 'Tanggal', 1, 0, 'L');
		$pdf->Cell(85, 7, 'Total Transaksi', 1, 0, 'L'); 
		$pdf->Ln();

		$this->load->model('laporantrans_model');
		$transaksi 	= $this->laporantrans_model->laporan_transaksi($from, $to);

		$no = 1;
		$total_transaksi = 0;
		foreach($transaksi->result() as $t)
		{
			$pdf->Cell(15, 7, $no, 1, 0, 'L'); 
			$pdf->Cell(85, 7, date('d F Y', strtotime($t->tanggal)), 1, 0, 'L');
			$pdf->Cell(85, 7, "Rp. ".str_replace(",", ".", number_format($p->total_transaksi)), 1, 0, 'L');
			$pdf->Ln();

			$total_transaksi = $total_transaksi + $p->total_transaksi;
			$no++;
		}

		$pdf->Cell(100, 7, 'Total Seluruh Transaksi', 1, 0, 'L'); 
		$pdf->Cell(85, 7, "Rp. ".str_replace(",", ".", number_format($total_transaksi)), 1, 0, 'L');
		$pdf->Ln();

		$pdf->Output();
	}
	public function cetak(){
		$this->load->library('pdf');
		$this->load->view('backend/cetak_produk');
	}
}