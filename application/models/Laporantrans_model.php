<?php
if (!defined('BASEPATH'))exit('No direct script access allowed');

class Laporantrans_model extends CI_Model
{
	function insert_invoice($total_belanja, $tanggal, $id_invoice, $id_pengguna)
	{
		$transaksi = array(
			'total_belanja' => $total_belanja,
			'tanggal' => $tanggal,
			'id_pengguna' => (empty($id_pengguna)) ? NULL : $id_pengguna,
			'id_invoice' => $id_invoice
		);

		return $this->db->insert('invoice', $transaksi);
	}

	function get_id($total_belanja)
	{
		return $this->db
			->select('id_invoice')
			->where('total_belanja', $total_belanja)
			->limit(1)
			->get('invoice');
	}

	function fetch_data_transaksi($like_value = NULL, $column_order = NULL, $column_dir = NULL, $limit_start = NULL, $limit_length = NULL)
	{
		$sql = "
			SELECT 
				(@row:=@row+1) AS nomor, 
				a.`id_invoice`, 
				a.`total_belanja` AS total_belanja, 
				DATE_FORMAT(a.`tanggal`, '%d %b %Y - %H:%i:%s') AS tanggal,
				CONCAT('Rp. ', REPLACE(FORMAT(a.`grand_total`, 0),',','.') ) AS grand_total,
				IF(b.`nama` IS NULL, 'Umum', b.`nama`) AS nama_pelanggan,
				c.`nama` AS pelanggan,  
			FROM 
				`invoice` AS a 
				LEFT JOIN `pengguna` AS b ON a.`id_pengguna` = b.`id_pengguna` 
				LEFT JOIN `pemesanan` AS c ON a.`id_pemesanan` = c.`id_pemesanan` 
				, (SELECT @row := 0) r WHERE 1=1 
		";
		
		$data['totalData'] = $this->db->query($sql)->num_rows();
		
		if( ! empty($like_value))
		{
			$sql .= " AND ( ";    
			$sql .= "
				a.`total_belanja` LIKE '%".$this->db->escape_like_str($like_value)."%' 
				OR DATE_FORMAT(a.`tanggal`, '%d %b %Y - %H:%i:%s') LIKE '%".$this->db->escape_like_str($like_value)."%' 
				OR CONCAT('Rp. ', REPLACE(FORMAT(a.`total_belanja`, 0),',','.') ) LIKE '%".$this->db->escape_like_str($like_value)."%' 
				OR IF(b.`nama` IS NULL, 'Umum', b.`nama`) LIKE '%".$this->db->escape_like_str($like_value)."%' 
				OR c.`nama` LIKE '%".$this->db->escape_like_str($like_value)."%' 
			";
			$sql .= " ) ";
		}
		
		$data['totalFiltered']	= $this->db->query($sql)->num_rows();
		
		$columns_order_by = array( 
			0 => 'nomor',
			1 => 'a.`tanggal`',
			2 => 'id_invoice',
			3 => 'a.`total_belanja`',
			4 => 'id_pelanggan',

		);

		$sql .= " ORDER BY ".$columns_order_by[$column_order]." ".$column_dir.", nomor ";
		$sql .= " LIMIT ".$limit_start." ,".$limit_length." ";
		
		$data['query'] = $this->db->query($sql);
		return $data;
	}

	function get_baris($id_invoice)
	{
		$sql = "
			SELECT 
				a.`nomor_nota`, 
				a.`grand_total`,
				a.`tanggal`,
				a.`bayar`,
				a.`id_user` AS id_kasir,
				a.`id_pelanggan`,
				a.`keterangan_lain` AS catatan,
				b.`nama` AS nama_pelanggan,
				b.`alamat` AS alamat_pelanggan,
				b.`telp` AS telp_pelanggan,
				b.`info_tambahan` AS info_pelanggan 
			FROM 
				`pj_penjualan_master` AS a 
				LEFT JOIN `pj_pelanggan` AS b ON a.`id_pelanggan` = b.`id_pelanggan` 
			WHERE 
				a.`id_penjualan_m` = '".$id_penjualan."' 
			LIMIT 1
		";
		return $this->db->query($sql);
	}

	function hapus_transaksi($id_penjualan, $reverse_stok)
	{
		if($reverse_stok == 'yes'){
			$loop = $this->db
				->select('id_barang, jumlah_beli')
				->where('id_invoice', $id_invoice)
				->get('invoice');

			foreach($loop->result() as $b)
			{
				$sql = "
					UPDATE `pj_barang` SET `total_stok` = `total_stok` + ".$b->jumlah_beli." 
					WHERE `id_barang` = '".$b->id_barang."' 
				";

				$this->db->query($sql);
			}
		}

		$this->db->where('id_invoice', $id_invoice)->delete('invoice');
		return $this->db
			->where('id_invoice', $id_invoice)
			->delete('invoice');
	}

	function laporan_transaksi($from, $to)
	{
		$sql = "
			SELECT 
				DISTINCT(SUBSTR(a.`tanggal`, 1, 10)) AS tanggal,
				(
					SELECT 
						SUM(b.`total_belanja`) 
					FROM 
						`invoice` AS b 
					WHERE 
						SUBSTR(b.`tanggal`, 1, 10) = SUBSTR(a.`tanggal`, 1, 10) 
					LIMIT 1
				) AS total_penjualan 
			FROM 
				`invoice` AS a 
			WHERE 
				SUBSTR(a.`tanggal`, 1, 10) >= '".$from."' 
				AND SUBSTR(a.`tanggal`, 1, 10) <= '".$to."' 
			ORDER BY 
				a.`tanggal` ASC
		";

		return $this->db->query($sql);
	}

	function cek_nota_validasi($total)
	{
		return $this->db->select('total_belanja')->where('total_belanja', $total)->limit(1)->get('invoice');
	}
}