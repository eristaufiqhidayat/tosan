<?php
//defined('BASEPATH') OR exit('No direct script access allowed');

namespace App\Controllers\Penjualan;

use App\Controllers\BaseController;
use \DateTime;
use App\Models\MMenu;
use App\Models\Penjualan\Transaksi_model;
use App\Models\Penjualan\MProdukmodel;

class Transaksi extends BaseController
{

	public function __construct()
	{
		//parent::__construct();
		//if ($this->session->userdata('status') !== 'login') {
		//	redirect('/');
		//}
		//$this->load->model('transaksi_model');
	}

	public function index($menuAktip = '', $moduleAktip = '')
	{
		helper('text');
		$menu = new MMenu();
		$datamenu = $menu->listing();
		$model = new Transaksi_model();
		//$datamenu2 = $model->read();
		$data = array(
			'title'        => 'Transaksi',
			//'DataMenu'    => $datamenu2,
			'menu'   =>  $datamenu,
			'menuAktip' => $menuAktip,
			'moduleAktip' => $moduleAktip
		);
		return view('Penjualan/transaksi', $data);
	}

	public function read()
	{
		// header('Content-type: application/json');
		if ($this->transaksi_model->read()->num_rows() > 0) {
			foreach ($this->transaksi_model->read()->result() as $transaksi) {
				$barcode = explode(',', $transaksi->barcode);
				$tanggal = new DateTime($transaksi->tanggal);
				$data[] = array(
					'tanggal' => $tanggal->format('d-m-Y H:i:s'),
					'nama_produk' => '<table>' . $this->transaksi_model->getProduk($barcode, $transaksi->qty) . '</table>',
					'total_bayar' => $transaksi->total_bayar,
					'jumlah_uang' => $transaksi->jumlah_uang,
					'diskon' => $transaksi->diskon,
					'pelanggan' => $transaksi->pelanggan,
					'action' => '<a class="btn btn-sm btn-success" href="' . site_url('transaksi/cetak/') . $transaksi->id . '">Print</a> <button class="btn btn-sm btn-danger" onclick="remove(' . $transaksi->id . ')">Delete</button>'
				);
			}
		} else {
			$data = array();
		}
		$transaksi = array(
			'data' => $data
		);
		echo json_encode($transaksi);
	}

	public function add()
	{

		$modelproduk = new MProdukmodel();
		$modeltransaksi = new Transaksi_model();
		$produk = json_encode($this->request->getGetPost('produk'));
		$produkd = json_decode($produk);
		//var_dump($this->request->getGetPost('produk'));
		//$tanggal = new DateTime($this->input->post('tanggal'));
		//$tanggal = new DateTime(now());
		$barcode = array();
		foreach ($produkd as $produk) {
			//$this->transaksi_model->removeStok($produk->id, $produk->stok);
			//$this->transaksi_model->addTerjual($produk->id, $produk->terjual);
			$modelproduk->removeStok($produk->id, $produk->stok);
			$modelproduk->addTerjual($produk->id, $produk->terjual);
			array_push($barcode, $produk->id);
		}
		$data = array(
			'tanggal' => date('Y-m-d H:i:s'),
			'barcode' => implode(',', $barcode),
			'qty' => implode(',', $this->request->getGetPost('qty')),
			'total_bayar' => $this->request->getGetPost('total_bayar'),
			'jumlah_uang' => $this->request->getGetPost('jumlah_uang'),
			'diskon' => $this->request->getGetPost('diskon'),
			'pelanggan' => $this->request->getGetPost('pelanggan'),
			'nota' => $this->request->getGetPost('nota'),
			'kasir' => user()->id
		);
		//var_dump($data);
		//echo json_encode($this->request->getGetPost('produk'));
		if ($modeltransaksi->create($data)) {
			// 	echo json_encode($this->db->insert_id());
			echo json_encode($this->request->getGetPost('produk'));
		}
		//$data = $this->input->post('form');
	}

	public function delete()
	{
		$id = $this->input->post('id');
		if ($this->transaksi_model->delete($id)) {
			echo json_encode('sukses');
		}
	}

	public function cetak($id)
	{
		$produk = $this->transaksi_model->getAll($id);

		$tanggal = new DateTime($produk->tanggal);
		$barcode = explode(',', $produk->barcode);
		$qty = explode(',', $produk->qty);

		$produk->tanggal = $tanggal->format('d m Y H:i:s');

		$dataProduk = $this->transaksi_model->getName($barcode);
		foreach ($dataProduk as $key => $value) {
			$value->total = $qty[$key];
			$value->harga = $value->harga * $qty[$key];
		}

		$data = array(
			'nota' => $produk->nota,
			'tanggal' => $produk->tanggal,
			'produk' => $dataProduk,
			'total' => $produk->total_bayar,
			'bayar' => $produk->jumlah_uang,
			'kembalian' => $produk->jumlah_uang - $produk->total_bayar,
			'kasir' => $produk->kasir
		);
		$this->load->view('Penjualan/cetak', $data);
	}

	public function penjualan_bulan()
	{
		header('Content-type: application/json');
		$day = $this->input->post('day');
		foreach ($day as $key => $value) {
			$now = date($day[$value] . ' m Y');
			if ($qty = $this->transaksi_model->penjualanBulan($now) !== []) {
				$data[] = array_sum($this->transaksi_model->penjualanBulan($now));
			} else {
				$data[] = 0;
			}
		}
		echo json_encode($data);
	}

	public function transaksi_hari()
	{
		header('Content-type: application/json');
		$now = date('d m Y');
		$total = $this->transaksi_model->transaksiHari($now);
		echo json_encode($total);
	}

	public function transaksi_terakhir($value = '')
	{
		header('Content-type: application/json');
		$now = date('d m Y');
		foreach ($this->transaksi_model->transaksiTerakhir($now) as $key) {
			$total = explode(',', $key);
		}
		echo json_encode($total);
	}
	public function jsonbarcode()
	{
		// $auth = service('authentication');
		// if (!$auth->check()) {
		// 	$this->session->set('redirect_url', current_url());
		// 	return redirect()->route('login');
		// }
		$model = new MProdukmodel();
		$dataModel = $model->getBarcode($this->request->getGetPost('barcode'));
		return $this->response->setJSON($dataModel);
	}
	public function jsongetnamaproduk()
	{
		// $auth = service('authentication');
		// if (!$auth->check()) {
		// 	$this->session->set('redirect_url', current_url());
		// 	return redirect()->route('login');
		// }
		$model = new MProdukmodel();
		$dataModel = $model->getNamaProduk($this->request->getGetPost('id'));
		return $this->response->setJSON($dataModel);
	}
	public function jsongetstok()
	{
		// $auth = service('authentication');
		// if (!$auth->check()) {
		// 	$this->session->set('redirect_url', current_url());
		// 	return redirect()->route('login');
		// }
		$model = new MProdukmodel();
		$dataModel = $model->getStok($this->request->getGetPost('id'));
		return $this->response->setJSON($dataModel);
	}
}

/* End of file Transaksi.php */
/* Location: ./application/controllers/Transaksi.php */