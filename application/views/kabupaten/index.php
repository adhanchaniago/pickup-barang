<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm header-title">
          <h1 class="m-0 text-dark">Daftar Kabupaten</h1>
        </div><!-- /.col -->
        <?php if ($dataUser['id_jabatan'] == '1'): ?>
          <div class="col-sm header-button">
            <button type="button" class="btn btn-primary btn-tambah-kabupaten"><i class="fas fa-fw fa-plus"></i> Tambah Kabupaten</button>
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
            <table class="table table-hover table-striped table-bordered" id="table_id" data-link="<?= base_url('kabupaten/datatable') ?>">
              <thead>
                <tr>
                  <th width="10">No</th>
                  <th>Nama Kabupaten</th>
                  <th>Nama Provinsi</th>
                  <th>Negara</th>
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

<!-- Kabupaten Modal -->
<div class="modal fade" id="kabupatenModal" tabindex="-1" role="dialog" aria-labelledby="label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="label"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id_kabupaten" id="id_kabupaten">
          <div class="form-group">
            <label for="nama_kabupaten">Nama Kabupaten</label>
            <input type="text" name="nama_kabupaten" id="nama_kabupaten" class="form-control" required placeholder="Nama Kabupaten" value="<?= set_value('nama_kabupaten'); ?>">
            <?= form_error('nama_kabupaten', '<small class="form-text text-danger">', '</small>'); ?>
          </div>
           <div class="form-group">
            <label for="id_provinsi">Provinsi</label>
            <select name="id_provinsi" id="id_provinsi" class="form-control" required>
              <option value="">-- Pilih --</option>
              <?php foreach ($provinsi as $key): ?>
                <?php if (set_value('id_provinsi') == $key["id_provinsi"]): ?>
                  <option value="<?= $key["id_provinsi"]; ?>" selected><?= $key["nama_provinsi"]; ?></option>
                <?php else: ?>
                  <option value="<?= $key["id_provinsi"]; ?>"><?= $key["nama_provinsi"]; ?></option>
                <?php endif ?>
              <?php endforeach ?>
            </select>
            <?= form_error('id_provinsi', '<small class="form-text text-danger">', '</small>'); ?>
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