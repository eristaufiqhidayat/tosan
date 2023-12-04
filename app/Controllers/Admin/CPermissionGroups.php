<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\Admin\MPermissionGroups;
use App\Models\MMenu;

class CPermissionGroups extends BaseController
{
    public function index($menuAktip = '', $moduleAktip = '')
    {
        helper('text');

        $menu = new MMenu();
        $datamenu = $menu->listing();
        $model = new MPermissionGroups();
        $datapermissiongroups = $model->listingPermissionGroups();
        $groupPermission = $model->listingPermissionGroups2();
        $permissions = $model->listingPermissions();
        $group = $model->listingGroups();
        $datamenu2 = $model->listingPermissionGroups();

        $data = array(
            'title'        => 'Data Module',
            'groupPermission'    => $datapermissiongroups,
            'permission' => $permissions,
            'group' => $group,
            'groupPermission' => $groupPermission,
            'DataMenu'    => $datamenu2,
            'menu'   =>  $datamenu,
            'menuAktip' => $menuAktip,
            'moduleAktip' => $moduleAktip
        );
        return view('Admin/VPermissionGroups', $data); //
    }
    public function permissionGroupsAdd($menuAktip = '', $moduleAktip = '')
    {
        helper('form');
        //$menu = new M_Menu();
        //$datamenu = $menu->listing();
        $session = \Config\Services::session();

        $validated =  $this->validate([
            'group_id'     => 'required',
        ]);
        if ($validated) {
            $data = array(
                'group_id'    => $this->request->getVar('group_id[]'),
                'name'    => $this->request->getVar('name'),
                'description'    => $this->request->getVar('description'),

            );

            $model = new MPermissionGroups();
            $model->listingPermissionGroupsTrunc(); //hapus data 
            foreach ($data['group_id'] as $key => $val) {
                foreach ($val as $namaModule) {
                    echo $key . "=>" . $namaModule . "<br>";
                    $data = array(
                        'group_id'    => $key,
                        'permission_id'    => $namaModule,
                    );
                    $model->listingPermissionGroupsAdd($data);
                }
                $data = "";
            }
            $session->setFlashdata('sukses', 'Data telah ditambah');
            return redirect()->back()->with('message', lang('Auth.userupdate'));
            // End masuk database
        }
    }
}
