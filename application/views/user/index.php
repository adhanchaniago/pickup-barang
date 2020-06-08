<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm header-title">
          <h1 class="m-0 text-dark">Daftar Pengguna</h1>
        </div><!-- /.col -->
        <div class="col-sm header-button">
          <button type="button" data-toggle="modal" data-target="#addUserModal" class="btn btn-primary"><i class="fas fa-fw fa-plus"></i> Tambah Pengguna</button>
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
                  <th>Username</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                <?php foreach ($user as $du): ?>
                  <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $du['username']; ?></td>
                    <td>
                      <?php if ($du['id_user'] !== '1'): ?>
                        <a class="badge badge-success" data-toggle="modal" data-target="#editUserModal<?= $du['id_user']; ?>" href=""><i class="fas fa-fw fa-edit"></i> Ubah</a>
                        <!-- Edit User Modal -->
                        <div class="modal fade" id="editUserModal<?= $du['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel<?= $du['id_user']; ?>" aria-hidden="true">
                          <div class="modal-dialog" role="document">
                            <form method="post" action="<?= base_url('user/editUser/' . $du['id_user']); ?>">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="editUserModalLabel<?= $du['id_user']; ?>">Ubah Pengguna - <?= $du['username']; ?></h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>
                                <div class="modal-body">
                                  <div class="form-group">
                                    <label for="username<?= $du['id_user']; ?>">Username</label>
                                    <input type="text" name="username" id="username<?= $du['id_user']; ?>" class="form-control" required value="<?= $du['username']; ?>">
                                    <?= form_error('username', '<small class="form-text text-danger">', '</small>'); ?>
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

                        <a class="badge badge-danger btn-delete" data-text="<?= $du['username']; ?>" href="<?= base_url('user/deleteUser/') . $du['id_user']; ?>"><i class="fas fa-fw fa-trash"></i> hapus</a>
                      <?php endif ?>
                    </td>
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

<!-- Add User Modal -->
<!-- <div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addUserModalLabel">Tambah Pengguna</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required class="form-control" value="<?= set_value('username'); ?>">
            <?= form_error('username', '<small class="form-text text-danger">', '</small>'); ?>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Tutup</button>
          <button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div> -->