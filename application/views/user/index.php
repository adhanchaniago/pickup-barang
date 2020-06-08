<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm header-title">
          <h1 class="m-0 text-dark">Daftar Pengguna</h1>
        </div><!-- /.col -->
        <?php if ($dataUser['id_jabatan'] == '1'): ?>
          <div class="col-sm header-button">
            <button type="button" data-toggle="modal" data-target="#addUserModal" class="btn btn-primary"><i class="fas fa-fw fa-plus"></i> Tambah Pengguna</button>
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
                  <th>Foto</th>
                  <th>Username</th>
                  <th>Nama Lengkap</th>
                  <th>Nama Jabatan</th>
                  <?php if ($dataUser['id_jabatan'] == '1'): ?>
                    <th>Aksi</th>
                  <?php endif ?>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1; ?>
                <?php foreach ($user as $du): ?>
                  <tr>
                    <td><?= $i++; ?></td>
                    <td>
                      <a href="<?= base_url('assets/img/img_profiles/') . $du['img_profile']; ?>" class="enlarge">
                        <img width="75" src="<?= base_url('assets/img/img_profiles/') . $du['img_profile']; ?>" alt="foto profile">
                      </a>
                    </td>
                    <td><?= $du['username']; ?></td>
                    <td><?= $du['nama_lengkap']; ?></td>
                    <td><?= $du['nama_jabatan']; ?></td>
                    <?php if ($dataUser['id_jabatan'] == '1'): ?>
                      <td>
                        <?php if ($du['id_jabatan'] !== '1'): ?>
                          <a class="badge badge-success" data-toggle="modal" data-target="#editUserModal<?= $du['id_user']; ?>" href=""><i class="fas fa-fw fa-edit"></i> Ubah</a>
                          <!-- Edit User Modal -->
                          <div class="modal fade" id="editUserModal<?= $du['id_user']; ?>" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel<?= $du['id_user']; ?>" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <form method="post" action="<?= base_url('user/editUser/') . $du['id_user']; ?>" enctype="multipart/form-data">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="editUserModalLabel<?= $du['id_user']; ?>">Ubah Pengguna - <?= $du['username']; ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="form-group">
                                      <div class="text-center">
                                        <a href="<?= base_url('assets/img/img_profiles/default.png'); ?>" class="enlarge check_enlarge_photo">
                                          <img style="width: 50%" src="<?= base_url('assets/img/img_profiles/default.png'); ?>" class="img-thumbnail rounded-circle img-fluid check_photo" alt="Photo">
                                        </a>
                                      </div>
                                      <div><small>Ketuk gambar untuk memperbesar</small></div>
                                      <div class="custom-file">
                                        <input type="file" class="custom-file-input photo" id="img_profile<?= $du['id_user']; ?>" name="img_profile">
                                        <label for="img_profile<?= $du['id_user']; ?>" class="custom-file-label">Pilih Foto</label>
                                      </div>
                                    </div>
                                    <div class="form-group">
                                      <label>Username</label>
                                      <input style="cursor: not-allowed;" class="form-control" disabled type="text" value="<?= $dataUser['username']; ?>">
                                    </div>
                                    <div class="form-group">
                                      <label for="nama_lengkap<?= $du['id_user']; ?>">Nama Lengkap</label>
                                      <input type="text" name="nama_lengkap" id="nama_lengkap<?= $du['id_user']; ?>" required class="form-control" value="<?= $du['nama_lengkap']; ?>">
                                      <?= form_error('nama_lengkap', '<small class="form-text text-danger">', '</small>'); ?>
                                    </div>
                                    <div class="form-group">
                                      <label for="id_jabatan<?= $du['id_user']; ?>">Nama jabatan</label>
                                      <select name="id_jabatan" id="id_jabatan<?= $du['id_user']; ?>" class="form-control">
                                        <?php foreach ($jabatan as $dj): ?>
                                          <?php if ($dj['id_jabatan'] !== '1'): ?>
                                            <option value="<?= $dj['id_jabatan']; ?>"><?= $dj['nama_jabatan']; ?></option>
                                          <?php endif ?>
                                        <?php endforeach ?>
                                      </select>
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

<!-- Add User Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="addUserModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addUserModalLabel">Tambah Pengguna</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="text-center">
              <a href="<?= base_url('assets/img/img_profiles/default.png'); ?>" class="enlarge check_enlarge_photo">
                <img style="width: 50%" src="<?= base_url('assets/img/img_profiles/default.png'); ?>" class="img-thumbnail rounded-circle img-fluid check_photo" alt="Photo">
              </a>
            </div>
            <div><small>Ketuk gambar untuk memperbesar</small></div>
            <div class="custom-file">
              <input type="file" class="custom-file-input photo" id="img_profile" name="img_profile">
              <label for="img_profile" class="custom-file-label">Pilih Foto</label>
            </div>
          </div>
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required class="form-control" value="<?= set_value('username'); ?>">
            <?= form_error('username', '<small class="form-text text-danger">', '</small>'); ?>
          </div>
          <div class="form-group">
            <label for="nama_lengkap">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" id="nama_lengkap" required class="form-control" value="<?= set_value('nama_lengkap'); ?>">
            <?= form_error('nama_lengkap', '<small class="form-text text-danger">', '</small>'); ?>
          </div>
          <div class="form-group">
            <label for="id_jabatan">Nama jabatan</label>
            <select name="id_jabatan" id="id_jabatan" class="form-control">
              <?php foreach ($jabatan as $dj): ?>
                <?php if ($dj['id_jabatan'] !== '1'): ?>
                  <option value="<?= $dj['id_jabatan']; ?>"><?= $dj['nama_jabatan']; ?></option>
                <?php endif ?>
              <?php endforeach ?>
            </select>
            <?= form_error('username', '<small class="form-text text-danger">', '</small>'); ?>
          </div>
          <div class="form-group">
            <label for="password_new">Password Baru</label>
            <input required type="password" name="password_new" id="password_new" class="form-control">
            <?= form_error('password_new', '<small class="form-text text-danger">', '</small>'); ?>
          </div>
          <div class="form-group">
            <label for="password_verify">Password Verifikasi</label>
            <input required type="password" name="password_verify" id="password_verify" class="form-control">
            <?= form_error('password_verify', '<small class="form-text text-danger">', '</small>'); ?>
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