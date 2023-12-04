<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class MPermissionGroups extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'auth_groups_permissions';
    protected $primaryKey       = 'group_id,permission_id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\EDataMenu::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['group_id', 'permission_id'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function listingPermissionGroups()
    {
        $db = db_connect();
        $query = $db->query('SELECT 
                             auth_permissions.id as auth_permissions_id, 
                             auth_permissions.name as auth_permissions_name, 
                             auth_permissions.description as auth_permissions_description, 
                             group_id, 
                             permission_id, 
                             auth_groups.id as auth_groups_id, 
                             auth_groups.name auth_groups_name, 
                             auth_groups.description auth_groups_description 
                             FROM `auth_groups_permissions`
                             left join auth_permissions on auth_groups_permissions.permission_id = auth_permissions.id
                             left join auth_groups on auth_groups_permissions.group_id = auth_groups.id
                            ');
        return $query->getResult('array');
    }
    public function listingGroups()
    {
        $db = db_connect();
        $query = $db->query('SELECT * 
                            FROM auth_groups
                            ');
        return $query->getResult('array');
    }
    public function listingPermissions()
    {
        $db = db_connect();
        $query = $db->query('SELECT * FROM `auth_permissions`');
        return $query->getResult('array');
    }
    public function listingPermissionGroups2()
    {
        $db = db_connect();
        $query = $db->query('SELECT * FROM `auth_groups_permissions`');
        return $query->getResult('array');
    }
    public function listingPermissionGroupsAdd($data)
    {
        $db = db_connect();
        $db->table('auth_groups_permissions')->insert($data);
    }
    public function listingPermissionGroupsTrunc()
    {
        $db = db_connect();
        $db->query('DELETE FROM auth_groups_permissions');
    }
}
