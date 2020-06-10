<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm header-title">
          <h1 class="m-0 text-dark">Daftar Jabatan</h1>
        </div><!-- /.col -->
        <?php if ($dataUser['id_jabatan'] == '1'): ?>
          <div class="col-sm header-button">
            <button type="button" data-toggle="modal" data-target="#addJabatanModal" class="btn btn-primary"><i class="fas fa-fw fa-plus"></i> Tambah Jabatan</button>
          </div>
        <?php endif ?>
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
                  <th>Nama Jabatan</th>
                  <?php if ($dataUser['id_jabatan'] == '1'): ?>
                    <th>Aksi</th>
                  <?php endif ?>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                <?php foreach ($jabatan as $dj): ?>
                  <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $dj['nama_jabatan']; ?></td>
                    <?php if ($dataUser['id_jabatan'] == '1'): ?>
                      <td>
                        <?php if ($dj['id_jabatan'] !== '1'): ?>
                          <a class="m-1 btn btn-success" data-toggle="modal" data-target="#editJabatanModal<?= $dj['id_jabatan']; ?>" href=""><i class="fas fa-fw fa-edit"></i></a>
                          <!-- Edit Jabatan Modal -->
                          <div class="modal fade" id="editJabatanModal<?= $dj['id_jabatan']; ?>" tabindex="-1" role="dialog" aria-labelledby="editJabatanModalLabel<?= $dj['id_jabatan']; ?>" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <form method="post" action="<?= base_url('jabatan/editJabatan/' . $dj['id_jabatan']); ?>">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="editJabatanModalLabel<?= $dj['id_jabatan']; ?>">Ubah Jabatan - <?= $dj['nama_jabatan']; ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="form-group">
                                      <label for="nama_jabatan<?= $dj['id_jabatan']; ?>">Nama Jabatan</label>
                                      <input type="text" name="nama_jabatan" id="nama_jabatan<?= $dj['id_jabatan']; ?>" class="form-control" required value="<?= $dj['nama_jabatan']; ?>">
                                      <?= form_error('nama_jabatan', '<small class="form-text text-danger">', '</small>'); ?>
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

                          <a class="m-1 btn btn-danger btn-delete" data-text="<?= $dj['nama_jabatan']; ?>" href="<?= base_url('jabatan/deleteJabatan/') . $dj['id_jabatan']; ?>"><i class="fas fa-fw fa-trash"></i></a>
                        <?php endif ?>
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

<!-- Add Jabatan Modal -->
<div class="modal fade" id="addJabatanModal" tabindex="-1" role="dialog" aria-labelledby="addJabatanModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addJabatanModalLabel">Tambah Jabatan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="nama_jabatan">Nama Jabatan</label>
            <input type="text" name="nama_jabatan" id="nama_jabatan" required class="form-control" value="<?= set_value('nama_jabatan'); ?>">
            <?= form_error('nama_jabatan', '<small class="form-text text-danger">', '</small>'); ?>
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