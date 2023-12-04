<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\MMenu;
use App\Models\Admin\MGroupsUsers;
use Myth\Auth\Commands\ListGroups;

class CGroupsUsers extends BaseController
{
    public function index($menuAktip = '', $moduleAktip = '')
    {
        $menu = new MMenu();
        $datamenu = $menu->listing();
        $model = new MGroupsUsers();
        $datausers = $model->listingUsers();
        $datagroupsusers = $model->listingGroupsUsers();
        $data = array(
            'title'        => 'Data Menu',
            'menu'   =>  $datamenu,
            'groupsusers' => $datagroupsusers,
            'users' => $datausers,
            'menuAktip' => $menuAktip,
            'moduleAktip' => $moduleAktip
        );
        return view('Admin/VGroupsUsers', $data);
    }
    public function rubah()
    {
        $authorize = service('authorization');
        $groupid = $this->request->getPost('group_id');
        $user_id = $this->request->getPost('user_id');
        $listgroupall = groupsall();

        foreach ($listgroupall as $listgroupallv) {
            if (isset($groupid[$listgroupallv['id']])) {
                if (!$authorize->inGroup($listgroupallv['id'], $user_id))
                    $authorize->addUserToGroup($user_id, $listgroupallv['id']);
            } else {
                $authorize->removeUserFromGroup($user_id, $listgroupallv['id']);
            }
        }

        return redirect()->back()->with('message', lang('Auth.userupdate'));
    }
}
