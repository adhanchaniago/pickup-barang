<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header my-0 pb-0 pt-1">
    <div class="container-fluid my-0 py-0">
      <div class="row my-0 py-0">
        <div class="col-sm my-auto py-1 header-title">
          <?= $status; ?>
          <h3 class="text-dark my-0 py-0"><?= $headline; ?></h3>
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
            <?php foreach ($pesanan as $dp): ?>
                <div class="card p-0 <?= bg_status($dp['id_status']); ?>">
                <a href="<?= base_url('pickupBarang/detailPickup/' . $dp['no_wa_pengirim']) . '/' . $dp['id_status']; ?>">
                  <div class="card-body p-3 text-white">
                    <h6>Dari 
                      <strong><?= kapital($dp['nama_pengirim']); ?></strong> 
                      ke 
                      <strong><?= kapital($dp['nama_penerima']); ?></strong>
                    </h6>
                    <h6>
                      <?= $dp['jenis_layanan']; ?>
                    </h6>
                    <h6><?= $dp['tanggal_pemesanan']; ?></h6>
                  </div>
                </a>
              </div>
            <?php endforeach ?>
          <?php endif ?>
        </div>

        <div class="col-lg my-1 tidak_tampil" id="dataJmlStatus">
          <div class="card">
            <?php if ($status != ''): ?>
              <div class="card-header bg-secondary"><i class="fas fa-fw fa-calendar-alt"></i> Pesanan - <?= $dari_tanggal; ?> s/d <?= $sampai_tanggal; ?> - <?= $status; ?></div>
            <?php else: ?>
              <div class="card-header bg-secondary"><i class="fas fa-fw fa-calendar-alt"></i> Pesanan Hari Ini</div>
            <?php endif ?>
            <ul class="list-group list-group-flush">
              <?php if ($jml_status != NULL): ?>
                <li class="list-group-item">Jumlah Status Pending: <span class="badge badge-primary"><?= nominal($jml_status['pending']); ?></span></li>
                <li class="list-group-item">Jumlah Status Kurir Menjemput: <span class="badge badge-primary"><?= nominal($jml_status['kurir_menjemput']); ?></span></li>
                <li class="list-group-item">Jumlah Status Barang Masuk Logistik: <span class="badge badge-primary"><?= nominal($jml_status['barang_masuk_logistik']); ?></span></li>
              <?php else: ?>
                <li class="list-group-item">Jumlah Status Pending: <span class="badge badge-primary float-right">0</span></li>
                <li class="list-group-item">Jumlah Status Kurir Menjemput: <span class="badge badge-primary float-right">0</span></li>
                <li class="list-group-item">Jumlah Status Barang Masuk Logistik: <span class="badge badge-primary float-right">0</span></li>
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
    <form method="get">
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
                <div class="form-group">
                  <label for="dari_tanggal">Dari Tanggal</label>
                  <input type="text" class="form-control" id="dari_tanggal" name="dari_tanggal" required value="<?= $val_dari_tanggal; ?>">
                </div>
              </div>
              <div class="col-lg">
                <div class="form-group">
                  <label for="sampai_tanggal">Sampai Tanggal</label>
                  <input type="text" class="form-control" id="sampai_tanggal" name="sampai_tanggal" required value="<?= $val_sampai_tanggal; ?>">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg">
                <label for="status">Status</label>
                <select name="id_status" id="status" class="form-control">
                  <?php foreach ($allStatus as $key): ?>
                    <?php if ($key["id_status"] == $status["id_status"]): ?>
                      <option value="<?= $key["id_status"]; ?>" selected><?= $key["status"]; ?></option>
                    <?php else: ?>
                      <option value="<?= $key["id_status"]; ?>"><?= $key["status"]; ?></option>
                    <?php endif ?>
                  <?php endforeach ?>
                  <option value="4">Semua</option>
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