<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pemesanan extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('usergroup')) {
			$this->load->library('form_validation');
			$this->load->model('pemesanan_model');
			$this->load->model('company_profile_model');
		} else {
			$this->session->set_flashdata('error', "Anda harus masuk untuk melanjutkan");
			$this->session->set_flashdata('redir', uri_string());
			redirect('akun/masuk');
		}
	}

	public function index()
	{
		$this->load->helper('text_helper');
		$this->load->model('akun_model');
		$data['pengguna'] = $this->akun_model->get($this->session->userdata('id'));
		$data['company'] = $this->company_profile_model->ambil_company();
		foreach ($data['company'] as $data1) {
			$data['rekening'] = explode(",", $data1->rekening);
		}
		$info['title'] = 'Periksa Pemesanan';
		$this->load->view('frontend/head', $info);
		$this->load->view('frontend/navbar');
		$this->load->view('frontend/breadcrumbs');

		$data['datatable'] = 'shopCartTable';
		$query = $this->db->get('provinces');
		$data['provinces'] = $query->result();

		$query2 = $this->db->get('provinces');
		$data['provinces'] = $query2->result();

		$this->load->view('frontend/pemesanan/periksa', $data);

		$this->load->view('frontend/footer');
		$this->load->view('frontend/foot', $data);
	}

	public function proses()
	{
		$this->form_validation->set_rules('metode_pembayaran', 'Metode pembayaran', 'required');
		$this->form_validation->set_rules('kurir', 'Kurir', 'required');
		$this->form_validation->set_rules('provinsi', 'Provinsi', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat pengiriman', 'required|max_length[255]');
		$this->form_validation->set_rules('kodepos', 'Kode POS pengiriman', 'required');

		if ($this->form_validation->run() == FALSE) {

			$this->load->helper('text_helper');
			$this->load->model('akun_model');
			$data['pengguna'] = $this->akun_model->get($this->session->userdata('id'));
			$data['company'] = $this->company_profile_model->ambil_company();
			foreach ($data['company'] as $data1) {
				$data['rekening'] = explode(",", $data1->rekening);
			}
			$info['title'] = 'Periksa Pemesanan';
			$this->load->view('frontend/head', $info);
			$this->load->view('frontend/navbar');
			$this->load->view('frontend/breadcrumbs');

			$data['datatable'] = 'shopCartTable';
			$provinsi = $this->db->get('provinces');
			$data['provinces'] = $provinsi->result();
			$this->load->view('frontend/pemesanan/periksa', $data);

			$this->load->view('frontend/footer');
			$this->load->view('frontend/foot', $data);
		} else {
			$metodepembayaran = set_value('metode_pembayaran');
			$jasapengiriman = set_value('kurir');
			$alamat = set_value('alamat');
			$kodepos = set_value('kodepos');
			$total_semua_pembelian = set_value('total_semua_pembelian');
			$tarif = set_value("tarif");

			if ($this->pemesanan_model->proses($metodepembayaran, $jasapengiriman, $alamat, $kodepos, $tarif, $total_semua_pembelian)) {
				$this->cart->destroy();
				$info['title'] = 'Pemesanan Sukses';
				$info['meta'] = array(
					array(
						'name' 		=> 'description',
						'content'	=> 'Pemesanan tanaman hias berhasil, terima kasih telah berbelanja'
					)
				);
				$this->load->view('frontend/head', $info);
				$this->load->view('frontend/navbar');

				$this->load->view('frontend/pemesanan/pemesanan_berhasil');

				$this->load->view('frontend/footer');
				$this->load->view('frontend/foot');
			} else {
				$this->session->set_flashdata('error', 'Terjadi kesalahan dalam melakukan pemesanan, mohon coba kembali');
				redirect('produk/keranjang');
			}
		}
	}

	function _api_ongkir_post($origin, $des, $qty, $cour)
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => "origin=" . $origin . "&destination=" . $des . "&weight=" . $qty . "&courier=" . $cour,
			CURLOPT_HTTPHEADER => array(
				"content-type: application/x-www-form-urlencoded",
				/* masukan api key disini*/
				"key:7ab02cf76cf243a3457dbf774b51499f"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			return $err;
		} else {
			return $response;
		}
	}





	function _api_ongkir($data)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			//CURLOPT_URL => "https://api.rajaongkir.com/starter/province?id=12",
			//CURLOPT_URL => "http://api.rajaongkir.com/starter/province",
			CURLOPT_URL => "http://api.rajaongkir.com/starter/" . $data,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				/* masukan api key disini*/
				"key:7ab02cf76cf243a3457dbf774b51499f"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			return  $err;
		} else {
			//print_r($response);
			return $response;
		}
	}

	function _api_kodepos($data)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			//CURLOPT_URL => "https://api.rajaongkir.com/starter/province?id=12",
			//CURLOPT_URL => "http://api.rajaongkir.com/starter/province",
			CURLOPT_URL => "http://api.rajaongkir.com/starter/" . $data,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				/* masukan api key disini*/
				"key:7ab02cf76cf243a3457dbf774b51499f"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			return  $err;
		} else {
			//print_r($response);
			return $response;
		}
	}


	public function provinsi()
	{

		$provinsi = $this->_api_ongkir('province');
		$data = json_decode($provinsi, true);
		echo json_encode($data['rajaongkir']['results']);
	}


	public function lokasi()
	{
		$this->load->view('head');
		$this->load->view('nav');
		$this->load->view('halaman');
		$this->load->view('footer');
	}

	public function kota($provinsi = "")
	{
		if (!empty($provinsi)) {
			if (is_numeric($provinsi)) {
				$kota = $this->_api_ongkir('city?province=' . $provinsi);
				$data = json_decode($kota, true);
				echo json_encode($data['rajaongkir']['results']);
			} else {
				show_404();
			}
		} else {
			show_404();
		}
	}

	public function kodepos($kota)
	{
		if (!empty($kota)) {
			if (is_numeric($kota)) {
				$kodepos = $this->_api_kodepos('city?id=' . $kota);
				$data = json_decode($kodepos, true);
				echo json_encode($data['rajaongkir']['results']);
			} else {
				show_404();
			}
		} else {
			show_404();
		}
	}

	public function tarif($origin, $des, $qty, $cour)
	{
		$berat = $qty;
		$tarif = $this->_api_ongkir_post($origin, $des, $berat, $cour);
		$data = json_decode($tarif, true);
		echo json_encode($data['rajaongkir']['results']);
	}
}