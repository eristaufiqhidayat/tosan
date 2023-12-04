<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MMenu;
use App\Models\Admin\MGroups;
use App\Models\Admin\MUser;

class CGroups extends BaseController
{
    public function index($menuAktip = '', $moduleAktip = '')
    {
        helper('text');

        $menu = new MMenu();
        $datamenu = $menu->listing();
        $model = new MGroups();
        $datamenu2 = $model->findAll();
        $data = array(
            'title'        => 'Data Menu',
            'DataMenu'    => $datamenu2,
            'menu'   =>  $datamenu,
            'menuAktip' => $menuAktip,
            'moduleAktip' => $moduleAktip
        );
        return view('Admin/VGroups', $data);
    }


    public function tambah()
    {
        $authorize = service('authorization');
        $authorize->createGroup($this->request->getPost('name'), $this->request->getPost('description'));
        return redirect()->back()->with('message', lang('Auth.userupdate'));
    }
    public function rubah()
    {
        //$authorize = service('authorization');
        //$authorize->updateGroup($this->request->getPost('id'), $this->request->getPost('name'), $this->request->getPost('description'));
        $groups = new MGroups();
        $group = $groups->find($this->request->getPost('id'));
        $group->name = $this->request->getPost('name');
        $group->description = $this->request->getPost('description');
        if (!$groups->save($group)) {
            return redirect()->back()->with('message', lang('Auth.userupdate'));
        }
        $authorize = service('authorization');
        $authorize->createPermission('blog.posts.manage');
        return redirect()->back()->with('message', lang('Auth.userupdate'));
    }
    public function hapus()
    {
        $authorize = service('authorization');
        $authorize->deleteGroup($this->request->getPost('id'));
        return redirect()->back()->with('message', lang('Auth.userupdate'));
    }
}
