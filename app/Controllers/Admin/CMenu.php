<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\MModule;
use App\Models\Admin\MDataMenu;
use App\Models\MMenu;

class CMenu extends BaseController
{
    public function index($menuAktip = '', $moduleAktip = '')
    {
        helper('text');

        $menu = new MMenu();
        $datamenu = $menu->listing();
        $model = new MDataMenu();
        //$datamenu2 = $model->findAll();
        $datamenu2 = $model->jointmodule();

        $data = array(
            'title'        => 'Data Module',
            'DataMenu'    => $datamenu2,
            'menu'   =>  $datamenu,
            'menuAktip' => $menuAktip,
            'moduleAktip' => $moduleAktip
        );
        return view('Admin/VDataMenu', $data);
    }
    public function tambah($menuAktip = '', $moduleAktip = '')
    {
        $menumodel = new MDataMenu();
        $datamenu           = new \App\Entities\EDataMenu();
        $datamenu->id_module = $this->request->getPost('id_module');
        $datamenu->path    = $this->request->getPost('path');
        $datamenu->menu    = $this->request->getPost('menu');
        $datamenu->icon    = $this->request->getPost('icon');

        $menumodel->save($datamenu);
        return redirect()->back()->with('message', lang('Auth.userupdate'));
        // End masuk database

    }
    public function rubah($menuAktip = '', $moduleAktip = '')
    {

        $menumodel = new MDataMenu();
        $menumodel->update(
            $this->request->getPost('id_menu'),
            [
                "id_module" => $this->request->getPost('id_module'),
                "path" => $this->request->getPost('path'),
                "menu" => $this->request->getPost('menu'),
                "icon" => $this->request->getPost('icon')
            ]
        );
        return redirect()->back()->with('message', lang('Auth.userupdate'));
    }
    public function delete($menuAktip = '', $moduleAktip = '')
    {
        helper('form');
        //$menu = new M_Menu();
        //$datamenu = $menu->listing();  
        $session = \Config\Services::session();
        $validated =  $this->validate([
            'id_menu'     => 'required'
        ]);
        if ($validated) {
            $data = array(
                'id_menu'    => $this->request->getVar('id_menu'),
            );
            $model = new MDataMenu();
            $model->delete($data);
            $session->setFlashdata('sukses', 'Data telah dihapus');
            return redirect()->to(base_url('index.php/menu/index/' . $menuAktip . '/' . $moduleAktip));
            // End masuk database
        }
    }
    public function JSONMenu()
    {
        $model = new MDataMenu();
        $datamodel = $model->jointmodule();
        $data = array(
            'datamodel' => $datamodel
        );
        return $this->response->setJSON($data);
    }
}
