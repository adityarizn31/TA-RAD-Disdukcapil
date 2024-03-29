<?php

namespace App\Controllers;

use App\Models\Pendaftaran_kk_Model;
use App\Models\Pendaftaran_kkperceraian_Model;
use App\Models\Pendaftaran_kia_Model;
use App\Models\Pendaftaran_suratperpindahan_Model;
use App\Models\Pendaftaran_suratperpindahanluar_Model;

use App\Models\Pendaftaran_aktakelahiran_Model;
use App\Models\Pendaftaran_aktakematian_Model;
use App\Models\Pendaftaran_keabsahanakla_Model;

use App\Models\Pendaftaran_pelayanandata_Model;

use App\Models\Perbaikan_data_Model;
use App\Models\Pengaduan_update_Model;

class PelayananSilancar extends BaseController
{
  protected $kkModel;
  protected $kkperceraianModel;
  protected $ktpModel;
  protected $kiaModel;
  protected $suratperpindahanModel;
  protected $suratperpindahanluarModel;

  protected $aktakelahiranModel;
  protected $aktakematianModel;
  protected $keabsahanaklaModel;

  protected $pelayanandataModel;

  protected $perbaikandataModel;
  protected $pengaduanupdateModel;

  protected $perbaikannikModel;

  public function __construct()
  {
    $this->kkModel = new Pendaftaran_kk_Model();
    $this->kkperceraianModel = new Pendaftaran_kkperceraian_Model();
    $this->kiaModel = new Pendaftaran_kia_Model();
    $this->suratperpindahanModel = new Pendaftaran_suratperpindahan_Model();
    $this->suratperpindahanluarModel = new Pendaftaran_suratperpindahanluar_Model();

    $this->aktakelahiranModel = new Pendaftaran_aktakelahiran_Model();
    $this->aktakematianModel = new Pendaftaran_aktakematian_Model();
    $this->keabsahanaklaModel = new Pendaftaran_keabsahanakla_Model();

    $this->pelayanandataModel = new Pendaftaran_pelayanandata_Model();

    $this->perbaikandataModel = new Perbaikan_data_Model();
    $this->pengaduanupdateModel = new Pengaduan_update_Model();
  }

  public function index()
  {
    $data = [
      'title' => 'Pelayanan Online || Disdukcapil Majalengka'
    ];
    return view('pelayanan_views/index', $data);
  }










  public function pendaftaranKK()
  {
    helper(['form']);
    $data = [
      'title' => 'Pendaftaran KK || Disdukcapil Majalengka',
      'validation' => \Config\Services::validation()
    ];
    return view('pelayanan_views/pendaftaranKK', $data);
  }

