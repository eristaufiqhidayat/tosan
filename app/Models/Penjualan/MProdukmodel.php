<?php

namespace App\Models\Penjualan;

use CodeIgniter\Model;

class MProdukmodel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'produk';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    //protected $returnType       = \App\Entities\EDataMenu::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'barcode', 'nama_produk', 'kategori', 'satuan', 'harga', 'stok', 'terjual'];

    public function getNama($id)
    {
        $db = db_connect();
        $query = "select nama_produk, stok from " . $this->table . " where id = '$id'";
        echo $query;
        $query = $db->query($query);
        return $query->getResultArray();
    }
}

/* End of file Produk_model.php */
/* Location: ./application/models/Produk_model.php */