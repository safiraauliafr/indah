<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemesanan_model extends CI_Model
{
	
	public function __construct()
	{
		$this->load->database();
    }
    
    public function proses($metodepembayaran, $jasapengiriman, $alamat, $kodepos , $tarif , $total_semua_pembelian)
    {
        $tagihan = array(
            'id_pengguna'       => $this->session->userdata('id'),
            'alamat'            => $alamat,
            'kode_pos'          => $kodepos,
            'tanggal'           => date('Y-m-d H:i:s'),
            'tenggat'           => date('Y-m-d H:i:s', strtotime('+1 days')),
            'status'            => 'unpaid',
            'metode_pembayaran' => $metodepembayaran,
            'jasa_pengiriman'   => $jasapengiriman,
            'paket_tarif_pengiriman'   => $tarif,
            'total_belanja'   => $total_semua_pembelian
        );
        if ($this->db->insert('invoice', $tagihan))
        {
            $id_tagihan = $this->db->insert_id();

            $data = array();
            foreach($this->cart->contents() as $item)
            {
                $data[] = array(
                    'id_invoice'    => $id_tagihan,
                    'id_produk'     => $item['id'],
                    'nama_produk'   => $item['name'],
                    'jumlah'        => $item['qty'],
                    'biaya'         => $item['price']
                );
            }
            return $this->db->insert_batch('pemesanan', $data);
        }
        return FALSE;
    }

    public function get_all()
    {
        $hasil = $this->db->select('invoice.*, pengguna.nama_depan')
                ->join('pengguna', 'pengguna.id_pengguna = invoice.id_pengguna', $escape = TRUE)
                ->get('invoice');
        return $hasil->result();
    }

    public function get_invoice_by_id($id)
    {
        $hasil = $this->db
                    ->where('id_invoice', $id)
                    ->limit(1)
                    ->get('invoice');
        return $hasil->row();
    }

    public function get_orders_by_invoice($id)
    {
        $hasil = $this->db
                    ->where('id_invoice', $id)
                    ->get('pemesanan');
        return $hasil->result();
    }

    public function set_invoice_status($id, $status)
    {
        return $this->db
                ->where('id_invoice', $id)
                ->set('status', $status)
                ->update('invoice');
    }

    public function delete_invoice($id)
    {
        return $this->db
                ->where('id_invoice', $id)
                ->where('status', 'canceled')
                ->where('tenggat <', date('Y-m-d H:i:s'))
                ->delete('invoice')
            && $this->db
                ->where('id_invoice', $id)
                ->delete('pemesanan');
    }

    public function get_shipping_by_invoice($id)
    {
        $hasil = $this->db
                    ->where('id_invoice', $id)
                    ->limit(1)
                    ->get('pengiriman');
        return $hasil->row();
    }

    public function kirim($id, $jasa, $nomorpengiriman)
    {
        $pengiriman = array(
            'id_invoice'    => $id,
            'jasa'          => $jasa,
            'nomor_resi'    => $nomorpengiriman
        );
        return $this->db->insert('pengiriman', $pengiriman);
    }
     
         public function get_pemesanan_confirm($id_invoice)
    {
        $hasil = $this->db->select('*')
                ->get('invoice')
                ->where('id_invoice' , $id_invoice);
        return $hasil->row();
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

        public function laporan_produk($from, $to)
        {
            $sql = "
                    SELECT 
                DISTINCT(SUBSTR(a.`tanggal`, 1, 10)) AS tanggal,
                (
                    SELECT 
                        (b.`nama_produk`) 
                    FROM 
                        `pemesanan` AS b 
                    WHERE 
                        SUBSTR(b.`tanggal`, 1, 10) = SUBSTR(a.`tanggal`, 1, 10) 
                    LIMIT 1
                ) AS list_produk 
            FROM 
                `pemesanan` AS a 
            WHERE 
                SUBSTR(a.`tanggal`, 1, 10) >= '".$from."' 
                AND SUBSTR(a.`tanggal`, 1, 10) <= '".$to."' 
            ORDER BY 
                a.`tanggal` ASC

            ";
        }


  
}
?>