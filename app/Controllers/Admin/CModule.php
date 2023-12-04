<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\MModule;
use App\Models\MMenu;

class CModule extends BaseController
{
    public function index($menuAktip = '', $moduleAktip = '')
    {
        helper('text');

        $menu = new MMenu();
        $datamenu = $menu->listing();
        $model = new MModule();
        $datamodule = $model->findAll();

        $data = array(
            'title'        => 'Data Module',
            'DataModule'    => $datamodule,
            'menu'   =>  $datamenu,
            'menuAktip' => $menuAktip,
            'moduleAktip' => $moduleAktip
        );
        return view('Admin/VDataModule', $data);
    }
    public function tambah()
    {
        $modulemodel = new MModule();
        $module           = new \App\Entities\EModule();
        $module->nama_module = $this->request->getPost('nama_module');
        $module->icon    = $this->request->getPost('icon');
        $modulemodel->save($module);
        return redirect()->back()->with('message', lang('Auth.userupdate'));
    }
    public function rubah()
    {

        $modulemodel = new MModule();
        $modulemodel->update(
            $this->request->getPost('id_module'),
            [
                "nama_module" => $this->request->getPost('nama_module'),
                "icon" => $this->request->getPost('icon')
            ]
        );
        return redirect()->back()->with('message', lang('Auth.userupdate'));
    }
    public function hapus()
    {
        $modulemodel = new MModule();
        $modulemodel->delete($this->request->getPost('id_module'), true);
        return redirect()->back()->with('message', lang('Auth.userupdate'));
    }
}
