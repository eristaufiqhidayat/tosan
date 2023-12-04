<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class MGroupsUsers extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'auth_groups_users';
    protected $primaryKey       = 'group_id,user_id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\EGroupsUsers::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

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

    public function listingGroupsUsers()
    {
        $db = db_connect();
        $query = $db->query('SELECT * 
                            FROM auth_groups_users
                            left join auth_groups on auth_groups.id = auth_groups_users.group_id
                            left join users on users.id = auth_groups_users.user_id 
                            ');
        return $query->getResult('array');
    }
    public function listingUsers()
    {
        $db = db_connect();
        $query = $db->query('SELECT * FROM users');
        return $query->getResult('array');
    }
}
