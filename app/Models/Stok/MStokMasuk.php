<?php

namespace App\Models\Stok;

use CodeIgniter\Model;

class MStokMasuk extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'stok_masuk';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = \App\Entities\EStokMasuk::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'tanggal', 'barcode', 'jumlah', 'keterangan', 'supplier'];

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

    public function get_produk($id)
    {
        $db = db_connect();
        $query = "select produk.id, produk.barcode, produk.nama_produk, produk.harga, produk.stok, kategori_produk.id as kategori_id, kategori_produk.kategori, satuan_produk.id as satuan_id, satuan_produk.satuan from " .
            $this->table . " left join kategori_produk on produk.kategori = kategori_produk.id left join satuan_produk on produk.satuan = satuan_produk.id where produk.id = '$id'";
        $query = $db->query($query);
        return $query->getRowArray();
    }
    public function get_stokmasuk()
    {
        $db = db_connect();
        $query = "select stok_masuk.tanggal, stok_masuk.jumlah, stok_masuk.keterangan, produk.barcode, produk.nama_produk from " .
            $this->table . " left join produk on produk.id = stok_masuk.barcode left join supplier on supplier.id = stok_masuk.supplier";
        $query = $db->query($query);
        return $query->getResultArray();
    }
}
