<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('username'))
		{
			$this->load->library('form_validation');
			$this->load->helper('form');
			$this->load->model('pelanggan_model');
		}
		else
		{
			$this->session->set_flashdata('error', "Anda harus masuk untuk melanjutkan");
			$this->session->set_flashdata('redir', uri_string());
			redirect('akun/masuk');
		}
	}

	public function index()
	{
		$info['title'] = "Dashboard Pelanggan";
		$this->load->model('akun_model');
		$this->load->view('frontend/head', $info);
		$this->load->view('frontend/navbar');
		$this->load->view('frontend/breadcrumbs');
		$data['namapelanggan'] = $this->akun_model->get_full_name($this->session->userdata('id'));
		$data['tagihan'] = $this->pelanggan_model->get_unpaid_shopping($this->session->userdata('id'));
		$this->load->view('frontend/pelanggan/dashboard', $data);
		$this->load->view('frontend/footer');
		$this->load->view('frontend/foot');
    }
	
	public function konfirmasi_pembayaran($id = 0)
	{
		$info['title'] = "Konfirmasi Pembayaran";
		$this->load->view('frontend/head', $info);
		$this->load->view('frontend/navbar');

		$this->form_validation->set_rules('invoice_id', 'Nomor tagihan', 'required|integer|greater_than[0]');
		$this->form_validation->set_rules('amount', 'Jumlah transfer', 'required|integer|greater_than[0]');
		$this->form_validation->set_rules('atasnama', 'Dari atas nama', 'required');
		// $this->form_validation->set_rules('confirmation_number', 'Kode konfirmasi', 'max_length[100]');

		if ($this->form_validation->run() == FALSE)
		{
			$this->load->model('akun_model');
			$this->load->model('invoice_model');
			$this->load->model('pemesanan_model');


			if ($this->input->post('invoice_id'))
			{	
				$data['invoice_id'] = set_value('invoice_id');
			}
			else
			{
				$data['invoice_id'] = $id;
			}
			if ($this->input->post('atasnama'))
			{
				$data['namapelanggan'] = set_value('namapelanggan');
			}
			else
			{
				$data['namapelanggan'] = $this->akun_model->get_full_name($this->session->userdata('id'));
			}
			$data['invoice'] = $this->invoice_model->ambil_invoice_id($id);
			$data['pemesanan'] = $this->pelanggan_model->get_pemesanan_by_id($id);
			$data['produk'] = $this->pelanggan_model->get_produk_by_id($id);
			$this->load->view('frontend/pelanggan/konfirmasi_pembayaran', $data);
		}
		else
		{
			$bukti = '';
			if ($_FILES && $_FILES['gambar']['name'])
			{
				if (!$this->pelanggan_model->upload_proof('gambar'))
				{
					$data['error'] = $this->upload->display_errors('<div class="alert alert-warning">Gagal memproses gambar: ', '</div>');
					$this->load->view('frontend/pelanggan/sejarah_belanja', $data);
				}
				else
				{
					$gambar = $this->upload->data();
					$bukti = $gambar['file_name'];
				
					$isValid = $this->pelanggan_model->pay_invoice($this->session->userdata('id'), set_value('invoice_id'), set_value('amount'), $bukti);

					if ($isValid)
					{
						$this->session->set_flashdata('success', 'Terima kasih telah berbelanja, kami akan segera memeriksa konfirmasi pembayaran anda');
						redirect('pelanggan/sejarah_belanja');
					}
					else
					{
						unlink(PAYMENT_UPLOAD_DIRECTORY . $bukti);
						$this->session->set_flashdata('error', 'Maaf, nomor tagihan atau jumlah yang anda masukkan tidak sesuai dengan catatan pembayaran, mohon coba kembali. Pastikan juga apabila anda telah melewati batas waktu tenggat');
						redirect('pelanggan/konfirmasi_pembayaran/' . set_value('invoice_id'));
					}
				}
			}
			else
			{
				$this->session->set_flashdata('error', 'Maaf, terjadi kesalahan dalam pengunggahan gambar bukti, mohon coba kembali');
				redirect('pelanggan/konfirmasi_pembayaran/' . set_value('invoice_id'));
			}
		}

		$this->load->view('frontend/footer');
		$this->load->view('frontend/foot');
	}

	public function batal_belanja($id = 0)
	{
		if ($id != 0)
		{
			$hasil = $this->pelanggan_model->cancel_invoice($this->session->userdata('id'), $id, 'canceled');
			if ($hasil)
			{
				$this->session->set_flashdata('success', 'Anda telah berhasil mengubah status tagihan #<strong>' . $id . '</strong> menjadi <label class="label label-danger">Dibatalkan</label>.');
			}
			else
			{
				$this->session->set_flashdata('error', 'Gagal mengubah status tagihan #<strong>' . $id . '</strong> menjadi <label class="label">Dibatalkan</label>.');
			}
		}
		redirect('pelanggan/sejarah_belanja');
	}

    public function sejarah_belanja()
    {
		$user_id = $this->session->userdata('id');
		$user = $this->session->userdata('username');
		$this->pelanggan_model->mark_invoices_expired($user_id);
		$info['title'] = "Sejarah Belanja";
		$this->load->view('frontend/head', $info);
		$this->load->view('frontend/navbar');
		$this->load->view('frontend/breadcrumbs');
		$data['datatable'] = 'shopHistoryTable';
		$data['history'] = $this->pelanggan_model->get_shopping_history($user);
		$this->load->view('frontend/pelanggan/sejarah_belanja', $data);
		$this->load->view('frontend/footer');
		$this->load->view('frontend/foot', $data);
	}
} 
?>