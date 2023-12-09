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

    public function getBarcode($id)
    {
        $db = db_connect();
        $query = "select id, concat(barcode,' || ',nama_produk) as text from " . $this->table . " where concat(barcode,nama_produk) like '$id%' and stok > 0";
        //echo $query;
        $query = $db->query($query);
        return $query->getResultArray();
    }
    public function getNamaProduk($id)
    {
        $db = db_connect();
        $query = "select nama_produk, stok from " . $this->table . " where id = '$id'";
        //echo $query;
        $query = $db->query($query);
        return $query->getRow();
    }
    public function getStok($id)
    {
        $db = db_connect();
        $query = "select stok, nama_produk, harga, barcode from " . $this->table . " where id = '$id'";
        //echo $query;
        $query = $db->query($query);
        return $query->getRow();
    }
    public function removeStok($id, $stok)
    {
        // $this->where('id', $id);
        // $this->set('stok', $stok);
        // return $this->update('produk');
        $db = db_connect();
        $db->query("UPDATE $this->table SET 
                            $this->table.`stok` = '$stok' 
                            WHERE $this->table.`id` = '$id'");
    }

    public function addTerjual($id, $jumlah)
    {
        // $this->where('id', $id);
        // $this->set('terjual', $jumlah);
        // return $this->update('produk');
        $db = db_connect();
        $db->query("UPDATE $this->table SET 
                            $this->table.`terjual` = '$jumlah' 
                            WHERE $this->table.`id` = '$id'");
    }
}

/* End of file Produk_model.php */
/* Location: ./application/models/Produk_model.php */