<?php

namespace App\Models;

use CodeIgniter\Model;

class Perbaikan_data_Model extends Model
{
  protected $table = 'perbaikan_data';
  protected $useTimeStamps = true;
  protected $useSoftDeletes = true;
  protected $allowedFields = ['nik', 'namapemohon', 'emailpemohon', 'nomorpemohon', 'alamatpemohon', 'judulperbaikan', 'berkasperbaikan_satu', 'berkasperbaikan_dua', 'berkasperbaikan_tiga', 'berkasperbaikan_empat', 'berkasperbaikan_lima', 'penjelasanperbaikan', 'status'];

  public function getPerbaikanData($nama = false)
  {
    // Jika nama pemohon == false maka yang akan ditampilkan semua
    if ($nama == false) {
      return $this->findAll();
    }

    // Namun jika nama pemohon == true makan akan ditampilkan nama tersebut saja
    return $this->where(['namapemohon' => $nama])->first();
  }

  public function search($keyword)
  {
    return $this->table('perbaikan_data')->like('namapemohon', $keyword)->orLike('nik', $keyword);
  }

  public function updateStatus($nama, $status)
  {
    return $this->db->table('perbaikan_data')
      ->where('namapemohon', $nama)
      ->update(['status' => $status]);
  }
}
