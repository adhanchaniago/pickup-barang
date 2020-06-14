<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm header-title">
          <h1 class="m-0 text-dark">Daftar Pengirim</h1>
        </div><!-- /.col -->
        <?php if ($dataUser['id_jabatan'] == '1'): ?>
          <div class="col-sm header-button">
            <button type="button" class="btn btn-primary btn-tambah-pengirim"><i class="fas fa-fw fa-plus"></i> Tambah Pengirim</button>
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
            <table class="table table-hover table-striped table-bordered" id="table_id" data-link="<?= base_url('pengirim/datatable') ?>">
              <thead>
                <tr>
                  <th width="10">No</th>
                  <th>Nama Pengirim</th>
                  <th>No. WA Pengirim</th>
                  <th>Alamat Pengirim</th>
                  <th>Kec/Kab/Prov. Pengirim</th>
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

<!-- pengirim Modal -->
<div class="modal fade" id="pengirimModal" tabindex="-1" role="dialog" aria-labelledby="label" aria-hidden="true">
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
            <input type="hidden" name="id_pengirim" id="id_pengirim">
          <div class="form-group">
            <label for="nama_pengirim">Nama Pengirim</label>
            <input type="text" name="nama_pengirim" id="nama_pengirim" class="form-control" required value="<?= set_value('nama_pengirim'); ?>" placeholder="Nama Pengirim">
            <?= form_error('nama_pengirim', '<small class="form-text text-danger">', '</small>'); ?>
          </div>
          <div class="form-group">
            <label for="no_wa_pengirim">No. WhatsApp Pengirim</label>
            <input type="text" name="no_wa_pengirim" id="no_wa_pengirim" class="form-control" required value="<?= set_value('no_wa_pengirim'); ?>" placeholder="No. WhatsApp Pengirim">
            <?= form_error('no_wa_pengirim', '<small class="form-text text-danger">', '</small>'); ?>
          </div>
          <div class="form-group">
            <label for="alamat_pengirim">Alamat Pengirim</label>
            <textarea name="alamat_pengirim" id="alamat_pengirim" class="form-control" required placeholder="Alamat Pengirim"><?= set_value('alamat_pengirim'); ?></textarea>
            <?= form_error('alamat_pengirim', '<small class="form-text text-danger">', '</small>'); ?>
          </div>

          <div class="form-group">
            <label for="id_provinsi">Provinsi</label>
            <select name="id_provinsi" id="id_provinsi" class="form-control js-basic-single select2">
              <option value="">-- Pilih --</option>
              <?php foreach ($provinsi as $key): ?>
                <?php if (set_value("id_provinsi") == $key["id_provinsi"]): ?>
                <option value="<?= $key["id_provinsi"]; ?>" selected><?= $key["nama_provinsi"]; ?></option>
                <?php else: ?>
                <option value="<?= $key["id_provinsi"]; ?>"><?= $key["nama_provinsi"]; ?></option>
                <?php endif ?>
              <?php endforeach ?>
            </select>
            <?= form_error('id_provinsi', '<small class="form-text text-danger">', '</small>'); ?>
          </div>
          <div class="form-group">
            <label for="id_kabupaten">Kabupaten</label>
            <select name="id_kabupaten" id="id_kabupaten" class="form-control js-basic-single select2" onload="kabupaten(<?= set_value('id_provinsi') ?>,'#id_kabupaten','<?= set_value('id_kabupaten') ?>')">
              <option value="">-- Pilih --</option>
            </select>
            <?= form_error('id_kabupaten', '<small class="form-text text-danger">', '</small>'); ?>
          </div>
          <div class="form-group">
            <label for="id_kecamatan">Kecamatan</label>
            <select name="id_kecamatan" id="id_kecamatan" class="form-control js-basic-single select2" onload="kecamatan(<?= set_value('id_kabupaten') ?>,'#id_kecamatan','<?= set_value('id_kecamatan') ?>')" required>
              <option value="">-- Pilih --</option>
            </select>
            <?= form_error('id_kecamatan', '<small class="form-text text-danger">', '</small>'); ?>
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
