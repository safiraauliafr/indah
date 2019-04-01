<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelanggan_model extends CI_Model
{
	
	public function __construct()
	{
		$this->load->database();
    }
    
    public function get_shopping_history($user)
    {
        $hasil = $this->db
                    ->select('i.*, SUM(o.jumlah * o.biaya) AS total , a.nomor_resi')
                    ->from('invoice i, pengguna u, pemesanan o , pengiriman a')
                    ->where('u.nama', $user)
                    ->where('u.id_pengguna = i.id_pengguna')
                    ->where('o.id_invoice = i.id_invoice')
                    ->order_by('i.tanggal DESC', 'i.id_invoice DESC')
                    ->group_by('o.id_invoice')
                    ->get();
        return $hasil->result();
    }

    public function get_unpaid_shopping($user_id)
    {
        $hasil = $this->db
                    ->select('t.*, SUM(p.jumlah * p.biaya) AS total, b.gambar')
                    ->from('invoice t, pemesanan p, produk b')
                    ->where('t.status', 'unpaid')
                    ->where('t.id_pengguna', $user_id)
                    ->where('p.id_invoice', $user_id)
                    ->where('p.id_produk = b.id_produk')
                    ->order_by('t.tanggal DESC', 't.id_invoice DESC')
                    ->group_by('p.id_invoice')
                    ->get();
        return $hasil->result();
    }

    public function get_active_invoice_count($user_id)
    {
        $hasil = $this->db
                ->select('COUNT(*)')
                ->where('id_pengguna', $user_id)
                ->where('tenggat <', date('Y-m-d H:i:s'))
                ->or_group_start()
                    ->where('status', 'paid')
                    ->where('status', 'confirmed')
                ->group_end()
                ->get();
        return $hasil->row();
    }

    public function mark_invoices_expired($user_id)
    {
        return $this->db
                ->where('id_pengguna', $user_id)
                ->where('tenggat <', date('Y-m-d H:i:s'))
                ->where('status', 'unpaid')
                ->set('status', 'expired')
                ->update('invoice');
    }

    public function pay_invoice($user_id, $invoice_id, $amount, $proof)
    {
        $ret = FALSE;
        $invoice = $this->db
                    ->where('id_invoice',$invoice_id)
                    ->where('id_pengguna', $user_id)
                    ->where('status !=', 'expired')
                    ->limit(1)
                    ->get('invoice');
        if ($invoice->num_rows())
        {
            $total = $this->db->select('total_belanja as total')
                                ->where('id_invoice',$invoice_id)
                                ->get('invoice');
            if ($total->row()->total == $amount)
            {
                $ret = $this->db
                    ->where('id_invoice', $invoice_id)
                    ->where('id_pengguna', $user_id)
                    ->set('status', 'paid')
                    ->set('bukti_pembayaran', $proof)
                    ->update('invoice');
            }
        }
        return $ret;
    }

    public function cancel_invoice($user_id, $invoice_id)
    {
        return $this->db
                ->where('id_invoice', $invoice_id)
                ->where('id_pengguna', $user_id)
                ->where('status', 'unpaid')
                ->set('status', 'canceled')
                ->limit(1)
                ->update('invoice');
    }

    public function mark_invoice_confirmed($user_id, $invoice_id, $amount, $proof)
    {
        return $this->db
                ->where('id_invoice',$invoice_id)
                ->where('id_pengguna', $user_id)
                ->set('status', 'confirmed')
                ->limit(1)
                ->update('invoice');
    }

    
    function upload_proof($image)
	{
		$config['upload_path']          = './' . PAYMENT_UPLOAD_DIRECTORY;
		$config['allowed_types']        = 'jpg|jpeg|png';
		$config['max_size']             = 2048; // 2048 KB = 2 MB
		$config['max_filename']			= 250; // + 3 digits (100) CI increment

        if (!is_dir($config['upload_path']))
        {
            mkdir($config['upload_path']);
        }

		$this->load->library('upload', $config);

		return $this->upload->do_upload($image);
	}
      public function get_pemesanan_by_id($invoice_id)
        {
            $this->db->select("*");
            $this->db->from('pemesanan');
            $this->db->where('id_invoice',$invoice_id);
            $query = $this->db->get();

            return $query->result();
        }
        public function get_produk_by_id($invoice_id)
        {
            $this->db->select("*");
            $this->db->from('pemesanan');
            $this->db->join('produk' , 'produk.id_produk = pemesanan.id_produk');
            $this->db->where('pemesanan.id_invoice',$invoice_id);
            $query = $this->db->get();

            return $query->result();
        }
        public function get_pengiriman_by_id($invoice_id)
        {
            $this->db->select("nomor_resi");
            $this->db->from('invoice');
            $this->db->join('pengiriman' , 'pengiriman.id_invoice = invoice.id_invoice');
            $this->db->where('invoice.id_invoice',$invoice_id);
            $query = $this->db->get();

            return $query->result();
        }



}
?>