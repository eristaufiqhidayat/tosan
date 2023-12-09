<?php

namespace App\Models\Penjualan;

use CodeIgniter\Model;

class MPelanggan extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pelanggan';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    //protected $returnType       = \App\Entities\EDataMenu::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'nama', 'jenis_kelamin', 'alamat', 'telepon'];

    // public function create($data)
    // {
    // 	return $this->db->insert($this->table, $data);
    // }

    // public function read()
    // {
    // 	return $this->db->get($this->table);
    // }

    // public function update($id, $data)
    // {
    // 	$this->db->where('id', $id);
    // 	return $this->db->update($this->table, $data);
    // }

    // public function delete($id)
    // {
    // 	$this->db->where('id', $id);
    // 	return $this->db->delete($this->table);
    // }

    // public function getSupplier($id)
    // {
    // 	$this->db->where('id', $id);
    // 	return $this->db->get($this->table);
    // }

    public function search($search = "")
    {
        $db = db_connect();
        $query = "select id, concat(nama,' || ',telepon) as text from " . $this->table . " where nama like '$search%'";
        //echo $query;
        $query = $db->query($query);
        return $query->getResult();
    }
}

/* End of file Pelanggan_model.php */
/* Location: ./application/models/Pelanggan_model.php */