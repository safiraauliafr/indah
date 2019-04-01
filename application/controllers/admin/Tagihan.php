<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tagihan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('usergroup') == 2)
		{
			$this->load->model('pemesanan_model');
			$this->load->model('invoice_model');
			$this->load->model('produk_model');
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
		$info['title'] = 'ADMIN | Daftar Pemesanan';
		$info['meta'] = array(
			array(
				'name' 		=> 'description',
				'content'	=> 'Kelola tagihan dan pemesanan'
			)
		);
		$data['tagihan'] = $this->pemesanan_model->get_all();
		$data['datatable'] = 'orderTable';
		$data['user'] =  $this->akun_model->get_user_by_id($this->session->userdata('id'));
		$data['company'] = $this->company_profile_model->ambil_company_id('1');
		$this->load->view('backend/konfirmasi_pembayaran', $data);
		}

    public function detail($id)
    {
		$this->load->model('akun_model');
        if (empty($id))
        {
            redirect('admin/tagihan');
            return;
        }
        $info['title'] = 'ADMIN | Detil Pemesanan';
        $data['tagihan'] = $this->pemesanan_model->get_invoice_by_id($id);
		$data['pemesanan'] = $this->pemesanan_model->get_orders_by_invoice($id);
		$data['pemesan'] = $this->akun_model->get($data['tagihan']->id_pengguna);
		$data['produk'] = $this->pemesanan_model->get_produk_by_id($id);
		$data['datatable'] = 'ordersTable';
		$data['company'] = $this->company_profile_model->ambil_company_id('1');
		$data['user'] =  $this->akun_model->get_user_by_id($this->session->userdata('id'));
		$this->load->view('backend/detail_konfirmasi', $data);
		}
	
	public function konfirmasi($invoice_id = 0)
	{
		if (!empty($invoice_id))
		{
			$this->load->library('form_validation');
			$this->load->model('akun_model');
			$this->load->model('produk_model');
			$this->load->model('pelanggan_model');

			$this->form_validation->set_rules('jasapengiriman', 'Jasa pengiriman', 'required|in_list[JNE,Tiki,J&T,Wahana]');
			$this->form_validation->set_rules('nomorpengiriman', 'Nomor pengiriman', 'trim|required|alpha_dash|max_length[32]');
			if ($this->form_validation->run() == FALSE)
			{
				$info['title'] = 'ADMIN | Kirim Pesanan';
				$data['tagihan'] = $this->pemesanan_model->get_invoice_by_id($invoice_id);
				$data['pengiriman'] = $this->pemesanan_model->get_shipping_by_invoice($invoice_id);
				$data['pemesan'] = $this->akun_model->get($data['tagihan']->id_pengguna);
				$data['datatable'] = 'ordersTable';
				$data['user'] =  $this->akun_model->get_user_by_id($this->session->userdata('id'));
				$data['company'] = $this->company_profile_model->ambil_company_id('1');
				$this->load->view('backend/pengiriman', $data);
			}
			else
			{
				$hasil = $this->pemesanan_model->kirim($invoice_id, set_value('jasapengiriman'), set_value('nomorpengiriman')) AND $this->pemesanan_model->set_invoice_status($invoice_id, 'confirmed');

				/*$produk = array(
					'stok'			=>	,
					'terjual'		=>	set_value('harga'),
					'persediaan'	=>	set_value('persediaan'),
					'berat'			=>	set_value('berat'),
					'panjang'		=>	set_value('panjang'),
					'lebar'			=>	set_value('lebar'),
					'tinggi'		=>	set_value('tinggi'),
					'deskripsi'		=>	set_value('deskripsi')
				);

				$this->produk_model->update($id_produk , )*/

				if ($hasil)
				{
					$this->session->set_flashdata('success', 'Anda telah berhasil mengubah status tagihan #<strong>' . $invoice_id . '</strong> menjadi <label class="label label-primary">Dikirim</label>.');
				}
				else
				{
					$this->session->set_flashdata('error', 'Gagal mengubah status tagihan #<strong>' . $invoice_id . '</strong> menjadi <label class="label">Dikirim</label>.');
				}
				return redirect('admin/tagihan');
			}
		}
		else
		{
			return redirect('admin/tagihan');
		}
	}

	public function batal($invoice_id)
	{
		if (!empty($invoice_id))
		{
			$hasil = $this->pemesanan_model->set_invoice_status($invoice_id, 'canceled');
			if ($hasil)
			{
				$this->session->set_flashdata('success', 'Anda telah berhasil mengubah status tagihan #<strong>' . $invoice_id . '</strong> menjadi <label class="label label-danger">Dibatalkan</label>.');
			}
			else
			{
				$this->session->set_flashdata('error', 'Gagal mengubah status tagihan #<strong>' . $invoice_id . '</strong> menjadi <label class="label">Dibatalkan</label>.');
			}
		}
		return redirect('admin/tagihan');
	}

	public function hapus($invoice_id)
	{
		if (!empty($invoice_id))
		{
			$hasil = $this->pemesanan_model->delete_invoice($invoice_id);
			if ($hasil)
			{
				$this->session->set_flashdata('success', 'Anda telah berhasil menghapus tagihan #<strong>' . $invoice_id . '</strong> secara permanen.');
			}
			else
			{
				$this->session->set_flashdata('error', 'Gagal menghapus tagihan #<strong>' . $invoice_id . '</strong>.');
			}
		}
		return redirect('admin/tagihan');
	}
	function update_stok($id_invoice){
		$data = array(
							'status_terjual' =>'1'
						);
		$this->invoice_model->update_invoice($id_invoice, $data);

		$produk_model = $this->pemesanan_model->get_produk_by_id($id_invoice);


		$jumlahArray= array();
		$terjualArray= array();
		$persediaanArray= array();
		$id_produkArray= array();
		$updateArray = array();
		foreach ($produk_model as $produk_item) {
			$jumlah = $produk_item->jumlah;
			$terjual = $produk_item->terjual;
			$persediaan = $produk_item->persediaan;
			$id_produk = $produk_item->id_produk;
			
			array_push($jumlahArray, $jumlah);
			array_push($terjualArray, $terjual);
			array_push($persediaanArray, $persediaan);
			array_push($id_produkArray, $id_produk);
		}
			for ($i=0; $i <count($id_produkArray) ; $i++) { 
				  $updateArray [] = array(
				  	'id_produk' 	=> $id_produkArray[$i],
			        'terjual' 		=> $terjualArray[$i] + $jumlahArray[$i],
			        'persediaan' 	=> $persediaanArray[$i] - $jumlahArray[$i],
			    );
			}
		$this->db->update_batch('produk',$updateArray, 'id_produk'); 

		redirect("admin/tagihan");
		}

}
?>