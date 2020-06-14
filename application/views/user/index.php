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
            <button type="button" class="btn btn-primary btn-tambah-user"><i class="fas fa-fw fa-plus"></i> Tambah Pengguna</button>
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
            <table class="table table-hover table-striped table-bordered" id="table_id" data-link="<?= base_url('user/datatable') ?>">
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
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- User Modal -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="label">Tambah Pengguna</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id_user" id="id_user">
          <div class="form-group">
            <div class="text-center">
              <a href="<?= base_url('assets/img/img_profiles/default.png'); ?>" class="enlarge check_enlarge_photo" id="photo">
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
            <input type="text" name="username" id="username" required class="form-control" value="<?= set_value('username'); ?>" placeholder="Username">
            <?= form_error('username', '<small class="form-text text-danger">', '</small>'); ?>
          </div>
          <div class="form-group">
            <label for="nama_lengkap">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" id="nama_lengkap" required class="form-control" value="<?= set_value('nama_lengkap'); ?>"  placeholder="Nama Lengkap">
            <?= form_error('nama_lengkap', '<small class="form-text text-danger">', '</small>'); ?>
          </div>
          <div class="form-group">
            <label for="id_jabatan">Nama jabatan</label>
            <select name="id_jabatan" id="id_jabatan" class="form-control js-basic-single select2">
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
            <input type="password" name="password_new" id="password_new" class="form-control"  placeholder="Password Baru">
            <?= form_error('password_new', '<small class="form-text text-danger">', '</small>'); ?>
          </div>
          <div class="form-group">
            <label for="password_verify">Password Verifikasi</label>
            <input type="password" name="password_verify" id="password_verify" class="form-control"   placeholder="Password Verifikasi">
            <?= form_error('password_verify', '<small class="form-text text-danger">', '</small>'); ?>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Tutup</button>
          <button type="reset" class="d-none" id="reset"></button>
          <button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>