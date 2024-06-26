<?= $this->extend('layout/templateadmin'); ?>

<?= $this->section('contentadmin'); ?>

<section class="p-4" id="main-content">

  <button class="btn btn-primary" id="button-toggle">
    <i class="bi bi-list"></i>
  </button>

  <div class="card shadow mb-4" style="margin-top: 25px;">

    <div class="card-header py-3" style="border: none; border: 0; outline: none; box-shadow: none;">
      <h4 class="m-0 font-weight-bold text-primary text-center">Detail Data Pendaftaran Perbaikan Data</h4>
    </div>

    <div class="container">
      <div class="row">
        <?php if (session()->getFlashdata('pesan')) : ?>

          <?php
          $pesan = session()->getFlashdata('pesan');

          if ($pesan == 'Pendaftaran Telah Selesai di Verifikasi !!') {
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
    </div>

    <div class="col-sm-12 col-md-12" style="padding: 20px;">
      <div class="card card-outline card-primary">

        <div class="card-header py-3">

          <div class="d-sm-inline align-items-center justify-content-between mb-2">
            <div class="card-title fw-semibold"> Data Pemohon </div>
          </div>

          <div class="d-grip gap-2 d-md-flex justify-content-md-end">

            <?php if ($perbaikan_data['status'] === 'Belum di Proses') : ?>
              <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalUbahStatus">
                Verifikasi Pendaftaran
              </button>
            <?php elseif ($perbaikan_data['status'] === 'Selesai Verifikasi' || $perbaikan_data['status'] === 'Gagal Verifikasi') : ?>
              <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalVerifikasiPendaftaran">
                Tandai Selesai
              </button>
            <?php endif; ?>

            <div class="modal fade" id="modalUbahStatus" tabindex="-1" aria-labelledby="modalUbahStatusLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                  <div class="modal-header">
                    <h5 class="modal-title" id="modalUbahStatusLabel"> Verifikasi Pendaftaran </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>

                  <div class="modal-body">

                    <p>Mohon untuk memverifikasi status Pendaftaran atas nama <b><?= $perbaikan_data['namapemohon']; ?></b> terlebih dahulu </p>

                    <div class="align-items-center justify-content-center">

                      <a href="<?= base_url('/DetailAdmin/selesaiPerbaikanData/' . $perbaikan_data['namapemohon']) ?>" class="btn btn-outline-success" data-popup="tooltip" data-placement="top" title="Selesai Verifikasi"><i class="bi bi-check-square" aria-hidden="true"></i> Selesai Verifikasi </a>

                      <a href="<?= base_url('/DetailAdmin/belumSelesaiPerbaikanData/' . $perbaikan_data['namapemohon']) ?>" class="btn btn-outline-danger" data-popup="tooltip" data-placement="top" title="Gagal Verifikasi"><i class="bi bi-x-square" aria-hidden="true"></i> Gagal Verifikasi </a>

                    </div>
                  </div>

                </div>

              </div>
            </div>
          </div>

          <div class="modal fade" id="modalVerifikasiPendaftaran" tabindex="-1" aria-labelledby="modalVerifikasiPendaftaranLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">

                <div class="modal-header">
                  <h5 class="modal-title" id="modalVerifikasiPendaftaranLabel">Verifikasi Pendaftaran</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                  <p>Pendaftaran atas nama <b><?= $perbaikan_data['namapemohon']; ?></b> Apakah sudah Selesai ?? </p>
                </div>

                <div class="modal-footer">

                  <div class="d-sm-flex align-items-center justify-content-end">

                    <button type="button" class="btn btn-secondary btn-sm mx-2" data-bs-dismiss="modal">Batal</button>

                    <form action="<?= base_url('DeleteAdmin/tandaiSelesaiPerbaikanData/' . $perbaikan_data['id']); ?>" method="post" class="d-inline">
                      <?= csrf_field(); ?>
                      <button class="btn btn-danger btn-sm">Tandai Selesai</button>
                    </form>

                  </div>

                </div>

              </div>
            </div>
          </div>

        </div>

        <div class="card-body">
          <table>

            <tr>
              <th width="150px">NIK</th>
              <th width="20px">:</th>
              <td><?= $perbaikan_data['nik']; ?></td>
            </tr>

            <tr>
              <th width="170px">Nama</th>
              <th width="20px">:</th>
              <td><?= $perbaikan_data['namapemohon']; ?></td>
            </tr>

            <tr>
              <th width="">Email</th>
              <th width="">:</th>
              <td><?= $perbaikan_data['emailpemohon']; ?></td>
            </tr>

            <tr>
              <th width="">Nomor Pemohon</th>
              <th width="">:</th>
              <td><?= $perbaikan_data['nomorpemohon']; ?></td>
            </tr>

            <tr>
              <th width="">Alamat Pemohon</th>
              <th width="">:</th>
              <td><?= $perbaikan_data['alamatpemohon']; ?></td>
            </tr>

            <tr>
              <th width="">Penjelasan Perbaikan</th>
              <th width="">:</th>
              <td><?= $perbaikan_data['penjelasanperbaikan']; ?></td>
            </tr>

            <tr>
              <th width="">Status</th>
              <th width="">:</th>
              <td>
                <?php
                switch ($perbaikan_data['status']) {
                  case 'Selesai Verifikasi':
                    echo '<span class="badge bg-success"> Selesai Verifikasi </span>';
                    break;
                  case 'Belum di Proses':
                    echo '<span class="badge bg-warning"> Belum di Proses </span>';
                    break;
                  case 'Gagal Verifikasi':
                    echo '<span class="badge bg-danger"> Gagal Verifikasi </span>';
                    break;
                }
                ?>
              </td>
            </tr>

          </table>

          <div class="grid-container align-items-center justify-content-center">

            <form action="<?= base_url('/DetailAdmin/selesaiPerbaikanData/' . $perbaikan_data['namapemohon']) ?>" method="post">
              <?= csrf_field(); ?>
              <button class="btn btn-success btn-sm" data-popup="tooltip" data-placement="top" title="Selesai Verifikasi" style="margin-right: 3px;">
                <i class="bi bi-check-square" aria-hidden="true"></i> Selesai Verifikasi
              </button>
            </form>

            <form action="<?= base_url('/DetailAdmin/belumSelesaiPerbaikanData/' . $perbaikan_data['namapemohon']) ?>" method="post">
              <?= csrf_field(); ?>
              <button class="btn btn-danger btn-sm" data-popup="tooltip" data-placement="top" title="Selesai Verifikasi" style="margin-left: 3px;">
                <i class="bi bi-x-square" aria-hidden="true"></i> Gagal Verifikasi
              </button>
            </form>

          </div>

        </div>

        <div class="col-sm-12 col-md-12" style="padding: 20px;">
          <div class="card card-outline card-primary">
            <div class="card-header">
              <div class="card-title fw-semibold"> Berkas Foto KTP </div>
              <?php if (file_exists(FCPATH . '/pelayanan/perbaikan_data/' . $perbaikan_data['fotoktp'])) : ?>

                <form action="" method="post">
                  <a href="<?= base_url('/pelayanan/perbaikan_data/' . $perbaikan_data['fotoktp']) ?>" download class="btn btn-success mx-2 mt-2 mb-2 mr-2 position-absolute top-0 end-0">
                    <i class="bi bi-download"></i>
                  </a>
                </form>

                <div class="col-sm-12">
                  <iframe class="mt-4" src="<?= base_url('/pelayanan/perbaikan_data/' . $perbaikan_data['fotoktp']) ?>" frameborder="0" height="500" width="100%"></iframe>
                </div>
              <?php else : ?>
                <div class="alert alert-danger mt-5 mb-0" role="alert">
                  File pas foto tidak ditemukan.
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <div class="col-sm-12 col-md-12" style="padding: 20px;">
          <div class="card card-outline card-primary">

            <div class="card-header">
              <div class="card-title fw-semibold"> Berkas Perbaikan 1 </div>
            </div>

            <div class="card-body">
              <?php if (!empty($perbaikan_data['berkasperbaikan_satu'])) : ?>
                <iframe src="<?= base_url('/pelayanan/perbaikan_data/' . $perbaikan_data['berkasperbaikan_satu']) ?>" frameborder="0" height="500" width="100%"></iframe>
              <?php else : ?>
                <div class="alert alert-danger mt-0 mb-0" role="alert">
                  Berkas Perbaikan 1 tidak diinputkan !!
                </div>
              <?php endif; ?>
            </div>

          </div>
        </div>

        <div class="col-sm-12 col-md-12" style="padding: 20px;">
          <div class="card card-outline card-primary">

            <div class="card-header">
              <div class="card-title fw-semibold"> Berkas Perbaikan 2 </div>
            </div>

            <div class="card-body">
              <?php if (!empty($perbaikan_data['berkasperbaikan_dua'])) : ?>
                <iframe src="<?= base_url('/pelayanan/perbaikan_data/' . $perbaikan_data['berkasperbaikan_dua']) ?>" frameborder="0" height="500" width="100%"></iframe>
              <?php else : ?>
                <div class="alert alert-danger mt-0 mb-0" role="alert">
                  Berkas Perbaikan 2 tidak diinputkan !!
                </div>
              <?php endif; ?>
            </div>

          </div>
        </div>

        <div class="col-sm-12 col-md-12" style="padding: 20px;">
          <div class="card card-outline card-primary">

            <div class="card-header">
              <div class="card-title fw-semibold"> Berkas Perbaikan 3 </div>
            </div>

            <div class="card-body">
              <?php if (!empty($perbaikan_data['berkasperbaikan_tiga'])) : ?>
                <iframe src="<?= base_url('/pelayanan/perbaikan_data/' . $perbaikan_data['berkasperbaikan_tiga']) ?>" frameborder="0" height="500" width="100%"></iframe>
              <?php else : ?>
                <div class="alert alert-danger mt-0 mb-0" role="alert">
                  Berkas Perbaikan 3 tidak diinputkan !!
                </div>
              <?php endif; ?>
            </div>

          </div>
        </div>

        <div class="col-sm-12 col-md-12" style="padding: 20px;">
          <div class="card card-outline card-primary">

            <div class="card-header">
              <div class="card-title fw-semibold"> Berkas Perbaikan 4 </div>
            </div>

            <div class="card-body">
              <?php if (!empty($perbaikan_data['berkasperbaikan_empat'])) : ?>
                <iframe src="<?= base_url('/pelayanan/perbaikan_data/' . $perbaikan_data['berkasperbaikan_empat']) ?>" frameborder="0" height="500" width="100%"></iframe>
              <?php else : ?>
                <div class="alert alert-danger mt-0 mb-0" role="alert">
                  Berkas Perbaikan 4 tidak diinputkan !!
                </div>
              <?php endif; ?>
            </div>

          </div>
        </div>

        <div class="col-sm-12 col-md-12" style="padding: 20px;">
          <div class="card card-outline card-primary">

            <div class="card-header">
              <div class="card-title fw-semibold"> Berkas Perbaikan 5 </div>
            </div>

            <div class="card-body">
              <?php if (!empty($perbaikan_data['berkasperbaikan_lima'])) : ?>
                <iframe src="<?= base_url('/pelayanan/perbaikan_data/' . $perbaikan_data['berkasperbaikan_lima']) ?>" frameborder="0" height="500" width="100%"></iframe>
              <?php else : ?>
                <div class="alert alert-danger mt-0 mb-0" role="alert">
                  Berkas Perbaikan 5 tidak diinputkan !!
                </div>
              <?php endif; ?>
            </div>

          </div>
        </div>

      </div>
    </div>
  </div>

</section>

<?= $this->endSection('contentadmin'); ?>