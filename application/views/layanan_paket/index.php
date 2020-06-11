<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm header-title">
          <h1 class="m-0 text-dark">Daftar Layanan Paket</h1>
        </div><!-- /.col -->
        <div class="col-sm header-button">
          <button type="button" data-toggle="modal" data-target="#addLayananPaketModal" class="btn btn-primary"><i class="fas fa-fw fa-plus"></i> Tambah Layanan Paket</button>
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
      <div class="row my-2">
        <div class="col-lg">
          <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered" id="table_id" data-link="<?= base_url('layananPaket/datatable') ?>">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Layanan Paket</th>
                  <th>Harga Layanan Paket (Rp)</th>
                  <th>Durasi Pengiriman (Jam)</th>
                  <?php if ($dataUser['id_jabatan'] == '1' || $dataUser['id_jabatan'] == '2'): ?>
                    <th>Aksi</th>
                  <?php endif ?>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>

<!-- Edit LayananPaket Modal -->
<div class="modal fade" id="editLayananPaketModal" tabindex="-1" role="dialog" aria-labelledby="editLayananPaketModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post" action="<?= base_url('layananPaket/editLayananPaket'); ?>">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editLayananPaketModalLabel"> </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="layanan_paket">Layanan Paket</label>
            <input type="text" name="layanan_paket" id="edit_layanan_paket" class="form-control" required>
            <?= form_error('layanan_paket', '<small class="form-text text-danger">', '</small>'); ?>
          </div>
          <div class="form-group">
            <label for="edit_harga_layanan_paket">Harga Layanan Paket (Rp)</label>
            <input type="number" name="harga_layanan_paket" id="edit_harga_layanan_paket" required class="form-control">
            <?= form_error('harga_layanan_paket', '<small class="form-text text-danger">', '</small>'); ?>
          </div>
          <div class="form-group">
            <label for="edit_durasi_pengiriman">Durasi Pengiriman (Jam)</label>
            <input type="number" name="durasi_pengiriman" id="edit_durasi_pengiriman" required class="form-control">
            <?= form_error('durasi_pengiriman', '<small class="form-text text-danger">', '</small>'); ?>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Tutup</button>
          <button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Add Layanan Paket Modal -->
<div class="modal fade" id="addLayananPaketModal" tabindex="-1" role="dialog" aria-labelledby="addLayananPaketModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addLayananPaketModalLabel">Tambah Layanan Paket</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="layanan_paket">Layanan Paket</label>
            <input type="text" name="layanan_paket" id="layanan_paket" required class="form-control" value="<?= set_value('layanan_paket'); ?>">
            <?= form_error('layanan_paket', '<small class="form-text text-danger">', '</small>'); ?>
          </div>
          <div class="form-group">
            <label for="harga_layanan_paket">Harga Layanan Paket (Rp)</label>
            <input type="number" name="harga_layanan_paket" id="harga_layanan_paket" required class="form-control" value="<?= set_value('harga_layanan_paket'); ?>">
            <?= form_error('harga_layanan_paket', '<small class="form-text text-danger">', '</small>'); ?>
          </div>
          <div class="form-group">
            <label for="durasi_pengiriman">Durasi Pengiriman (Jam)</label>
            <input type="number" name="durasi_pengiriman" id="durasi_pengiriman" required class="form-control" value="<?= set_value('durasi_pengiriman'); ?>">
            <?= form_error('durasi_pengiriman', '<small class="form-text text-danger">', '</small>'); ?>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Tutup</button>
          <button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>