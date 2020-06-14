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
          <button type="button" class="btn btn-primary btn-tambah-layananPaket"><i class="fas fa-fw fa-plus"></i> Tambah Layanan Paket</button>
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
                  <th>Jenis Layanan</th>
                  <th>Asal</th>
                  <th>Tujuan</th>
                  <th>Jenis Paket</th>
                  <th>Harga(Rp)</th>
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

<!-- Layanan Paket Modal -->
<div class="modal fade" id="layananPaketModal" tabindex="-1" role="dialog" aria-labelledby="label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="label">Tambah Layanan Paket</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="id_layanan_paket" id="id_layanan_paket">

          <div class="form-group">
            <label for="id_jenis_paket">Jenis Paket</label>
            <select name="id_jenis_paket" id="id_jenis_paket" class="form-control js-basic-single select2">
              <?php foreach ($jenis_paket as $key): ?>
                <?php if (set_value("id_jenis_paket") == $key["id_jenis_paket"]): ?>
                <option value="<?= $key["id_jenis_paket"]; ?>" selected><?= $key["jenis_paket"]; ?></option>
                <?php else: ?>
                <option value="<?= $key["id_jenis_paket"]; ?>"><?= $key["jenis_paket"]; ?></option>
                <?php endif ?>
              <?php endforeach ?>
            </select>
          </div>

          <div class="form-group">
            <label for="id_jenis_layanan">Jenis Layanan</label>
            <select name="id_jenis_layanan" id="id_jenis_layanan" class="form-control js-basic-single select2">
              <?php foreach ($jenis_layanan as $key): ?>
                <?php if (set_value("id_jenis_layanan") == $key["id_jenis_layanan"]): ?>
                <option value="<?= $key["id_jenis_layanan"]; ?>" selected><?= $key["jenis_layanan"]; ?></option>
                <?php else: ?>
                <option value="<?= $key["id_jenis_layanan"]; ?>"><?= $key["jenis_layanan"]; ?></option>
                <?php endif ?>
              <?php endforeach ?>
            </select>
          </div>

          <div class="form-group">
            <label for="id_provinsi_asal">Provinsi Asal</label>
            <select name="id_provinsi_asal" id="id_provinsi_asal" class="form-control js-basic-single select2">
              <?php foreach ($provinsi as $key): ?>
                <?php if (set_value("id_provinsi_asal") == $key["id_provinsi"]): ?>
                <option value="<?= $key["id_provinsi"]; ?>" selected><?= $key["nama_provinsi"]; ?></option>
                <?php else: ?>
                <option value="<?= $key["id_provinsi"]; ?>"><?= $key["nama_provinsi"]; ?></option>
                <?php endif ?>
              <?php endforeach ?>
            </select>
            <?= form_error('id_provinsi_asal', '<small class="form-text text-danger">', '</small>'); ?>
          </div>
          <div class="form-group">
            <label for="id_kabupaten_asal">Kabupaten Asal</label>
            <select name="id_kabupaten_asal" id="id_kabupaten_asal" class="form-control js-basic-single select2" onload="kabupaten(<?= set_value('id_provinsi_asal') ?>,'#id_kabupaten_asal','<?= set_value('id_kabupaten_asal') ?>')"></select>
            <?= form_error('id_kabupaten_asal', '<small class="form-text text-danger">', '</small>'); ?>
          </div>
          <div class="form-group">
            <label for="id_kecamatan_asal">Kecamatan Asal</label>
            <select name="id_kecamatan_asal" id="id_kecamatan_asal" class="form-control js-basic-single select2" onload="kecamatan(<?= set_value('id_kabupaten_asal') ?>,'#id_kecamatan_asal','<?= set_value('id_kecamatan_asal') ?>')" required></select>
            <?= form_error('id_kecamatan_asal', '<small class="form-text text-danger">', '</small>'); ?>
          </div>

          <div class="form-group">
            <label for="id_provinsi_tujuan">Provinsi Tujuan</label>
            <select name="id_provinsi_tujuan" id="id_provinsi_tujuan" class="form-control js-basic-single select2">
              <?php foreach ($provinsi as $key): ?>
                <?php if (set_value("id_provinsi_tujuan") == $key["id_provinsi"]): ?>
                <option value="<?= $key["id_provinsi"]; ?>" selected><?= $key["nama_provinsi"]; ?></option>
                <?php else: ?>
                <option value="<?= $key["id_provinsi"]; ?>"><?= $key["nama_provinsi"]; ?></option>
                <?php endif ?>
              <?php endforeach ?>
            </select>
            <?= form_error('id_provinsi_tujuan', '<small class="form-text text-danger">', '</small>'); ?>
          </div>
          <div class="form-group">
            <label for="id_kabupaten_tujuan">Kabupaten Tujuan</label>
            <select name="id_kabupaten_tujuan" id="id_kabupaten_tujuan" class="form-control js-basic-single select2" onload="kabupaten(<?= set_value('id_provinsi_tujuan') ?>,'#id_kabupaten_tujuan','<?= set_value('id_kabupaten_tujuan') ?>')"></select>
            <?= form_error('id_kabupaten_tujuan', '<small class="form-text text-danger">', '</small>'); ?>
          </div>
          <div class="form-group">
            <label for="id_kecamatan_tujuan">Kecamatan Tujuan</label>
            <select name="id_kecamatan_tujuan" id="id_kecamatan_tujuan" class="form-control js-basic-single select2"  onload="kecamatan(<?= set_value('id_kabupaten_tujuan') ?>,'#id_kecamatan_tujuan','<?= set_value('id_kecamatan_tujuan') ?>')" required></select>
            <?= form_error('id_kecamatan_tujuan', '<small class="form-text text-danger">', '</small>'); ?>
          </div>

          <div class="form-group">
            <label for="harga">Harga (Rp)</label>
            <input type="number" name="harga" id="harga" required class="form-control" value="<?= set_value('harga'); ?>" placeholder="Harga (Rp)">
            <?= form_error('harga', '<small class="form-text text-danger">', '</small>'); ?>
          </div>
          <div class="form-group">
            <label for="durasi_pengiriman">Durasi Pengiriman (Jam)</label>
            <input type="number" name="durasi_pengiriman" id="durasi_pengiriman" required class="form-control" value="<?= set_value('durasi_pengiriman'); ?>" placeholder="Durasi Pengiriman (Jam)">
            <?= form_error('durasi_pengiriman', '<small class="form-text text-danger">', '</small>'); ?>
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