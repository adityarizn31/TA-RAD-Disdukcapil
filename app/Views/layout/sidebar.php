<div>
  <div class="sidebar p-3 bg-primary" id="sidebar" style="height: 100%;">
    <h4 class="mb-5 text-white text-center"> Dinas Kependudukan dan Pencatatan Sipil Kabupaten Majalengka </h4>

    <hr>

    <?php if (in_groups('superadmin')) : ?>

      <li>
        <a class="text-white" href="/admin">
          <i class="bi bi-house mr-2"></i>
          Dashboard
        </a>
      </li>

      <li>
        <a class="text-white" href="/admin/register">
          <i class="bi bi-universal-access-circle mr-2"></i>
          Register Admin
        </a>
      </li>

      <li>
        <a class="text-white" href="/admin/data_admin">
          <i class="bi bi-person-badge-fill mr-2"></i>
          Data Admin
        </a>
      </li>

      <li>
        <a class="text-white" href="/admin/visimisi_admin">
          <i class="bi bi-peace-fill mr-2"></i>
          Visi Misi
        </a>
      </li>

      <li>
        <a class="text-white" href="/Admin/persyaratansilancar_admin">
          <i class="bi bi-journal-medical mr-2"></i>
          Persyaratan Si Lancar
        </a>
      </li>

      <li>
        <a class="text-white" href="<?= base_url('logout'); ?>">
          <i class="bi bi-box-arrow-right mr-2"></i>
          Logout
        </a>
      </li>

    <?php endif; ?>



    <?php if (in_groups('adminsilancar')) : ?>

      <li>
        <a class="text-white" href="/admin">
          <i class="bi bi-house mr-2"></i>
          Dashboard
        </a>
      </li>

      <li>
        <a class="text-white" href="<?= base_url('logout'); ?>">
          <i class="bi bi-box-arrow-right mr-2"></i>
          Logout
        </a>
      </li>

    <?php endif; ?>

    <hr>

  </div>
</div>