<?php

namespace App\Models;

use CodeIgniter\Model;

class Pendaftaran_kkpemisahan_Model extends Model
{
  protected $table = 'pendaftaran_kk_pemisahan';
  protected $useTimeStamps = true;
  protected $useSoftDeletes = true;
  protected $allowedFields = ['nik', 'namapemohon', 'emailpemohon', 'nomorpemohon', 'alamatpemohon', 'kartukeluargalama', 'filepemisahan', 'status'];

  public function getDataKKPemisahan($nama = false)
  {
    if ($nama == false) {
      return $this->findAll();
    }
    return $this->where(['namapemohon' => $nama])->first();
  }

  public function search($keyword)
  {
    return $this->table('pendaftaran_kk_pemisahan')->like('namapemohon', $keyword)->orLike('nik', $keyword);
  }

  public function getDataByNIK($nik)
  {
    return $this->where('NIK', $nik)->first();
  }

  public function updateStatus($nama, $status)
  {
    return $this->db->table('pendaftaran_kk_pemisahan')
      ->where('namapemohon', $nama)
      ->update(['status' => $status]);
  }
}