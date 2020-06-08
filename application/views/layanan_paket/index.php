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
            <table class="table table-hover table-striped table-bordered" id="table_id">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Layanan Paket</th>
                  <th>Harga Layanan Paket (Rp)</th>
                  <th>Durasi Pengiriman (Jam)</th>
                  <?php if ($dataUser['id_jabatan'] == '1'): ?>
                    <th>Aksi</th>
                  <?php endif ?>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                <?php foreach ($layanan_paket as $dlp): ?>
                  <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $dlp['layanan_paket']; ?></td>
                    <td><?= number_format($dlp['harga_layanan_paket']); ?></td>
                    <td><?= $dlp['durasi_pengiriman']; ?></td>
                    <?php if ($dataUser['id_jabatan'] == '1'): ?>
                      <td>
                          <a class="badge badge-success" data-toggle="modal" data-target="#editLayananPaketModal<?= $dlp['id_layanan_paket']; ?>" href=""><i class="fas fa-fw fa-edit"></i> Ubah</a>
                          <!-- Edit LayananPaket Modal -->
                          <div class="modal fade" id="editLayananPaketModal<?= $dlp['id_layanan_paket']; ?>" tabindex="-1" role="dialog" aria-labelledby="editLayananPaketModalLabel<?= $dlp['id_layanan_paket']; ?>" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <form method="post" action="<?= base_url('layananPaket/editLayananPaket/' . $dlp['id_layanan_paket']); ?>">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="editLayananPaketModalLabel<?= $dlp['id_layanan_paket']; ?>">Ubah Layanan Paket - <?= $dlp['layanan_paket']; ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="form-group">
                                      <label for="layanan_paket<?= $dlp['id_layanan_paket']; ?>">Layanan Paket</label>
                                      <input type="text" name="layanan_paket" id="layanan_paket<?= $dlp['id_layanan_paket']; ?>" class="form-control" required value="<?= $dlp['layanan_paket']; ?>">
                                      <?= form_error('layanan_paket', '<small class="form-text text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                      <label for="harga_layanan_paket<?= $dlp['id_layanan_paket'] ?>">Harga Layanan Paket (Rp)</label>
                                      <input type="number" name="harga_layanan_paket" id="harga_layanan_paket<?= $dlp['id_layanan_paket'] ?>" required class="form-control" value="<?= $dlp['harga_layanan_paket']; ?>">
                                      <?= form_error('harga_layanan_paket', '<small class="form-text text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                      <label for="durasi_pengiriman<?= $dlp['id_layanan_paket'] ?>">Durasi Pengiriman (Jam)</label>
                                      <input type="number" name="durasi_pengiriman" id="durasi_pengiriman<?= $dlp['id_layanan_paket'] ?>" required class="form-control" value="<?= $dlp['durasi_pengiriman']; ?>">
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

                          <a class="badge badge-danger btn-delete" data-text="<?= $dlp['layanan_paket']; ?>" href="<?= base_url('layananPaket/deleteLayananPaket/') . $dlp['id_layanan_paket']; ?>"><i class="fas fa-fw fa-trash"></i> hapus</a>
                      </td>
                    <?php endif ?>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
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