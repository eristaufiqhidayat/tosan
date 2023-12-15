<?php

namespace App\Controllers\Stok;

use App\Controllers\BaseController;
use App\Models\Stok\MStokMasuk;
use App\Models\MMenu;

class CStokMasuk extends BaseController
{

    public function __construct()
    {
        // parent::__construct();
        // if ($this->session->userdata('status') !== 'login' ) {
        // 	redirect('/');
        // }
        // $this->load->model('stok_masuk_model');
    }

    public function index($menuAktip = '', $moduleAktip = '')
    {
        helper('text');
        $menu = new MMenu();
        $datamenu = $menu->listing();
        $model = new MStokMasuk();
        //$datamenu2 = $model->findAll();
        $datamenu2 = $model->findAll();

        $data = array(
            'title'        => 'Stok',
            'menu'   =>  $datamenu,
            'menuAktip' => $menuAktip,
            'moduleAktip' => $moduleAktip
        );

        return view('Stok/VStokMasuk', $data);
    }

    public function read()
    {
        $model = new MStokMasuk();
        $datamodel = $model->get_stokmasuk();
        $data = array(
            'data' => $datamodel
        );
        return $this->response->setJSON($data);
    }

    // public function add()
    // {
    // 	$id = $this->input->post('barcode');
    // 	$jumlah = $this->input->post('jumlah');
    // 	$stok = $this->stok_masuk_model->getStok($id)->stok;
    // 	$rumus = max($stok + $jumlah,0);
    // 	$addStok = $this->stok_masuk_model->addStok($id, $rumus);
    // 	if ($addStok) {
    // 		$tanggal = new DateTime($this->input->post('tanggal'));
    // 		$data = array(
    // 			'tanggal' => $tanggal->format('Y-m-d H:i:s'),
    // 			'barcode' => $id,
    // 			'jumlah' => $jumlah,
    // 			'keterangan' => $this->input->post('keterangan'),
    // 			'supplier' => $this->input->post('supplier')
    // 		);
    // 		if ($this->stok_masuk_model->create($data)) {
    // 			echo json_encode('sukses');
    // 		}
    // 	}
    // }

    // public function get_barcode()
    // {
    // 	$barcode = $this->input->post('barcode');
    // 	$kategori = $this->stok_masuk_model->getKategori($barcode);
    // 	if ($kategori->row()) {
    // 		echo json_encode($kategori->row());
    // 	}
    // }

    // public function laporan()
    // {
    // 	header('Content-type: application/json');
    // 	if ($this->stok_masuk_model->laporan()->num_rows() > 0) {
    // 		foreach ($this->stok_masuk_model->laporan()->result() as $stok_masuk) {
    // 			$tanggal = new DateTime($stok_masuk->tanggal);
    // 			$data[] = array(
    // 				'tanggal' => $tanggal->format('d-m-Y H:i:s'),
    // 				'barcode' => $stok_masuk->barcode,
    // 				'nama_produk' => $stok_masuk->nama_produk,
    // 				'jumlah' => $stok_masuk->jumlah,
    // 				'keterangan' => $stok_masuk->keterangan,
    // 				'supplier' => $stok_masuk->supplier
    // 			);
    // 		}
    // 	} else {
    // 		$data = array();
    // 	}
    // 	$stok_masuk = array(
    // 		'data' => $data
    // 	);
    // 	echo json_encode($stok_masuk);
    // }

    // public function stok_hari()
    // {
    // 	header('Content-type: application/json');
    // 	$now = date('d m Y');
    // 	$total = $this->stok_masuk_model->stokHari($now);
    // 	echo json_encode($total->total == null ? 0 : $total);
    // }

}

/* End of file Stok_masuk.php */
/* Location: ./application/controllers/Stok_masuk.php */