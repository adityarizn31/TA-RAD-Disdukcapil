<!-- Halaman Tampilan List Berita Admin  -->

<?= $this->extend('layout/templateadmin'); ?>

<?= $this->section('contentadmin'); ?>

<section class="p-4" id="main-content">

  <button class="btn btn-primary" id="button-toggle">
    <i class="bi bi-list"></i>
  </button>

  <div class="card shadow mb-4 border-2" style="margin-top: 25px;">

    <div class="card-header py-3">

      <div class="d-sm-flex align-items-center justify-content-between" style="padding-top: 10px;">
        <h6 class="m-0 font-weight-bold text-primary">Berita Disdukcapil Majalengka</h6>

        <!-- Method create_berita_admin digunakan untuk Menampilkan Form Insert Data -->
        <a href="/CreateAdmin/create_berita_admin/" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Tambah Berita</a>
      </div>

    </div>

    <div class="container mt-4">
      <div class="row">
        <div class="col">

          <?php if (session()->getFlashdata('pesan')) : ?>

            <div class="alert alert-success" role="alert">
              <?= session()->getFlashdata('pesan'); ?>
            </div>

          <?php endif; ?>

        </div>
      </div>
    </div>

    <div class="card-body">
      <table class="table table-fixed table-hover">

        <thead class="table-dark">
          <tr>
            <th scope="col">No</th>
            <th scope="col">Foto Berita</th>
            <th scope="col">Judul</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>

        <tbody>
          <?php $i = 1; ?>
          <?php foreach ($berita as $b) : ?>
            <tr>
              <th scope="row"><?= $i++; ?></th>
              <td><img src="/img/berita/<?= $b['fotoberita']; ?>" class="foto_berita" alt="Foto Berita" style="width: 50%; height: auto;"></td>
              <td><?= $b['judulberita']; ?></td>
              <td><?= $b['keteranganberita']; ?></td>
              <!-- <td>Jumlah Data <?= count($berita) ?></td> -->
              <td>
                <a href="/DetailAdmin/detail_berita_admin/<?= $b['judulberita']; ?>" class="btn btn-success">Detail</a>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>

      </table>

    </div>
  </div>

</section>

<?= $this->endSection('contentadmin'); ?>