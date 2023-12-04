<?php

namespace App\Models;

use CodeIgniter\Model;

class MMenu extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_menu';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    public function listing()
    {
        // dd(user());
        $db = db_connect();
        $sql = "
                SELECT 
                tbl_module.id_module,
                tbl_module.nama_module,
                tbl_module.icon as micon,
                tbl_menu.id_menu,
                tbl_menu.path,
                tbl_menu.menu,
                tbl_menu.icon
                FROM `users` 
                left join auth_groups_users on auth_groups_users.user_id = users.id 
                LEFT join auth_groups_permissions on auth_groups_permissions.group_id = auth_groups_users.group_id
                left join auth_permissions on auth_permissions.id = auth_groups_permissions.permission_id
                left join tbl_module on tbl_module.id_module = auth_permissions.id
                left join tbl_menu on tbl_module.id_module = tbl_menu.id_module
                where users.username = '" . user()->username . "'
                group by tbl_menu.menu
                order by tbl_module.id_module,tbl_menu.menu
                ";
        $query = $db->query($sql);
        return $query->getResult('array');
        //return 'Ini adalah Method getData didalam ProductModel';
    }
    public function cekUsers()
    {
        // dd(user());
        $db = db_connect();
        $sql = "
                SELECT 
                auth_groups.id,
                auth_groups.name 
                FROM `users` 
                left join auth_groups_users on auth_groups_users.user_id = users.id 
                left join auth_groups on auth_groups.id = auth_groups_users.group_id
                where users.username = '" . user()->username . "'
                ";
        $query = $db->query($sql);
        return $query->getRowArray();
        //return 'Ini adalah Method getData didalam ProductModel';
    }
}