  // Validasi Pendaftaran KK
  public function saveKK()
  {
    $validate = $this->validate([

      // Form NIK Pemohon
      'nik' => [
        'rules' => 'required[pendaftaran_kk.nik]',
        'errors' => [
          'required' => 'NIK Pemohon Harus Diisi !!'
        ],
      ],
      // Form Nama Pemohon
      'namapemohon' => [
        'rules' => 'required[pendaftaran_kk.namapemohon]',
        'errors' => [
          'required' => 'Nama Pemohon Harus Diisi !!'
        ],
      ],
      // Form Email Pemohon
      'emailpemohon' => [
        'rules' => 'required[pendaftaran_kk.emailpemohon]|valid_email',
        'errors' => [
          'required' => 'Email Pemohon Harus Diisi !!',
          'valid_email' => 'Mohon cek kembali email anda, gunakan @ agar valid !!'
        ],
      ],
      // Form Nomor Pemohon
      'nomorpemohon' => [
        'rules' => 'required[pendaftaran_kk.nomorpemohon]|is_natural',
        'errors' => [
          'required' => 'Nomor Pemohon Harus Diisi !!',
          'is_natural' => 'Mohon menggunakan Format 082 !!',
        ],
      ],
      // Form Alamat Pemohon
      'alamatpemohon' => [
        'rules' => 'required[pendaftaran_kk.alamatpemohon]',
        'errors' => [
          'required' => 'Alamat Pemohon Harus Diisi !!'
        ],
      ],
      // Form Formulir Desa
      'formulirdesa' => [
        'rules' => 'uploaded[formulirdesa]|max_size[formulirdesa,2048]|mime_in[formulirdesa,application/pdf]|ext_in[formulirdesa,pdf]',
        'errors' => [
          'uploaded' => 'Formulir Desa Harus Diisi !!',
          'max_size' => 'File Formulir Desa terlalu besar, Kompress terlebih dahulu !!',
          'mime_in' => 'Format Formulir Desa Harus PDF !!',
          'ext_in' => 'Format Formulir Desa Harus PDF !!'
        ],
      ],
      // Form KK Suami
      'kartukeluargasuami' => [
        'rules' => 'uploaded[kartukeluargasuami]|max_size[kartukeluargasuami,2048]|mime_in[kartukeluargasuami,application/pdf]|ext_in[kartukeluargasuami,pdf]',
        'errors' => [
          'uploaded' => 'Kartu Keluarga Suami Harus Diisi !!',
          'max_size' => 'File anda terlalu besar, Kompress terlebih dahulu !!',
          'mime_in' => 'Format File Harus PDF !!',
          'ext_in' => ''
        ],
      ],
      // Form KK Istri
      'kartukeluargaistri' => [
        'rules' => 'uploaded[kartukeluargaistri]|max_size[kartukeluargaistri,2048]|mime_in[kartukeluargaistri,application/pdf]|ext_in[kartukeluargaistri,pdf]',
        'errors' => [
          'uploaded' => 'Kartu Keluarga Istri Harus Diisi !!',
          'max_size' => 'File anda terlalu besar, Kompress terlebih dahulu !!',
          'mime_in' => 'Format File Harus PDF !!',
          'ext_in' => ''
        ],
      ],
      // Form Surat Nikah
      'suratnikah' => [
        'rules' => 'uploaded[suratnikah]|max_size[suratnikah,2048]|mime_in[suratnikah,application/pdf]|ext_in[suratnikah,pdf]',
        'errors' => [
          'uploaded' => 'Surat Nikah Harus Diisi !!',
          'max_size' => 'File Surat Nikah terlalu besar, Kompress terlebih dahulu !!',
          'mime_in' => 'Format Surat Nikah Harus PDF !!',
          'ext_in' => 'Format Surat Nikah Harus PDF !!'
        ],
      ],
      // Form Surat Pindah
      'suratpindah' => [
        'rules' => 'uploaded[suratpindah]|max_size[suratpindah,2048]|mime_in[suratpindah,application/pdf]|ext_in[suratpindah,pdf]',
        'errors' => [
          'uploaded' => 'Surat Pindah Harus Diisi !!',
          'max_size' => 'File Surat Pindah terlalu besar, Kompress terlebih dahulu !!',
          'mime_in' => 'Format Surat Pindah Harus PDF !!',
          'ext_in' => 'Format Surat Pindah Harus PDF !!'
        ],
      ],
    ]);

    if (!$validate) {
      return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Berkas Formulir Desa
    $berkasFormulirDesa_KK = $this->request->getFile('formulirdesa');
    $namaFormulirDesa_KK = $berkasFormulirDesa_KK->getName();
    $berkasFormulirDesa_KK->move('pelayanan/kk', $namaFormulirDesa_KK);

    // Berkas KK Suami
    $berkasKKSuami_KK = $this->request->getFile('kartukeluargasuami');
    $namaKKSuami_KK = $berkasKKSuami_KK->getName();
    $berkasKKSuami_KK->move('pelayanan/kk', $namaKKSuami_KK);

    // Berkas KK Istri
    $berkasKKIstri_KK = $this->request->getFile('kartukeluargaistri');
    $namaKKIstri_KK = $berkasKKIstri_KK->getName();
    $berkasKKIstri_KK->move('pelayanan/kk', $namaKKIstri_KK);

    // Berkas Surat Nikah
    $berkasSuratNikah_KK = $this->request->getFile('suratnikah');
    $namaSuratNikah_KK = $berkasSuratNikah_KK->getName();
    $berkasSuratNikah_KK->move('pelayanan/kk', $namaSuratNikah_KK);

    // Berkas Surat Pindah
    $berkasSuratPindah_KK = $this->request->getFile('suratpindah');
    $namaSuratPindah_KK = $berkasSuratPindah_KK->getName();
    $berkasSuratPindah_KK->move('pelayanan/kk', $namaSuratPindah_KK);

    $this->kkModel->save([
      'nik' => $this->request->getVar('nik'),
      'namapemohon' => $this->request->getVar('namapemohon'),
      'emailpemohon' => $this->request->getVar('emailpemohon'),
      'nomorpemohon' => $this->request->getVar('nomorpemohon'),
      'alamatpemohon' => $this->request->getVar('alamatpemohon'),
      'formulirdesa' => $namaFormulirDesa_KK,
      'kartukeluargasuami' => $namaKKSuami_KK,
      'kartukeluargaistri' => $namaKKIstri_KK,
      'suratnikah' => $namaSuratNikah_KK,
      'suratpindah' => $namaSuratPindah_KK
    ]);
    session()->setFlashdata('pesan', 'Selamat pendaftaran permohonan Kartu Keluarga Baru Anda telah berhasil !!');
    return redirect()->to('/PelayananSilancar/pendaftaranKK');
  }


  // Si Lancar 1  
  // Menampilkan Form Pendaftaran KIA
  public function pendaftaranKIA()
  {
    helper(['form']);
    $data = [
      'title' => 'Pendaftaran KIA || Disdukcapil Majalengka',
      'validation' => \Config\Services::validation()
    ];
    return view('pelayanan_views/pendaftaranKIA', $data);
  }

  // Validasi Pendaftaran KIA
  public function saveKIA()
  {

    $validate = $this->validate([

      // Form NIK Pemohon
      'nik' => [
        'rules' => 'required[pendaftaran_kia.nik]',
        'errors' => [
          'required' => 'NIK Pemohon Harus Diisi !!'
        ],
      ],
      //Form Nama Pemohon
      'namapemohon' => [
        'rules' => 'required[pendaftaran_kia.namapemohon]',
        'errors' => [
          'required' => 'Nama Pemohon Harus diisi !!'
        ],
      ],
      //Form Email Pemohon
      'emailpemohon' => [
        'rules' => 'required[pendaftaran_kia.emailpemohon]|valid_email',
        'errors' => [
          'required' => 'Email Pemohon Harus Diisi !!',
          'valid_email' => 'Mohon cek kembali email anda, gunakan @ agar valid !!'
        ],
      ],
      // Form Nomor Pemohon
      'nomorpemohon' => [
        'rules' => 'required[pendaftaran_kia.nomorpemohon]|is_natural',
        'errors' => [
          'required' => 'Nomor Pemohon Harus Diisi !!',
          'is_natural' => 'Mohon menggunakan Format 082 !!',
        ],
      ],
      //Form Alamat Pemohon
      'alamatpemohon' => [
        'rules' => 'required[pendaftaran_kia.alamatpemohon]',
        'errors' => [
          'required' => 'Alamat Pemohon Harus Diisi !!'
        ],
      ],
      // Berkas Akta Kelahiran
      'aktakelahiran' => [
        'rules' => 'uploaded[aktakelahiran]|max_size[aktakelahiran,2048]|mime_in[aktakelahiran,application/pdf]|ext_in[aktakelahiran,pdf]',
        'errors' => [
          'uploaded' => 'Akta Kelahiran Harus Diisi !!',
          'max_size' => 'File Akta Kelahiran terlalu besar, Kompress terlebih dahulu !!',
          'mime_in' => 'Format File Harus PDF !!',
          'ext_in' => ''
        ],
      ],
      // Berkas Kartu Keluarga
      'kartukeluarga' => [
        'rules' => 'uploaded[kartukeluarga]|max_size[kartukeluarga,2048]|mime_in[kartukeluarga,application/pdf]|ext_in[kartukeluarga,pdf]',
        'errors' => [
          'uploaded' => 'Kartu Keluarga Harus Diisi !!',
          'max_size' => 'File Kartu Keluarga terlalu besar, Kompress terlebih dahulu !!',
          'mime_in' => 'Format File Harus PDF !!',
          'ext_in' => ''
        ],
      ],
      // Pas Foto
      'pasfoto' => [
        'rules' => 'max_size[pasfoto,2048]|is_image[pasfoto]|mime_in[pasfoto,image/jpg,image/jpeg,image/png]',
        'errors' => [
          'max_size' => 'Ukuran Gambar terlalu besar !!',
          'is_image' => 'Yang anda pilih bukan gambar !!',
          'mime_in' => 'Mohon File yang di inputkan berformat JPG, JPEG atau PNG'
        ],
      ],
    ]);

    if (!$validate) {
      return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Berkas Akta Kelahiran
    $berkasAktaKelahiran_KIA = $this->request->getFile('aktakelahiran');
    $namaAktaKelahiran_KIA = $berkasAktaKelahiran_KIA->getName();
    $berkasAktaKelahiran_KIA->move('pelayanan/kia', $namaAktaKelahiran_KIA);

    // Berkas Kartu Keluarga
    $berkasKartuKeluarga_KIA = $this->request->getFile('kartukeluarga');
    $namaKartuKeluarga_KIA = $berkasKartuKeluarga_KIA->getName();
    $berkasKartuKeluarga_KIA->move('pelayanan/kia', $namaKartuKeluarga_KIA);

    // Cara Memanggil Gambar
    $filePasFoto = $this->request->getFile('pasfoto');
    if ($filePasFoto->getError() == 4) {
      $namaPasFoto_KIA = 'user.PNG';
    } else {
      // Generate nama foto anak random
      $namaPasFoto_KIA = $filePasFoto->getRandomName();
      // Memindahkan File Gambar ke Folder Pelayanan / KIA
      $filePasFoto->move('pelayanan/kia', $namaPasFoto_KIA);
    }

    $this->kiaModel->save([
      'nik' => $this->request->getVar('nik'),
      'namapemohon' => $this->request->getVar('namapemohon'),
      'emailpemohon' => $this->request->getVar('emailpemohon'),
      'nomorpemohon' => $this->request->getVar('nomorpemohon'),
      'alamatpemohon' => $this->request->getVar('alamatpemohon'),
      'aktakelahiran' => $namaAktaKelahiran_KIA,
      'kartukeluarga' => $namaKartuKeluarga_KIA,
      'pasfoto' => $namaPasFoto_KIA
    ]);
    session()->setFlashdata('pesan', 'Selamat pendaftaran permohonan Kartu Identitas Anak Anda telah berhasil !!');
    return redirect()->to('/PelayananSilancar/pendaftaranKIA');
  }






  // Si Lancar 1
  // Menampilkan Form Pendaftaran KK Perceraian
  public function pendaftaranKKPerceraian()
  {
    helper(['form']);
    $data = [
      'title' => 'Pendaftaran KK Perceraian || Disdukcapil Majalengka',
      'validation' => \Config\Services::validation()
    ];
    return view('pelayanan_views/pendaftaranKKPerceraian', $data);
  }

  public function saveKKPerceraian()
  {
    $validate = $this->validate([

      // Form NIK Pemohon
      'nik' => [
        'rules' => 'required[pendaftaran_kk_perceraian.nik]',
        'errors' => [
          'required' => 'NIK Pemohon Harus Diisi !!'
        ],
      ],
      // Form Nama Pemohon
      'namapemohon' => [
        'rules' => 'required[pendaftaran_kk_perceraian.namapemohon]',
        'errors' => [
          'required' => 'Nama Pemohon Harus Diisi !!'
        ],
      ],
      // Form Email Pemohon
      'emailpemohon' => [
        'rules' => 'required[pendaftaran_kk_perceraian.emailpemohon]|valid_email',
        'errors' => [
          'required' => 'Email Pemohon Harus Diisi !!',
          'valid_email' => 'Mohon cek kembali email anda, gunakan @ agar valid !!'
        ],
      ],
      // Form Nomor Pemohon
      'nomorpemohon' => [
        'rules' => 'required[pendaftaran_kk_perceraian.nomorpemohon]|is_natural',
        'errors' => [
          'required' => 'Nomor Pemohon Harus Diisi !!',
          'is_natural' => 'Mohon menggunakan Format 082 !!',
        ],
      ],
      // Form Alamat Pemohon
      'alamatpemohon' => [
        'rules' => 'required[pendaftaran_kk_perceraian.alamatpemohon]',
        'errors' => [
          'required' => 'Alamat Pemohon Harus Diisi !!'
        ],
      ],
      // Berkas Kartu Keluarga Lama
      'kartukeluargalama' => [
        'rules' => 'uploaded[kartukeluargalama]|max_size[kartukeluargalama,2048]|mime_in[kartukeluargalama,application/pdf]|ext_in[kartukeluargalama,pdf]',
        'errors' => [
          'uploaded' => 'Kartu Keluarga Lama Harus Diisi !!',
          'max_size' => 'File Kartu Keluarga Lama terlalu besar, Kompress terlebih dahulu !!',
          'mime_in' => 'Format Kartu Keluarga Lama Harus PDF !!',
          'ext_in' => 'Format Kartu Keluarga Lama Harus PDF !!'
        ],
      ],
      // Berkas Akta Perceraian
      'aktaperceraian' => [
        'rules' => 'uploaded[aktaperceraian]|max_size[aktaperceraian,2048]|mime_in[aktaperceraian,application/pdf]|ext_in[aktaperceraian,pdf]',
        'errors' => [
          'uploaded' => 'Akta Perceraian Harus Diisi !!',
          'max_size' => 'File Akta Perceraian terlalu besar, Kompress terlebih dahulu !!',
          'mime_in' => 'Format Akta Perceraian Harus PDF !!',
          'ext_in' => 'Format Akta Perceraian Harus PDF !!'
        ],
      ],
    ]);

    if (!$validate) {
      return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Berkas Kartu Keluarga Lama
    $berkasKartuKeluargaLama_KKPerceraian = $this->request->getFile('kartukeluargalama');
    $namaKartuKeluargaLama_KKPerceraian = $berkasKartuKeluargaLama_KKPerceraian->getName();
    $berkasKartuKeluargaLama_KKPerceraian->move('pelayanan/kkperceraian', $namaKartuKeluargaLama_KKPerceraian);

    // Berkas Akta Perceraian
    $berkasAktaPerceraian_KKPerceraian = $this->request->getFile('aktaperceraian');
    $namaAktaPerceraian_KKPerceraian = $berkasAktaPerceraian_KKPerceraian->getName();
    $berkasAktaPerceraian_KKPerceraian->move('pelayanan/kkperceraian', $namaAktaPerceraian_KKPerceraian);

    $this->kkperceraianModel->save([
      'nik' => $this->request->getVar('nik'),
      'namapemohon' => $this->request->getVar('namapemohon'),
      'emailpemohon' => $this->request->getVar('emailpemohon'),
      'nomorpemohon' => $this->request->getVar('nomorpemohon'),
      'alamatpemohon' => $this->request->getVar('alamatpemohon'),
      'kartukeluargalama' => $namaKartuKeluargaLama_KKPerceraian,
      'aktaperceraian' => $namaAktaPerceraian_KKPerceraian
    ]);
    session()->setFlashdata('pesan', 'Selamat pendaftaran permohonan Kartu Keluarga Perceraian Anda telah berhasil !!');
    return redirect()->to('/PelayananSilancar/pendaftaranKKPerceraian');
  }





















  // Si Lancar 1
  // Menampilkan Form Pendaftaran Surat Perpindahan dari Majalengka ke Luar
  public function pendaftaranSuratPerpindahan()
  {
    helper(['form']);
    $data = [
      'title' => 'Pendaftaran Surat Perpindahan dari Majalengka Menuju Luar|| Disdukcapil Majalengka',
      'validation' => \Config\Services::validation()
    ];
    return view('pelayanan_views/pendaftaranSuratPerpindahan', $data);
  }

  // Menampilkan Form Pendaftaran Surat Perpindahan dari Majalengka ke Luar
  public function saveSuratPindah()
  {

    $validate = $this->validate([

      // Form NIK Pemohon
      'nik' => [
        'rules' => 'required[pendaftaran_suratperpindahan.nik]',
        'errors' => [
          'required' => 'NIK Pemohon Harus Diisi !!'
        ],
      ],
      //Form Nama Pemohon
      'namapemohon' => [
        'rules' => 'required[pendaftaran_suratperpindahan.namapemohon]',
        'errors' => [
          'required' => 'Nama Pemohon Harus Diisi !!'
        ],
      ],
      //Form Email Pemohon
      'emailpemohon' => [
        'rules' => 'required[pendaftaran_suratperpindahan.emailpemohon]|valid_email',
        'errors' => [
          'required' => 'Email Pemohon Harus Diisi !!',
          'valid_email' => 'Mohon cek kembali email anda, gunakan @ agar valid !!'
        ],
      ],
      // Form Nomor Pemohon
      'nomorpemohon' => [
        'rules' => 'required[pendaftaran_suratperpindahan.nomorpemohon]|is_natural',
        'errors' => [
          'required' => 'Nomor Pemohon Harus Diisi !!',
          'is_natural' => 'Mohon menggunakan Format 082 !!',
        ],
      ],
      //Form Alamat Pemohon
      'alamatpemohon' => [
        'rules' => 'required[pendaftaran_suratperpindahan.alamatpemohon]',
        'errors' => [
          'required' => 'Alamat Pemohon Harus Diisi !!'
        ],
      ],
      // Berkas Form Perpindahan
      'formperpindahan' => [
        'rules' => 'uploaded[formperpindahan]|max_size[formperpindahan,2048]|mime_in[formperpindahan,application/pdf]|ext_in[formperpindahan,pdf]',
        'errors' => [
          'uploaded' => 'Form Perpindahan Harus Diisi !!',
          'max_size' => 'File anda terlalu besar, Kompress terlebih dahulu !!',
          'mime_in' => 'Format Perpindahan Harus PDF !!',
          'ext_in' => 'Format Perpindahan Harus PDF !!'
        ],
      ],
      // Berkas Kartu Keluarga
      'kartukeluarga' => [
        'rules' => 'uploaded[kartukeluarga]|max_size[kartukeluarga,2048]|mime_in[kartukeluarga,application/pdf]|ext_in[kartukeluarga,pdf]',
        'errors' => [
          'uploaded' => 'Kartu Keluarga Harus Diisi !!',
          'max_size' => 'File anda terlalu besar, Kompress terlebih dahulu !!',
          'mime_in' => 'Format Kartu Keluarga Harus PDF !!',
          'ext_in' => 'Format Kartu Keluarga Harus PDF !!'
        ],
      ],
      // Berkas Buku Nikah
      'bukunikah' => [
        'rules' => 'uploaded[bukunikah]|max_size[bukunikah,2048]|mime_in[bukunikah,application/pdf]|ext_in[bukunikah,pdf]',
        'errors' => [
          'uploaded' => 'Buku Nikah Harus Diisi !!',
          'max_size' => 'File anda terlalu besar, Kompress terlebih dahulu !!',
          'mime_in' => 'Format File Harus PDF !!',
          'ext_in' => 'Format File Harus PDF !!'
        ],
      ],
      // Berkas KTP Suami
      'ktpsuami' => [
        'rules' => 'uploaded[ktpsuami]|max_size[ktpsuami,2048]|mime_in[ktpsuami,application/pdf]|ext_in[ktpsuami,pdf]',
        'errors' => [
          'uploaded' => 'KTP Suami Harus Diisi !!',
          'max_size' => 'File anda terlalu besar, Kompress terlebih dahulu !!',
          'mime_in' => 'Format KTP Suami Harus PDF !!',
          'ext_in' => 'Format KTP Suami Harus PDF !!'
        ],
      ],
      // Berkas KTP Istri
      'ktpistri' => [
        'rules' => 'uploaded[ktpistri]|max_size[ktpistri,2048]|mime_in[ktpistri,application/pdf]|ext_in[ktpistri,pdf]',
        'errors' => [
          'uploaded' => 'KTP Istri Harus Diisi !!',
          'max_size' => 'File anda terlalu besar, Kompress terlebih dahulu !!',
          'mime_in' => 'Format KTP Istri Harus PDF !!',
          'ext_in' => 'Format KTP Istri Harus PDF !!'
        ],
      ],

    ]);

    if (!$validate) {
      return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Berkas Form Perpindahan
    $berkasFormPerpindahan_Perpindahan = $this->request->getFile('formperpindahan');
    $namaFormPerpindah_Perpindahan = $berkasFormPerpindahan_Perpindahan->getName();
    $berkasFormPerpindahan_Perpindahan->move('pelayanan/perpindahan', $namaFormPerpindah_Perpindahan);

    // Berkas Kartu Keluarga
    $berkasKartuKeluarga_Perpindahan = $this->request->getFile('kartukeluarga');
    $namaKartuKeluarga_Perpindahan = $berkasKartuKeluarga_Perpindahan->getName();
    $berkasKartuKeluarga_Perpindahan->move('pelayanan/perpindahan', $namaKartuKeluarga_Perpindahan);

    // Berkas Buku Nikah
    $berkasBukuNikah_Perpindahan = $this->request->getFile('bukunikah');
    $namaBukuNikah_Perpindahan = $berkasBukuNikah_Perpindahan->getName();
    $berkasBukuNikah_Perpindahan->move('pelayanan/perpindahan', $namaBukuNikah_Perpindahan);

    // Berkas KTP Suami
    $berkasKTPSuami_Perpindahan = $this->request->getFile('ktpsuami');
    $namaKTPSuami_Perpindahan = $berkasKTPSuami_Perpindahan->getName();
    $berkasKTPSuami_Perpindahan->move('pelayanan/perpindahan', $namaKTPSuami_Perpindahan);

    // Berkas KTP Istri
    $berkasKTPIstri_Perpindahan = $this->request->getFile('ktpistri');
    $namaKTPIstri_Perpindahan = $berkasKTPIstri_Perpindahan->getName();
    $berkasKTPIstri_Perpindahan->move('pelayanan/perpindahan', $namaKTPIstri_Perpindahan);

    $this->suratperpindahanModel->save([
      'nik' => $this->request->getVar('nik'),
      'namapemohon' => $this->request->getVar('namapemohon'),
      'emailpemohon' => $this->request->getVar('emailpemohon'),
      'nomorpemohon' => $this->request->getVar('nomorpemohon'),
      'alamatpemohon' => $this->request->getVar('alamatpemohon'),
      'formperpindahan' => $namaFormPerpindah_Perpindahan,
      'kartukeluarga' => $namaKartuKeluarga_Perpindahan,
      'bukunikah' => $namaBukuNikah_Perpindahan,
      'ktpsuami' => $namaKTPSuami_Perpindahan,
      'ktpistri' => $namaKTPIstri_Perpindahan
    ]);
    session()->setFlashdata('pesan', 'Selamat pendaftaran permohonan Surat Perpindahan Majalengka menuju Luar Anda telah berhasil !!');
    return redirect()->to('/PelayananSilancar/pendaftaranSuratPerpindahan/');
  }








  // Si Lancar 1
  // Menampilkan Form Pendaftaran Surat Perpindahan dari Luar ke Majalengka
  public function pendaftaranSuratPerpindahanLuar()
  {
    helper(['form']);
    $data = [
      'title' => 'Pendaftaran Surat Perpindahan dari Luar ke Majalengka || Disdukcapil Majalengka',
      'validation' => \Config\Services::validation()
    ];
    return view('pelayanan_views/pendaftaranSuratPerpindahanLuar', $data);
  }

  // Validasi Pendaftaran Surat Perpindahan dari Luar ke Majalengka
  public function saveSuratPindahLuar()
  {

    $validate = $this->validate([

      // Form NIK Pemohon
      'nik' => [
        'rules' => 'required[pendaftaran_suratperpindahanluar.nik]',
        'errors' => [
          'required' => 'NIK Pemohon Harus Diisi !!'
        ],
      ],
      //Form Nama Pemohon
      'namapemohon' => [
        'rules' => 'required[pendaftaran_suratperpindahanluar.namapemohon]',
        'errors' => [
          'required' => 'Nama Pemohon Harus Diisi !!'
        ],
      ],
      //Form Email Pemohon
      'emailpemohon' => [
        'rules' => 'required[pendaftaran_suratperpindahanluar.emailpemohon]|valid_email',
        'errors' => [
          'required' => 'Email Pemohon Harus Diisi !!',
          'valid_email' => 'Mohon cek kembali email anda, gunakan @ agar valid !!'
        ],
      ],
      // Form Nomor Pemohon
      'nomorpemohon' => [
        'rules' => 'required[pendaftaran_suratperpindahanluar.nomorpemohon]|is_natural',
        'errors' => [
          'required' => 'Nomor Pemohon Harus Diisi !!',
          'is_natural' => 'Mohon menggunakan Format 082 !!',
        ],
      ],
      //Form Alamat Pemohon
      'alamatpemohon' => [
        'rules' => 'required[pendaftaran_suratperpindahanluar.alamatpemohon]',
        'errors' => [
          'required' => 'Alamat Pemohon Harus Diisi !!'
        ],
      ],
      // Berkas SKPWNI
      'skpwni' => [
        'rules' => 'uploaded[skpwni]|max_size[skpwni,2048]|mime_in[skpwni,application/pdf]|ext_in[skpwni,pdf]',
        'errors' => [
          'uploaded' => 'File SKPWNI Harus Diisi !!',
          'max_size' => 'File SKPWNI terlalu besar, Kompress terlebih dahulu !!',
          'mime_in' => 'Format SKPWNI Harus PDF !!',
          'ext_in' => 'Format SKPWNI Harus PDF !!'
        ],
      ],
      // Berkas KTP
      'kartutandapenduduk' => [
        'rules' => 'uploaded[kartutandapenduduk]|max_size[kartutandapenduduk,2048]|mime_in[kartutandapenduduk,application/pdf]|ext_in[kartutandapenduduk,pdf]',
        'errors' => [
          'uploaded' => 'File KTP Harus Diisi !!',
          'max_size' => 'File KTP terlalu besar, Kompress terlebih dahulu !!',
          'mime_in' => 'Format KTP Harus PDF !!',
          'ext_in' => 'Format KTP Harus PDF !!'
        ],
      ],

    ]);

    if (!$validate) {
      return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Berkas SKPWNI
    $berkasSKPWNI_Perpindahan = $this->request->getFile('skpwni');
    $namaSKWPNI_Perpindahan = $berkasSKPWNI_Perpindahan->getName();
    $berkasSKPWNI_Perpindahan->move('pelayanan/perpindahan_luar', $namaSKWPNI_Perpindahan);

    // Berkas KTP
    $berkasKartuTandaPenduduk_Perpindahan = $this->request->getFile('kartutandapenduduk');
    $namaKartuTandaPenduduk_Perpindahan = $berkasKartuTandaPenduduk_Perpindahan->getName();
    $berkasKartuTandaPenduduk_Perpindahan->move('pelayanan/perpindahan_luar', $namaKartuTandaPenduduk_Perpindahan);

    $this->suratperpindahanluarModel->save([
      'nik' => $this->request->getVar('nik'),
      'namapemohon' => $this->request->getVar('namapemohon'),
      'emailpemohon' => $this->request->getVar('emailpemohon'),
      'nomorpemohon' => $this->request->getVar('nomorpemohon'),
      'alamatpemohon' => $this->request->getVar('alamatpemohon'),
      'skpwni' => $namaSKWPNI_Perpindahan,
      'kartutandapenduduk' => $namaKartuTandaPenduduk_Perpindahan
    ]);
    session()->setFlashdata('pesan', 'Selamat pendaftaran permohonan Surat Perpindahan Luar menuju Majalengka Anda telah berhasil !!');
    return redirect()->to('/PelayananSilancar/pendaftaranSuratPerpindahanLuar/');
  }







  // Si Lancar 2
  // Menampilkan Form Pendaftaran Akta Kelahiran
  public function pendaftaranAktaKelahiran()
  {
    helper(['form']);
    $data = [
      'title' => 'Pendaftaran Akta Kelahiran || Disdukcapil Majalengka',
      'validation' => \Config\Services::validation()
    ];
    return view('pelayanan_views/pendaftaranAktaKelahiran', $data);
  }

  // Validasi Akta Kelahiran
  public function saveAktaKelahiran()
  {

    $validate = $this->validate([

      // Form NIK Pemohon
      'nik' => [
        'rules' => 'required[pendaftaran_aktakelahiran.nik]',
        'errors' => [
          'required' => 'NIK Pemohon Harus Diisi !!'
        ],
      ],
      // Form Nama Pemohon
      'namapemohon' => [
        'rules' => 'required[pendaftaran_aktakelahiran.namapemohon]',
        'errors' => [
          'required' => 'Nama Pemohon Harus Diisi !!'
        ],
      ],
      // Form Email Pemohon
      'emailpemohon' => [
        'rules' => 'required[pendaftaran_aktakelahiran.emailpemohon]|valid_email',
        'errors' => [
          'required' => 'Email Pemohon Harus Diisi !!',
          'valid_email' => 'Mohon cek kembali email anda, gunakan @ agar valid !!'
        ],
      ],
      // Form Nomor Pemohon
      'nomorpemohon' => [
        'rules' => 'required[pendaftaran_aktakelahiran.nomorpemohon]|is_natural',
        'errors' => [
          'required' => 'Nomor Pemohon Harus Diisi !!',
          'is_natural' => 'Mohon menggunakan Format 082 !!',
        ],
      ],
      // Form Alamat Pemohon
      'alamatpemohon' => [
        'rules' => 'required[pendaftaran_aktakelahiran.alamatpemohon]',
        'errors' => [
          'required' => 'Alamat Pemohon Harus Diisi !!'
        ],
      ],
      // Berkas F2.01 Akta
      'formulirf201akta' => [
        'rules' => 'uploaded[formulirf201akta]|max_size[formulirf201akta,2048]|mime_in[formulirf201akta,application/pdf]|ext_in[formulirf201akta,pdf]',
        'errors' => [
          'uploaded' => 'Formulir F201 Akta Kelahiran Harus Diisi !!',
          'max_size' => 'File anda terlalu besar, Kompress terlebih dahulu !!',
          'mime_in' => 'Format F201 Akta Kelahiran Harus PDF !!',
          'ext_in' => 'Format F201 Akta Kelahiran Harus PDF !!'
        ],
      ],
      // Berkas Surat Keterangan Lahir
      'suratketeranganlahir' => [
        'rules' => 'uploaded[suratketeranganlahir]|max_size[suratketeranganlahir,2048]|mime_in[suratketeranganlahir,application/pdf]|ext_in[suratketeranganlahir,pdf]',
        'errors' => [
          'uploaded' => 'Surat Keterangan Lahir Harus Diisi !!',
          'max_size' => 'File anda terlalu besar, Kompress terlebih dahulu !!',
          'mime_in' => 'Format Surat Keterangan Lahir Harus PDF !!',
          'ext_in' => ''
        ],
      ],
      // Berkas Kartu Keluarga
      'kartukeluarga' => [
        'rules' => 'uploaded[kartukeluarga]|max_size[kartukeluarga,2048]|mime_in[kartukeluarga,application/pdf]|ext_in[kartukeluarga,pdf]',
        'errors' => [
          'uploaded' => 'Kartu Keluarga Harus Diisi !!',
          'max_size' => 'File anda terlalu besar, Kompress terlebih dahulu !!',
          'mime_in' => 'Format Kartu Keluarga Harus PDF !!',
          'ext_in' => ''
        ],
      ],
      // Berkas Buku Nikah
      'bukunikah' => [
        'rules' => 'uploaded[bukunikah]|max_size[bukunikah,2048]|mime_in[bukunikah,application/pdf]|ext_in[bukunikah,pdf]',
        'errors' => [
          'uploaded' => 'Buku Nikah Harus Diisi !!',
          'max_size' => 'File Buku Nikah terlalu besar, Kompress terlebih dahulu !!',
          'mime_in' => 'Format Buku Nikah Harus PDF !!',
          'ext_in' => 'Format Buku Nikah Harus PDF !!'
        ],
      ],
      // Berkas KTP Ayah
      'ktpayah' => [
        'rules' => 'uploaded[ktpayah]|max_size[ktpayah,2048]|mime_in[ktpayah,application/pdf]|ext_in[ktpayah,pdf]',
        'errors' => [
          'uploaded' => 'KTP Ayah Harus Diisi !!',
          'max_size' => 'File anda terlalu besar, Kompress terlebih dahulu !!',
          'mime_in' => 'Format KTP Ayah Harus PDF !!',
          'ext_in' => 'Format KTP Ayah Harus PDF !!'
        ],
      ],
      // Berkas KTP Ibu
      'ktpibu' => [
        'rules' => 'uploaded[ktpibu]|max_size[ktpibu,2048]|mime_in[ktpibu,application/pdf]|ext_in[ktpibu,pdf]',
        'errors' => [
          'uploaded' => 'KTP Ibu Harus Diisi !!',
          'max_size' => 'File anda terlalu besar, Kompress terlebih dahulu !!',
          'mime_in' => 'Format KTP Ibu Harus PDF !!',
          'ext_in' => 'Format KTP Ibu Harus PDF !!'
        ],
      ],
    ]);

    if (!$validate) {
      return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Berkas Formulir F201 
    $berkasFormulirF201_Akla = $this->request->getFile('formulirf201akta');
    $namaFormulirF201_Akla = $berkasFormulirF201_Akla->getName();
    $berkasFormulirF201_Akla->move('pelayanan/aktakelahiran', $namaFormulirF201_Akla);

    // Berkas Surat Keterangan Lahir
    $berkasSuratKeteranganLahir_Akla = $this->request->getFile('suratketeranganlahir');
    $namaSuratKeteranganLahir_Akla = $berkasSuratKeteranganLahir_Akla->getName();
    $berkasSuratKeteranganLahir_Akla->move('pelayanan/aktakelahiran', $namaSuratKeteranganLahir_Akla);

    // Berkas Kartu Keluarga
    $berkasKartuKeluarga_Akla = $this->request->getFile('kartukeluarga');
    $namaKartuKeluarga_Akla = $berkasKartuKeluarga_Akla->getName('');
    $berkasKartuKeluarga_Akla->move('pelayanan/aktakelahiran', $namaKartuKeluarga_Akla);

    // Berkas Buku Nikah
    $berkasBukuNikah_Akla = $this->request->getFile('bukunikah');
    $namaBukuNikah_Akla = $berkasBukuNikah_Akla->getName('');
    $berkasBukuNikah_Akla->move('pelayanan/aktakelahiran', $namaBukuNikah_Akla);

    // Berkas KTP Ayah
    $berkasKTPAyah_Akla = $this->request->getFile('ktpayah');
    $namaKTPAyah_Akla = $berkasKTPAyah_Akla->getName();
    $berkasKTPAyah_Akla->move('pelayanan/aktakelahiran', $namaKTPAyah_Akla);

    // Berkas KTP Ibu
    $berkasKTPIbu_Akla = $this->request->getFile('ktpibu');
    $namaKTPIbu_Akla = $berkasKTPIbu_Akla->getName();
    $berkasKTPIbu_Akla->move('pelayanan/aktakelahiran', $namaKTPIbu_Akla);

    $this->aktakelahiranModel->save([
      'nik' => $this->request->getVar('nik'),
      'namapemohon' => $this->request->getVar('namapemohon'),
      'emailpemohon' => $this->request->getVar('emailpemohon'),
      'nomorpemohon' => $this->request->getVar('nomorpemohon'),
      'alamatpemohon' => $this->request->getVar('alamatpemohon'),
      'formulirf201akta' => $namaFormulirF201_Akla,
      'kartukeluarga' => $namaKartuKeluarga_Akla,
      'bukunikah' => $namaBukuNikah_Akla,
      'suratketeranganlahir' => $namaSuratKeteranganLahir_Akla,
      'ktpayah' => $namaKTPAyah_Akla,
      'ktpibu' => $namaKTPIbu_Akla
    ]);
    session()->setFlashdata('pesan', 'Selamat pendaftaran permohonan Akta Kelahiran Anda telah berhasil !!');
    return redirect()->to('/PelayananSilancar/pendaftaranAktaKelahiran/');
  }
















  // Si Lancar 2
  // Menampilkan Form Pendaftaran Akta Kematian
  public function pendaftaranAktaKematian()
  {
    helper(['form']);
    $data = [
      'title' => 'Pendaftaran Akta Kematian || Disdukcapil Majalengka',
      'validation' => \Config\Services::validation()
    ];
    return view('pelayanan_views/pendaftaranAktaKematian', $data);
  }

  // Validasi Pendaftaran Akta Kematian
  public function saveAktakematian()
  {
    $validate = $this->validate([

      // Form NIK Pemohon
      'nik' => [
        'rules' => 'required[pendaftaran_aktakematian.nik]',
        'errors' => [
          'required' => 'NIK Pemohon Harus Diisi !!'
        ],
      ],
      // Form Nama Pemohon
      'namapemohon' => [
        'rules' => 'required[pendaftaran_aktakematian.namapemohon]',
        'errors' => [
          'required' => 'Nama Pemohon Harus Diisi !!'
        ],
      ],
      // Form Email Pemohon
      'emailpemohon' => [
        'rules' => 'required[pendaftaran_aktakematian.emailpemohon]|valid_email',
        'errors' => [
          'required' => 'Email Pemohon Harus Diisi !!',
          'valid_email' => 'Mohon cek kembali email anda, gunakan @ agar valid !!'
        ],
      ],
      // Form Nomor Pemohon
      'nomorpemohon' => [
        'rules' => 'required[pendaftaran_aktakematian.nomorpemohon]|is_natural',
        'errors' => [
          'required' => 'Nomor Pemohon Harus Diisi !!',
          'is_natural' => 'Mohon menggunakan Format 082 !!',
        ],
      ],
      // Form Alamat Pemohon
      'alamatpemohon' => [
        'rules' => 'required[pendaftaran_aktakematian.alamatpemohon]',
        'errors' => [
          'required' => 'Alamat Pemohon Harus Diisi !!'
        ],
      ],
      // Berkas KK
      'kartukeluarga' => [
        'rules' => 'uploaded[kartukeluarga]|max_size[kartukeluarga,2048]|mime_in[kartukeluarga,application/pdf]|ext_in[kartukeluarga,pdf]',
        'errors' => [
          'uploaded' => 'Kartu Keluarga Harus Diisi !!',
          'max_size' => 'File kartu Keluarga terlalu besar, Kompress terlebih dahulu !!',
          'mime_in' => 'Format Kartu Keluarga Harus PDF !!',
          'ext_in' => 'Format Kartu Keluarga Harus PDF !!'
        ],
      ],
      // Berkas Surat Kematian
      'suratkematian' => [
        'rules' => 'uploaded[suratkematian]|max_size[suratkematian,2048]|mime_in[suratkematian,application/pdf]|ext_in[suratkematian,pdf]',
        'errors' => [
          'uploaded' => 'Surat Kematian Harus Diisi !!',
          'max_size' => 'File Surat Kematian terlalu besar, Kompress terlebih dahulu !!',
          'mime_in' => 'Format Surat Kematian Harus PDF !!',
          'ext_in' => 'Format Surat Kematian Harus PDF !!'
        ],
      ],
    ]);

    if (!$validate) {
      return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Berkas KK
    $berkasKK_Akket = $this->request->getFile('kartukeluarga');
    $namaKK_Akket = $berkasKK_Akket->getName();
    $berkasKK_Akket->move('pelayanan/aktakematian', $namaKK_Akket);

    // Berkas Surat Kematian
    $berkasSuratKematian_Akket = $this->request->getFile('suratkematian');
    $namaSuratKematian_Akket = $berkasSuratKematian_Akket->getName();
    $berkasSuratKematian_Akket->move('pelayanan/aktakematian', $namaSuratKematian_Akket);

    $this->aktakematianModel->save([
      'nik' => $this->request->getVar('nik'),
      'namapemohon' => $this->request->getVar('namapemohon'),
      'emailpemohon' => $this->request->getVar('emailpemohon'),
      'nomorpemohon' => $this->request->getVar('nomorpemohon'),
      'alamatpemohon' => $this->request->getVar('alamatpemohon'),
      'kartukeluarga' => $namaKK_Akket,
      'suratkematian' => $namaSuratKematian_Akket
    ]);
    session()->setFlashdata('pesan', 'Selamat pendaftaran permohonan Akta Kematian Anda telah berhasil !!');
    return redirect()->to('/PelayananSilancar/pendaftaranAktaKematian');
  }















  // Si Lancar 2
  // Menampilkan Form Pendaftaran Keabsahan Akta Kelahiran
  public function pendaftaranKeabsahanAkla()
  {
    helper(['form']);
    $data = [
      'title' => 'Pendaftaran Keabsahan Akta Kelahiran || Disdukcapil Majalengka',
      'validation' => \Config\Services::validation()
    ];
    return view('pelayanan_views/pendaftaranKeabsahanAkla', $data);
  }

  // Validasi Keabsahan Akta Kelahiran
  public function saveKeabsahanAkla()
  {
    $validate = $this->validate([

      // Form NIK Pemohon
      'nik' => [
        'rules' => 'required[pendaftaran_keabsahanakla.nik]',
        'errors' => [
          'required' => 'NIK Pemohon Harus Diisi !!'
        ],
      ],
      // Form Nama Pemohon
      'namapemohon' => [
        'rules' => 'required[pendaftaran_keabsahanakla.namapemohon]',
        'errors' => [
          'required' => 'Nama Pemohon Harus Diisi !!'
        ],
      ],
      // Form Email Pemohon
      'emailpemohon' => [
        'rules' => 'required[pendaftaran_keabsahanakla.emailpemohon]|valid_email',
        'errors' => [
          'required' => 'Email Pemohon Harus Diisi !!',
          'valid_email' => 'Mohon cek kembali email anda, gunakan @ agar valid !!'
        ],
      ],
      // Form Nomor Pemohon
      'nomorpemohon' => [
        'rules' => 'required[pendaftaran_keabsahanakla.nomorpemohon]|is_natural',
        'errors' => [
          'required' => 'Nomor Pemohon Harus Diisi !!',
          'is_natural' => 'Mohon menggunakan Format 082 !!',
        ],
      ],
      // Form Alamat Pemohon
      'alamatpemohon' => [
        'rules' => 'required[pendaftaran_keabsahanakla.alamatpemohon]',
        'errors' => [
          'required' => 'Alamat Pemohon Harus Diisi !!'
        ],
      ],
      // Berkas Akta Kelahiran
      'aktakelahiran' => [
        'rules' => 'uploaded[aktakelahiran]|max_size[aktakelahiran,2048]|mime_in[aktakelahiran,application/pdf]|ext_in[aktakelahiran,pdf]',
        'errors' => [
          'uploaded' => 'Formulir Akta Kelahiran Harus Diisi !!',
          'max_size' => 'File Akta Kelahiran terlalu besar, Kompress terlebih dahulu !!',
          'mime_in' => 'Format Akta Kelahirans Harus PDF !!',
          'ext_in' => 'Format Akta Kelahirans Harus PDF !!'
        ],
      ],
      // Berkas Kartu Tanda Penduduk
      'kartutandapenduduk' => [
        'rules' => 'uploaded[kartutandapenduduk]|max_size[kartutandapenduduk,2048]|mime_in[kartutandapenduduk,application/pdf]|ext_in[kartutandapenduduk,pdf]',
        'errors' => [
          'uploaded' => 'Formulir KTP Harus Diisi !!',
          'max_size' => 'File KTP terlalu besar, Kompress terlebih dahulu !!',
          'mime_in' => 'Format KTP Harus PDF !!',
          'ext_in' => 'Format KTP Harus PDF !!'
        ],
      ],


    ]);

    if (!$validate) {
      return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Berkas Akta Kelahiran 
    $berkasAktaKelahiran_Akla = $this->request->getFile('aktakelahiran');
    $namaAktaKelahiran_Akla = $berkasAktaKelahiran_Akla->getName();
    $berkasAktaKelahiran_Akla->move('pelayanan/keabsahanaktakelahiran', $namaAktaKelahiran_Akla);

    $berkasKartuTandaPenduduk_Akla = $this->request->getFile('kartutandapenduduk');
    $namaKartuTandaPenduduk_Akla = $berkasKartuTandaPenduduk_Akla->getName();
    $berkasKartuTandaPenduduk_Akla->move('pelayanan/keabsahanaktakelahiran', $namaAktaKelahiran_Akla);

    $this->keabsahanaklaModel->save([
      'nik' => $this->request->getVar('nik'),
      'namapemohon' => $this->request->getVar('namapemohon'),
      'emailpemohon' => $this->request->getVar('emailpemohon'),
      'nomorpemohon' => $this->request->getVar('nomorpemohon'),
      'alamatpemohon' => $this->request->getVar('alamatpemohon'),
      'aktakelahiran' => $namaAktaKelahiran_Akla,
      'kartutandapenduduk' => $namaKartuTandaPenduduk_Akla

    ]);
    session()->setFlashdata('pesan', 'Selamat pendaftaran permohonan Keabsahan Akta Kelahiran Anda telah berhasil !!');
    return redirect()->to('/PelayananSilancar/pendaftaranKeabsahanAkla/');
  }















  // Si Lancar 3
  // Menampilkan Halaman Pendaftaran Pelayanan Pemanfaatan Data
  public function pendaftaranPelayananData()
  {
    helper(['form']);
    $data = [
      'title' => 'Pendaftaran Pelayanan Pemanfaatan Data dan Inovasi || Disdukcapil Majalengka',
      'validation' => \Config\Services::validation()
    ];
    return view('pelayanan_views/pendaftaranPelayananData', $data);
  }


  // Validasi Pendaftaran Pelayanan
  public function savePelayananData()
  {
    $rule = [

      // Form NIK Pemohon
      'nik' => [
        'rules' => 'required[pendaftaran_pelayanandata.nik]',
        'errors' => [
          'required' => 'NIK Pemohon Harus Diisi !!'
        ],
      ],
      // Form Nama Pemohon
      'namapemohon' => [
        'rules' => 'required[pendaftaran_pelayanandata.namapemohon]',
        'errors' => [
          'required' => 'Nama Pemohon Harus Diisi !!'
        ],
      ],
      // Form Email Pemohon
      'emailpemohon' => [
        'rules' => 'required[pendaftaran_pelayanandata.emailpemohon]|valid_email',
        'errors' => [
          'required' => 'Email Pemohon Harus Diisi !!',
          'valid_email' => 'Mohon cek kembali email anda, gunakan @ agar valid !!'
        ],
      ],
      // Form Nomor Pemohon
      'nomorpemohon' => [
        'rules' => 'required[pendaftaran_pelayanandata.nomorpemohon]|is_natural',
        'errors' => [
          'required' => 'Nomor Pemohon Harus Diisi !!',
          'is_natural' => 'Mohon menggunakan Format 082 !!',
        ],
      ],
      // Form Alamat Pemohon
      'alamatpemohon' => [
        'rules' => 'required[pendaftaran_pelayanandata.alamatpemohon]',
        'errors' => [
          'required' => 'Alamat Pemohon Harus Diisi !!'
        ],
      ],
      // Berkas Pelayanan 
      'berkaspelayanan' => [
        'rules' => 'uploaded[berkaspelayanan.0]|max_size[berkaspelayanan,2048]|mime_in[berkaspelayanan,application/pdf]|ext_in[berkaspelayanan,pdf]',
        'errors' => [
          'uploaded' => 'Berkas Pelayanan Harus Diisi & Minimal 1 File !!',
          'max_size' => 'File Berkas Pelayanan terlalu besar, Kompress terlebih dahulu !!',
          'mime_in' => 'Format Berkas Pelayanan Harus PDF !!',
          'ext_in' => 'Format Berkas Pelayanan Harus PDF !!'
        ],
      ],
    ];

    if (!$this->validate($rule)) {
      return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    $berkaspelayanan = $this->request->getFileMultiple('berkaspelayanan');
    $jmlberkas = count($berkaspelayanan);

    if ($jmlberkas > 10) {
      session()->setFlashdata('error', '<span class="text-danger">Maksimal anda hanya boleh mengupload 10 file</span>');
      return redirect()->to('/PelayananSilancar/pendaftaranPelayananData/');
    }

    foreach ($berkaspelayanan as $i => $berkas) {
      if ($berkas->isValid() && !$berkas->hasMoved()) {
        $files[$i] = $berkas->getName();
        $berkas->move('pelayanan/pelayanan_data', $files[$i]);
      }
    }

    $berkasPelayanan2 = (array_key_exists(1, $files) ? $files[1] : null);
    $berkasPelayanan3 = (array_key_exists(2, $files) ? $files[2] : null);
    $berkasPelayanan4 = (array_key_exists(3, $files) ? $files[3] : null);
    $berkasPelayanan5 = (array_key_exists(4, $files) ? $files[4] : null);
    $berkasPelayanan6 = (array_key_exists(5, $files) ? $files[5] : null);
    $berkasPelayanan7 = (array_key_exists(6, $files) ? $files[6] : null);
    $berkasPelayanan8 = (array_key_exists(7, $files) ? $files[7] : null);
    $berkasPelayanan9 = (array_key_exists(8, $files) ? $files[8] : null);
    $berkasPelayanan10 = (array_key_exists(9, $files) ? $files[9] : null);

    $this->pelayanandataModel->save([
      'nik' => $this->request->getVar('nik'),
      'namapemohon' => $this->request->getVar('namapemohon'),
      'emailpemohon' => $this->request->getVar('emailpemohon'),
      'nomorpemohon' => $this->request->getVar('nomorpemohon'),
      'alamatpemohon' => $this->request->getVar('alamatpemohon'),
      'berkaspelayanan1' => $files[0],
      'berkaspelayanan2' => $berkasPelayanan2,
      'berkaspelayanan3' => $berkasPelayanan3,
      'berkaspelayanan4' => $berkasPelayanan4,
      'berkaspelayanan5' => $berkasPelayanan5,
      'berkaspelayanan6' => $berkasPelayanan6,
      'berkaspelayanan7' => $berkasPelayanan7,
      'berkaspelayanan8' => $berkasPelayanan8,
      'berkaspelayanan9' => $berkasPelayanan9,
      'berkaspelayanan10' => $berkasPelayanan10,
    ]);

    session()->setFlashdata('pesan', 'Selamat pendaftaran permohnan Pelayanan Pemanfaatan Data Anda telah berhasil !!');
    return redirect()->to('/PelayananSilancar/pendaftaranPelayananData/');
  }
















  // Si Lancar 4
  // Menampilkan Halaman Pendaftaran Perbaikan Data
  public function pendaftaranPerbaikanData()
  {
    helper(['form']);
    $data = [
      'title' => 'Pendaftaran Perbaikan Data || Disdukcapil Majalengka',
      'validation' => \Config\Services::validation()
    ];
    return view('pelayanan_views/pendaftaranPerbaikanData', $data);
  }

  // Validasi Form Perbaikan Data
  public function savePerbaikanData()
  {
    $rule = [
      // Form Nama Pemohon
      // Form NIK Pemohon
      'nik' => [
        'rules' => 'required[perbaikan_data.nik]',
        'errors' => [
          'required' => 'NIK Pemohon Harus Diisi !!'
        ],
      ],
      'namapemohon' => [
        'rules' => 'required[perbaikan_data.namapemohon]',
        'errors' => [
          'required' => 'Nama Pemohon Harus Diisi !!'
        ],
      ],
      // Form Email Pemohon
      'emailpemohon' => [
        'rules' => 'required[perbaikan_data.emailpemohon]|valid_email',
        'errors' => [
          'required' => 'Email Pemohon Harus Diisi !!',
          'valid_email' => 'Mohon cek kembali email anda, gunakan @ agar valid !!'
        ],
      ],
      // Form Nomor Pemohon
      'nomorpemohon' => [
        'rules' => 'required[perbaikan_data.nomorpemohon]|is_natural',
        'errors' => [
          'required' => 'Nomor Pemohon Harus Diisi !!',
          'is_natural' => 'Mohon menggunakan Format 082 !!',
        ],
      ],
      // Form Alamat Pemohon
      'alamatpemohon' => [
        'rules' => 'required[perbaikan_data.alamatpemohon]',
        'errors' => [
          'required' => 'Alamat Pemohon Harus Diisi !!'
        ],
      ],
      // Judul Perbaikan
      'judulperbaikan' => [
        'rules' => 'required[perbaikan_data.judulperbaikan]',
        'errors' => [
          'required' => 'Judul Perbaikan Harus Diisi !!'
        ],
      ],
      // Form Penjelasan Perbaikan
      'penjelasanperbaikan' => [
        'rules' => 'required[perbaikan_data.penjelasanperbaikan]',
        'errors' => [
          'required' => 'Penjelasan Perbaikan Harus Diisi !!'
        ],
      ],
      // Berkas Perbaikan
      'berkasperbaikan' => [
        'rules' => 'uploaded[berkasperbaikan.0]|max_size[berkasperbaikan,2048]|mime_in[berkasperbaikan,application/pdf]|ext_in[berkasperbaikan,pdf]',
        'errors' => [
          'uploaded' => 'Berkas Perbaikan Harus Diisi & Minimal 1 File !!',
          'max_size' => 'File Berkas Perbaikan terlalu besar, Kompress terlebih dahulu !!',
          'mime_in' => 'Format Berkas Perbaikan Harus PDF !!',
          'ext_in' => 'Format Berkas Perbaikan Harus PDF !!'
        ],
      ],
    ];

    if (!$this->validate($rule)) {
      return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    $berkasperbaikan = $this->request->getFileMultiple('berkasperbaikan');
    $jmlberkas = count($berkasperbaikan);

    if ($jmlberkas > 5) {
      session()->setFlashdata('error', '<span class="text-danger">Maksimal anda hanya boleh mengupload 5 File</span>');
      return redirect()->to('/PelayananSilancar/pendaftaranPerbaikanData/');
    }

    foreach ($berkasperbaikan as $i =>  $berkas) {
      if ($berkas->isValid() && !$berkas->hasMoved()) {
        $files[$i] = $berkas->getRandomName();
        $berkas->move('pelayanan/perbaikan_data', $files[$i]);
      }
    }

    $berkasperbaikan_dua = (array_key_exists(1, $files) ? $files[1] : null);
    $berkasperbaikan_tiga = (array_key_exists(2, $files) ? $files[2] : null);
    $berkasperbaikan_empat = (array_key_exists(3, $files) ? $files[3] : null);
    $berkasperbaikan_lima = (array_key_exists(4, $files) ? $files[4] : null);

    $this->perbaikandataModel->save([
      'nik' => $this->request->getVar('nik'),
      'namapemohon' => $this->request->getVar('namapemohon'),
      'emailpemohon' => $this->request->getVar('emailpemohon'),
      'nomorpemohon' => $this->request->getVar('nomorpemohon'),
      'alamatpemohon' => $this->request->getVar('alamatpemohon'),
      'judulperbaikan' => $this->request->getVar('judulperbaikan'),
      'berkasperbaikan_satu' => $files[0],
      'berkasperbaikan_dua' => $berkasperbaikan_dua,
      'berkasperbaikan_tiga' => $berkasperbaikan_tiga,
      'berkasperbaikan_empat' => $berkasperbaikan_empat,
      'berkasperbaikan_lima' => $berkasperbaikan_lima,
      'penjelasanperbaikan' => $this->request->getVar('penjelasanperbaikan')
    ]);

    session()->setFlashdata('pesan', 'Selamat pendaftaran permohonan Perbaikan Data anda telah berhasil !!');
    return redirect()->to('/PelayananSilancar/pendaftaranPerbaikanData/');
  }



















  // Si Lancar 4
  // Menampilkan Form Pengaduan Update
  public function pendaftaranPengaduanUpdate()
  {
    helper(['form']);
    $data = [
      'title' => 'Pengaduan Update || Disdukcapil Majalengka',
      'validation' => \Config\Services::validation()
    ];
    return view('pelayanan_views/pendaftaranPengaduanUpdate', $data);
  }

  // Validasi Form Pengaduan Update
  public function savePengaduanUpdate()
  {
    $validate = $this->validate([

      // Form NIK Pemohon
      'nik' => [
        'rules' => 'required[pengaduan_update.nik]',
        'errors' => [
          'required' => 'NIK Pemohon Harus Diisi !!'
        ],
      ],
      // Form Nama Pemohon
      'namapemohon' => [
        'rules' => 'required[pengaduan_update.namapemohon]',
        'errors' => [
          'required' => 'Nama Pelapor Harus Diisi !!'
        ],
      ],
      // Form Email Pemohon
      'emailpemohon' => [
        'rules' => 'required[pengaduan_update.emailpemohon]|valid_email',
        'errors' => [
          'required' => 'Email Pelapor Harus Diisi !!',
          'valid_email' => 'Mohon cek kembali email anda, gunakan @ agar valid !!'
        ],
      ],
      // Form Nomor Pemohon
      'nomorpemohon' => [
        'rules' => 'required[pengaduan_update.nomorpemohon]|is_natural',
        'errors' => [
          'required' => 'Nomor Pemohon Harus Diisi !!',
          'is_natural' => 'Mohon menggunakan Format 082 !!',
        ],
      ],
      // Form Alamat Pemohon
      'alamatpemohon' => [
        'rules' => 'required[pengaduan_update.alamatpemohon]',
        'errors' => [
          'required' => 'Alamat Pelapor Harus Diisi !!'
        ],
      ],
      // Form Pengaduan Update
      'pengaduanupdate' => [
        'rules' => 'required[pengaduan_update.pengaduanupdate]',
        'errors' => [
          'required' => 'Pengaduan Harus Diisi !!'
        ],
      ],
      // Berkas Kartu Tanda Penduduk
      'kartutandapenduduk' => [
        'rules' => 'uploaded[kartutandapenduduk]|mime_in[kartutandapenduduk,image/jpg,image/jpeg,image/png,application/pdf]',
        'errors' => [
          'uploaded' => 'Surat Kematian Harus di isi !!',
          'mime_in' => 'Yang anda pilih bukan gambar'
        ],
      ],
      // Berkas KK
      'kartukeluarga' => [
        'rules' => 'uploaded[kartukeluarga]|mime_in[kartukeluarga,image/jpg,image/jpeg,image/png,application/pdf]',
        'errors' => [
          'uploaded' => 'Surat Kematian Harus di isi !!',
          'mime_in' => 'Yang anda pilih bukan gambar'
        ],
      ],
    ]);

    if (!$validate) {
      return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Berkas KTP
    $berkasKTP_PengUp = $this->request->getFile('kartutandapenduduk');
    $namaKTP_PengUp = $berkasKTP_PengUp->getName();
    $berkasKTP_PengUp->move('pelayanan/pengaduan_update', $namaKTP_PengUp);

    // Berkas KK
    $berkasKK_Pengup = $this->request->getFile('kartukeluarga');
    $namaKK_PengUp = $berkasKK_Pengup->getName();
    $berkasKK_Pengup->move('pelayanan/pengaduan_update', $namaKK_PengUp);

    $this->pengaduanupdateModel->save([
      'nik' => $this->request->getVar('nik'),
      'namapemohon' => $this->request->getVar('namapemohon'),
      'emailpemohon' => $this->request->getVar('emailpemohon'),
      'nomorpemohon' => $this->request->getVar('nomorpemohon'),
      'alamatpemohon' => $this->request->getVar('alamatpemohon'),
      'pengaduanupdate' => $this->request->getVar('pengaduanupdate'),
      'kartutandapenduduk' => $namaKTP_PengUp,
      'kartukeluarga' => $namaKK_PengUp

    ]);
    session()->setFlashdata('pesan', 'Selamat pendaftaran permohonan Pengaduan Update anda telah berhasil !!');
    return redirect()->to('/PelayananSilancar/pendaftaranPengaduanupdate/');
  }
















  // Halaman Error Page
  public function errorPage()
  {
    $data = [
      'title' => 'Pelayanan Online Si Lancar || Disdukcapil Majalengka',
    ];
    return view('pelayanan_views/errorPage', $data);
  }
}
