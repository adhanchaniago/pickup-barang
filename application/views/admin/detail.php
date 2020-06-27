<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header my-0 pb-0 pt-1">
    <div class="container-fluid my-0 py-0">
      <div class="row my-0 py-0">
        <div class="col-sm my-auto py-1 header-title">
          <h3 class="text-dark my-0 py-0"><?= $headline; ?></h3>
        </div><!-- /.col -->
      </div><!-- /.row -->
      <div class="row my-2">
        <div class="col-lg-6">
          <?php if (validation_errors()): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Gagal!</strong> <?= validation_errors(); ?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <?php endif ?>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">

      <div class="table-responsive bg-white p-3 shadow">
        <table class="table table-striped table-bordered" id="table_id">
          <thead class="thead bg-primary text-white text-center">
            <tr>
              <th width="10">No</th>
              <th>Nama Penerima</th>
              <th>No Wa Penerima</th>
              <th>Alamat Penerima</th>
              <th>Jenis Layanan</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php $no=1;foreach ($pesanan as $key): ?>
              <tr>
                <td><div class="text-center" width="10px"><?= $no; ?></div></td>
                <td><?= $key["nama_penerima"]; ?></td>
                <td><?= $key["no_wa_penerima"]; ?></td>
                <td><?= $key["alamat_penerima"]; ?></td>
                <td><?= $key["jenis_layanan"]; ?></td>
                <td><?= $key["status"]; ?></td>
              </tr>
            <?php $no++;endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>