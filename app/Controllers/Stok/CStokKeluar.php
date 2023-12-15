<?php

namespace App\Controllers\Stok;

use App\Controllers\BaseController;
use App\Models\Produk\MProduk;
use App\Models\MMenu;

class CStokKeluar extends BaseController
{

    // public function __construct()
    // {
    // 	parent::__construct();
    // 	if ($this->session->userdata('status') !== 'login' ) {
    // 		redirect('/');
    // 	}
    // 	$this->load->model('stok_keluar_model');
    // }

    public function index($menuAktip = '', $moduleAktip = '')
    {
        helper('text');

        $menu = new MMenu();
        $datamenu = $menu->listing();
        $model = new MProduk();
        //$datamenu2 = $model->findAll();
        $datamenu2 = $model->findAll();

        $data = array(
            'title'        => 'Data Module',
            'DataMenu'    => $datamenu2,
            'menu'   =>  $datamenu,
            'menuAktip' => $menuAktip,
            'moduleAktip' => $moduleAktip
        );

        return view('Stok/VStokKeluar', $data);
    }

    // public function read()
    // {
    // 	header('Content-type: application/json');
    // 	if ($this->stok_keluar_model->read()->num_rows() > 0) {
    // 		foreach ($this->stok_keluar_model->read()->result() as $stok_keluar) {
    // 			$tanggal = new DateTime($stok_keluar->tanggal);
    // 			$data[] = array(
    // 				'tanggal' => $tanggal->format('d-m-Y H:i:s'),
    // 				'barcode' => $stok_keluar->barcode,
    // 				'nama_produk' => $stok_keluar->nama_produk,
    // 				'jumlah' => $stok_keluar->jumlah,
    // 				'keterangan' => $stok_keluar->keterangan,
    // 			);
    // 		}
    // 	} else {
    // 		$data = array();
    // 	}
    // 	$stok_keluar = array(
    // 		'data' => $data
    // 	);
    // 	echo json_encode($stok_keluar);
    // }

    // public function add()
    // {
    // 	$id = $this->input->post('barcode');
    // 	$jumlah = $this->input->post('jumlah');
    // 	$stok = $this->stok_keluar_model->getStok($id)->stok;
    // 	$rumus = max($stok - $jumlah,0);
    // 	$addStok = $this->stok_keluar_model->addStok($id, $rumus);
    // 	if ($addStok) {
    // 		$tanggal = new DateTime($this->input->post('tanggal'));
    // 		$data = array(
    // 			'tanggal' => $tanggal->format('Y-m-d H:i:s'),
    // 			'barcode' => $id,
    // 			'jumlah' => $jumlah,
    // 			'keterangan' => $this->input->post('keterangan')
    // 		);
    // 		if ($this->stok_keluar_model->create($data)) {
    // 			echo json_encode('sukses');
    // 		}
    // 	}
    // }

    // public function get_barcode()
    // {
    // 	$id = $this->input->post('barcode');
    // 	$kategori = $this->stok_keluar_model->getKategori($id);
    // 	if ($kategori->row()) {
    // 		echo json_encode($kategori->row());
    // 	}
    // }

}

/* End of file Stok_keluar.php */
/* Location: ./application/controllers/Stok_keluar.php */