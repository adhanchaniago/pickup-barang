<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header my-0 pb-0 pt-1">
    <div class="container-fluid my-0 py-0">
      <div class="row my-0 py-0">
        <div class="col-sm my-auto py-1 header-title">
          <?php 
            if (isset($_POST['status'])) {
              if ($_POST['status'] == '1') {
                $status = 'Pending';
              } elseif ($_POST['status'] == '2') {
                $status = 'Kurir Menjemput';
              } elseif ($_POST['status'] == '3') {
                $status = 'Barang Masuk Logistik';
              } else {
                $status = 'Semua';
              }
            } 
            ?>
          <?php if (isset($_POST['dari_tanggal'])): ?>
            <h4 class="text-dark my-auto">Dasbor - <?= $_POST['dari_tanggal']; ?> s/d <?= $_POST['sampai_tanggal']; ?> - <?= $status; ?></h4>
          <?php else: ?>
            <h3 class="text-dark my-0 py-0">Dasbor - Hari Ini</h3>
          <?php endif ?>
        </div><!-- /.col -->
        <div class="col-sm-2 my-auto py-1 header-button">
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#filterModal">
            <i class="fas fa-fw fa-filter"></i> Filter
          </button>
        </div>
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
      <div class="row mb-2">
        <div class="col-lg-6 my-1 dashboard" id="dataPesanan">
          <?php if ($pesanan == NULL): ?>
            <h4>Tidak ada pesanan hari ini, coba gunakan fitur filter untuk melihat data lampau</h4>
          <?php else: ?>
              <div id="pesanan"></div>
          <?php endif ?>
        </div>
        <div class="col-lg my-1 tidak_tampil">
          <div class="card">
            <?php if (isset($_POST['dari_tanggal'])): ?>
              <div class="card-header bg-secondary"><i class="fas fa-fw fa-calendar-alt"></i> Pesanan - <?= $_POST['dari_tanggal']; ?> s/d <?= $_POST['sampai_tanggal']; ?> - <?= $status; ?></div>
            <?php else: ?>
              <div class="card-header bg-secondary"><i class="fas fa-fw fa-calendar-alt"></i> Pesanan Hari Ini</div>
            <?php endif ?>
            <ul class="list-group list-group-flush">
              <?php if ($jml_status !== NULL): ?>
                <li class="list-group-item">Jumlah Status Pending: <span class="badge badge-primary"><?= $jml_status['pending']; ?></span></li>
                <li class="list-group-item">Jumlah Status Kurir Menjemput: <span class="badge badge-primary"><?= $jml_status['kurir_menjemput']; ?></span></li>
                <li class="list-group-item">Jumlah Status Barang Masuk Logistik: <span class="badge badge-primary"><?= $jml_status['barang_masuk_logistik']; ?></span></li>
              <?php else: ?>
                <li class="list-group-item">Jumlah Status Pending: <span class="badge badge-primary">0</span></li>
                <li class="list-group-item">Jumlah Status Kurir Menjemput: <span class="badge badge-primary">0</span></li>
                <li class="list-group-item">Jumlah Status Barang Masuk Logistik: <span class="badge badge-primary">0</span></li>
              <?php endif ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>


<!-- Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="filterModalLabel">Filter Dasbor</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
              <div class="col-lg">
                <?php if (isset($_POST['dari_tanggal'])): ?>
                  <div class="form-group">
                    <label for="dari_tanggal">Dari Tanggal</label>
                    <input type="text" class="form-control" id="dari_tanggal" name="dari_tanggal" required value="<?= $_POST['dari_tanggal']; ?>">
                  </div>
                <?php else: ?>
                  <div class="form-group">
                    <label for="dari_tanggal">Dari Tanggal</label>
                    <input type="text" class="form-control" id="dari_tanggal" name="dari_tanggal" required value="<?= date('Y/m/d'); ?>">
                  </div>
                <?php endif ?>
              </div>
              <div class="col-lg">
                <?php if (isset($_POST['sampai_tanggal'])): ?>
                  <div class="form-group">
                    <label for="sampai_tanggal">Sampai Tanggal</label>
                    <input type="text" class="form-control" id="sampai_tanggal" name="sampai_tanggal" required value="<?= $_POST['sampai_tanggal']; ?>">
                  </div>
                <?php else: ?>
                  <div class="form-group">
                    <label for="sampai_tanggal">Sampai Tanggal</label>
                    <input type="text" class="form-control" id="sampai_tanggal" name="sampai_tanggal" required value="<?= date('Y/m/d'); ?>">
                  </div>
                <?php endif ?>
              </div>
            </div>
            <div class="row">
              <div class="col-lg">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                  <?php if (isset($_POST['status'])): ?>
                    <option value="<?= $_POST['status']; ?>"><?= $status; ?></option>
                    <option disabled>-----</option>
                    <option value="1">Pending</option>
                    <option value="2">Kurir Menjemput</option>
                    <option value="3">Barang Masuk Logistik</option>
                    <option value="4">Semua</option>
                  <?php else: ?>
                    <option value="1">Pending</option>
                    <option value="2">Kurir Menjemput</option>
                    <option value="3">Barang Masuk Logistik</option>
                    <option value="4">Semua</option>
                  <?php endif ?>
                </select>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <a href="<?= base_url('admin'); ?>" class="btn btn-success"><i class="fas fa-fw fa-sync"></i> Reset</a>
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Tutup</button>
          <button type="submit" class="btn btn-primary"> <i class="fas fa-fw fa-filter"></i> Filter</button>
        </div>
      </div>
    </form>
  </div>
</div>