<?php
//defined('BASEPATH') or exit('No direct script access allowed');

namespace App\Models\Penjualan;

use CodeIgniter\Model;

class Transaksi_model extends Model
{

	protected $DBGroup          = 'default';
	protected $table            = 'transaksi';
	protected $primaryKey       = 'id';
	protected $useAutoIncrement = true;
	//protected $returnType       = \App\Entities\EUser::class;
	protected $useSoftDeletes   = false;
	protected $protectFields    = true;
	protected $allowedFields    = ['id', 'tanggal', 'barcode', 'qty', 'total_bayar', 'jumlah_uang', 'diskon', 'pelanggan', 'nota', 'kasir'];


	public function create($data)
	{
		return $this->insert($data);
	}

	public function read()
	{
		$this->select('transaksi.id, transaksi.tanggal, transaksi.barcode, transaksi.qty, transaksi.total_bayar, transaksi.jumlah_uang, transaksi.diskon, pelanggan.nama as pelanggan');
		$this->from($this->table);
		$this->join('pelanggan', 'transaksi.pelanggan = pelanggan.id', 'left outer');
		return $this->get();
	}

	public function delete2($id)
	{
		$this->where('id', $id);
		return $this->delete($this->table);
	}

	public function getProduk($barcode, $qty)
	{
		$total = explode(',', $qty);
		foreach ($barcode as $key => $value) {
			$this->select('nama_produk');
			$this->where('id', $value);
			$data[] = '<tr><td>' . $this->get('produk')->row()->nama_produk . ' (' . $total[$key] . ')</td></tr>';
		}
		return join($data);
	}


	public function penjualanBulan($date)
	{
		$qty = $this->db->query("SELECT qty FROM transaksi WHERE DATE_FORMAT(tanggal, '%d %m %Y') = '$date'")->getResult('array');
		$d = [];
		$data = [];
		foreach ($qty as $key) {
			$d[] = explode(',', $key->qty);
		}
		foreach ($d as $key) {
			$data[] = array_sum($key);
		}
		return $data;
	}

	public function transaksiHari($hari)
	{
		return $this->db->query("SELECT COUNT(*) AS total FROM transaksi WHERE DATE_FORMAT(tanggal, '%d %m %Y') = '$hari'")->getRow();
	}

	public function transaksiTerakhir($hari)
	{
		return $this->db->query("SELECT transaksi.qty FROM transaksi WHERE DATE_FORMAT(tanggal, '%d %m %Y') = '$hari' LIMIT 1")->getRow();
	}

	public function getAll($id)
	{
		$this->select('transaksi.nota, transaksi.tanggal, transaksi.barcode, transaksi.qty, transaksi.total_bayar, transaksi.jumlah_uang, pengguna.nama as kasir');
		$this->from('transaksi');
		$this->join('pengguna', 'transaksi.kasir = pengguna.id');
		$this->where('transaksi.id', $id);
		return $this->get()->row();
	}

	public function getName($barcode)
	{
		foreach ($barcode as $b) {
			$this->select('nama_produk, harga');
			$this->where('id', $b);
			$data[] = $this->get('produk')->row();
		}
		return $data;
	}
}

/* End of file Transaksi_model.php */
/* Location: ./application/models/Transaksi_model.php */