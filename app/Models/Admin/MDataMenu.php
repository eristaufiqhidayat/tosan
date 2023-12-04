<?php

namespace App\Models\Admin;

use CodeIgniter\Model;

class MDataMenu extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_menu';
    protected $primaryKey       = 'id_menu';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\EDataMenu::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_menu', 'id_module', 'path', 'menu', 'icon'];

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

    public function jointmodule()
    {
        $db = db_connect();
        $query = $db->query('SELECT tbl_module.id_module as id_module,
									tbl_module.nama_module as nama_module,
									tbl_menu.id_menu as id_menu,
									tbl_menu.path as path,
									tbl_menu.menu as menu,
									tbl_menu.icon as icon 
                            FROM `tbl_module` 
							inner join tbl_menu on tbl_module.id_module = tbl_menu.id_module');
        return $query->getResult('array');
    }
}
