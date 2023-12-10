<?php

namespace App\Controllers\Produk;

use App\Controllers\BaseController;
use App\Models\Produk\MProduk;
use App\Models\MMenu;

class CProduk extends BaseController
{
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
        return view('Produk/VProduk', $data);
    }
    public function tambah($menuAktip = '', $moduleAktip = '')
    {
        $menumodel = new MProduk();
        $datamenu           = new \App\Entities\EDataMenu();
        $datamenu->id_module = $this->request->getPost('id_module');
        $datamenu->path    = $this->request->getPost('path');
        $datamenu->menu    = $this->request->getPost('menu');
        $datamenu->icon    = $this->request->getPost('icon');

        $menumodel->save($datamenu);
        return redirect()->back()->with('message', lang('Auth.userupdate'));
        // End masuk database

    }
    public function rubah()
    {

        $menumodel = new MProduk();
        $menumodel->update(
            $this->request->getPost('id'),
            [
                'barcode' => $this->request->getPost('barcode'),
                'nama_produk' => $this->request->getPost('nama_produk'),
                'satuan' => $this->request->getPost('satuan'),
                'kategori' => $this->request->getPost('kategori'),
                'harga' => $this->request->getPost('harga'),
                'stok' => $this->request->getPost('stok')
            ]
        );
        return json_encode('sukses');
    }
    public function delete()
    {
        helper('form');
        //$menu = new M_Menu();
        //$datamenu = $menu->listing();  
        $session = \Config\Services::session();
        $validated =  $this->validate([
            'id'     => 'required'
        ]);
        if ($validated) {
            $data = array(
                'id'    => $this->request->getVar('id'),
            );
            $model = new MProduk();
            $model->delete($data);
            $session->setFlashdata('sukses', 'Data telah dihapus');
            return json_encode('sukses');
            // End masuk database
        }
    }
    public function jsondata()
    {
        $model = new MProduk();
        $datamodel = $model->findAll();
        $data = array(
            'data' => $datamodel
        );
        return $this->response->setJSON($data);
    }

    public function get_produk()
    {
        $model = new MProduk();
        $datamodel = $model->get_produk($this->request->getVar('id'));
        return $this->response->setJSON($datamodel);
    }
}
