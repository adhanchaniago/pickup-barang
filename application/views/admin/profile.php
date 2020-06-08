<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm">
          <h1 class="m-0 text-dark">Profil - <?= $dataUser['username']; ?></h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row my-2">
        <div class="col-lg text-center">
          <a href="<?= base_url('assets/img/img_profiles/') . $dataUser['img_profile']; ?>" class="enlarge">
            <img class="img-fluid img-profile img-thumbnail rounded-circle" src="<?= base_url('assets/img/img_profiles/') . $dataUser['img_profile']; ?>" alt="<?= $dataUser['img_profile']; ?>">
          </a>
        </div>
      </div>
      <div class="row justify-content-center my-2">
        <div class="col-lg-6">
          <ul class="list-group list-group-flush">
            <li class="list-group-item">Nama Lengkap: <?= ucwords(strtolower($dataUser['nama_lengkap'])); ?></li>
            <li class="list-group-item">Username: <?= strtolower($dataUser['username']); ?></li>
            <li class="list-group-item">Jabatan: <?= strtolower($dataUser['nama_jabatan']); ?></li>
            <li class="list-group-item">
              <button type="button" data-toggle="modal" data-target="#editProfileModal" class="btn btn-success"><i class="fas fa-fw fa-edit"></i> Ubah Profile</button>
              <button type="button" data-toggle="modal" data-target="#changePasswordModal" class="btn btn-danger"><i class="fas fa-fw fa-lock"></i> Ganti Password</button>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>


<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editProfileModalLabel">Ubah Profil - <?= $dataUser['username']; ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="text-center">
              <a href="<?= base_url('assets/img/img_profiles/') . $dataUser['img_profile']; ?>" class="enlarge check_enlarge_photo">
                <img style="width: 50%" src="<?= base_url('assets/img/img_profiles/') . $dataUser['img_profile']; ?>" class="img-thumbnail rounded-circle img-fluid check_photo" alt="Photo">
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
            <input style="cursor: not-allowed;" class="form-control" disabled type="text" value="<?= $dataUser['username']; ?>">
          </div>
          <div class="form-group">
            <label for="nama_lengkap">Nama Lengkap</label>
            <input type="text" class="form-control" name="nama_lengkap" required value="<?= $dataUser['nama_lengkap']; ?>">
            <?= form_error('nama_lengkap', '<small class="form-text text-danger">', '</small>'); ?>
          </div>
          <div class="form-group">
            <label for="id_jabatan">Nama Jabatan</label>
            <?php if ($dataUser['id_jabatan'] == '1'): ?>
              <input type="hidden" name="id_jabatan" value="<?= $dataUser['id_jabatan']; ?>">
              <input style="cursor: not-allowed;" class="form-control" disabled type="text" value="<?= $dataUser['nama_jabatan']; ?>">
            <?php else: ?>
              <select name="id_jabatan" id="id_jabatan" class="form-control">
                <?php foreach ($jabatan as $dj): ?>
                  <?php if ($dj['id_jabatan'] !== '1'): ?>
                    <option value="<?= $dj['id_jabatan']; ?>"><?= $dj['nama_jabatan']; ?></option>
                  <?php endif ?>
                <?php endforeach ?>
              </select>
            <?php endif ?>
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

<!-- Change Password Modal -->
<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post" action="<?= base_url('admin/gantiPassword'); ?>">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="changePasswordModalLabel">Ganti Password - <?= $dataUser['username']; ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="password_old"><i class="fas fa-fw fa-lock"></i> Password Lama</label>
            <input required type="password" name="password_old" id="password_old" class="form-control">
            <?= form_error('password_old', '<small class="form-text text-danger">', '</small>'); ?>
          </div>
          <div class="form-group">
            <label for="password_new"><i class="fas fa-fw fa-lock"></i> Password Baru</label>
            <input required type="password" name="password_new" id="password_new" class="form-control">
            <?= form_error('password_new', '<small class="form-text text-danger">', '</small>'); ?>
          </div>
          <div class="form-group">
            <label for="password_verify"><i class="fas fa-fw fa-lock"></i> Password Verifikasi</label>
            <input required type="password" name="password_verify" id="password_verify" class="form-control">
            <?= form_error('password_verify', '<small class="form-text text-danger">', '</small>'); ?>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Tutup</button>
          <button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Ganti Password</button>
        </div>
      </div>
    </form>
  </div>
</div>