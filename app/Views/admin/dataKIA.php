<?= $this->extend('layout/templateadmin'); ?>

<?= $this->section('contentadmin'); ?>

<section class="p-4" id="main-content">

  <button class="btn btn-primary" id="button-toggle">
    <i class="bi bi-list"></i>
  </button>

  <div class="card shadow mb-4" style="margin-top: 25px;">

    <div class="card-header py-3">

      <div class="d-sm-flex align-items-center justify-content-between mb-2">
        <h4 class="m-0 font-weight-bold text-primary">Data Pendaftaran Selesai Permohonan Kartu Identitas Anak</h4>
        <a href="<?= base_url('ExportExcel/exportKIA'); ?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm mt-2"><i class="bi bi-download text-white"></i> Export Excel </a>
      </div>

      <div class="d-sm-flex align-items justify-content-end mb-2">
        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalHapusSeluruh"> Hapus Seluruh Data </button>
      </div>

      <div class="modal fade" id="modalHapusSeluruh" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title fw-semibold" id="modalHapusLabel">Hapus Keseluruhan Data Kartu Identitas Anak</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              Apakah anda yakin ingin menghapus keseluruhan data <b>Kartu Identitas Anak</b> yang telah selesai diproses ?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
              <form action="<?= base_url('DeleteAdmin/DeletePermanentKIA/'); ?>" method="post">
                <?= csrf_field(); ?>
                <button type="submit" class="btn btn-danger">Hapus</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <?php if (session()->getFlashdata('pesan')) : ?>

        <?php
        $pesan = session()->getFlashdata('pesan');

        // Jika status = Selesai
        if ($pesan == 'Pendaftaran Permohonan Kartu Identitas Anak telah dihapus !!') {
          $class = 'alert-success';
        } else {
          $class = 'alert-danger';
        }
        ?>

        <div class="alert <?= $class ?>" role="alert">
          <?= $pesan; ?>
        </div>

      <?php endif; ?>

    </div>

    <div class="card-body">

      <?php
      // Custom sorting function based on the 'created_at' field
      usort($pendaftaran_kia, function ($a, $b) {
        return strtotime($b['deleted_at']) - strtotime($a['deleted_at']);
      });
      ?>

      <table class="table table-fixed table-hover">

        <thead class="table-dark">
          <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Pemohon</th>
            <th scope="col">Email Pemohon</th>
            <th scope="col">No Whatsapp</th>
            <th scope="col">Permohonan</th>
            <th scope="col">Waktu</th>
            <th scope="col">Status</th>
            <th scope="col">Aksi</th>
          </tr>
        </thead>

        <tbody>
          <?php $i = 1 + (10 * ($currentPage - 1)); ?>
          <?php foreach ($pendaftaran_kia as $kia) : ?>
            <tr>
              <th scope="row"><?= $i++; ?></th>
              <td><?= $kia['namapemohon']; ?></td>
              <td><?= $kia['emailpemohon']; ?></td>
              <td><?= $kia['nomorpemohon']; ?></td>
              <td>Pendaftaran KIA</td>
              <td><?= $kia['created_at']; ?></td>
              <td>
                <?php
                switch ($kia['status']) {
                  case 'Selesai':
                    echo '<span class="badge rounded-pill bg-success">Terverifikasi</span>';
                    break;
                  case 'Belum di Proses':
                    echo '<span class="badge rounded-pill bg-warning">Belum di Proses</span>';
                    break;
                  case 'Belum Selesai':
                    echo '<span class="badge rounded-pill bg-danger">Ditolak</span>';
                    break;
                }
                ?>
              </td>
              <td>
                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $kia['id']; ?>">
                  Hapus
                </button>

                <div class="modal fade" id="modalHapus<?= $kia['id']; ?>" tabindex="-1" aria-labelledby="modalHapusLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="modalHapusLabel">Hapus Data KIA</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        Apakah Anda yakin ingin menghapus data KIA dengan nama pemohon <strong><?= $kia['namapemohon']; ?></strong>?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <form action="<?= base_url('DeleteAdmin/deletePermanentKIA/' . $kia['id']); ?>" method="post">
                          <?= csrf_field(); ?>
                          <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </td>

            </tr>
          <?php endforeach; ?>
        </tbody>

      </table>

    </div>
  </div>

</section>

<?= $this->endSection('contentadmin'); ?>