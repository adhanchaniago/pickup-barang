<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm header-title">
          <h1 class="m-0 text-dark">Daftar Pickup Barang</h1>
        </div><!-- /.col -->
        <div class="col-sm header-button">
          <button type="button" class="btn btn-primary btn-tambah-pickupBarang"><i class="fas fa-fw fa-plus"></i> Tambah Pickup Barang</button>
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
            <table class="table table-hover table-striped table-bordered" id="table_id" data-link="<?= base_url('pickupBarang/datatable') ?>">
              <thead>
                <tr>
                  <th>No</th>
                  <th>No. Resi</th>
                  <th>Nama Pengirim</th>
                  <th>Nama Barang</th>
                  <th>Berat Barang (Kg)</th>
                  <th>Jumlah Barang</th>
                  <th>Nama Penerima</th>
                  <th>Tanggal Pemesanan</th>
                  <th>Tanggal Penjemputan</th>
                  <th>Tanggal Masuk Logistik</th>
                  <th>Jenis Layanan</th>
                  <th>Status</th>
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

<!-- Pickup Barang Modal -->
<div class="modal fade" id="pickupBarangModal" tabindex="-1" role="dialog" aria-labelledby="label" aria-hidden="true">
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
          <input type="hidden" name="id_pickup_barang" id="id_pickup_barang">
          <div class="form-group">
            <label for="id_pengirim">Nama Pengirim</label>
            <select name="id_pengirim" id="id_pengirim" class="form-control js-basic-single select2">
              <?php foreach ($pengirim as $key): ?>
                <?php if (set_value("id_pengirim") == $key["id_pengirim"]): ?>
                <option value="<?= $key["id_pengirim"]; ?>" selected><?= $key["nama_pengirim"]; ?></option>
                <?php else: ?>
                <option value="<?= $key["id_pengirim"]; ?>"><?= $key["nama_pengirim"]; ?></option>
                <?php endif ?>
              <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <label for="id_penerima">Nama Penerima</label>
            <select name="id_penerima" id="id_penerima" class="form-control js-basic-single select2">
              <?php foreach ($penerima as $key): ?>
                <?php if (set_value("id_penerima") == $key["id_penerima"]): ?>
                <option value="<?= $key["id_penerima"]; ?>" selected><?= $key["nama_penerima"]; ?></option>
                <?php else: ?>
                <option value="<?= $key["id_penerima"]; ?>"><?= $key["nama_penerima"]; ?></option>
                <?php endif ?>
              <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <label for="id_layanan_paket">Layanan Paket</label>
            <select name="id_layanan_paket" id="id_layanan_paket" class="form-control js-basic-single select2">
              <?php foreach ($layanan_paket as $key): ?>
                <?php if (set_value("id_layanan_paket") == $key["id_layanan_paket"]): ?>
                <option value="<?= $key["id_layanan_paket"]; ?>" selected><?= $key["jenis_layanan"]; ?> Dari <?= $key["kec_asal"]; ?> Sampai <?= $key["kec_tujuan"]; ?> | <?= $key['jenis_paket']; ?> | Rp. <?= number_format($key['harga']); ?> | <?= $key['durasi_pengiriman']; ?> Jam</option>
                <?php else: ?>
                <option value="<?= $key["id_layanan_paket"]; ?>"><?= $key["jenis_layanan"]; ?> Dari <?= $key["kec_asal"]; ?> Sampai <?= $key["kec_tujuan"]; ?> | <?= $key['jenis_paket']; ?> | Rp. <?= number_format($key['harga']); ?> | <?= $key['durasi_pengiriman']; ?> Jam</option>
                <?php endif ?>
              <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <label for="nama_barang">Nama Barang</label>
            <input type="text" name="nama_barang" id="nama_barang" class="form-control" required value="<?= set_value('nama_barang'); ?>" placeholder="Nama Barang">
            <?= form_error('nama_barang', '<small class="form-text text-danger">', '</small>'); ?>
          </div>
          <div class="form-group">
            <label for="berat_barang">Berat Barang</label>
            <input type="number" step="0.001" name="berat_barang" id="berat_barang" class="form-control" required value="<?= set_value('berat_barang'); ?>" placeholder="Berat Barang">
            <?= form_error('berat_barang', '<small class="form-text text-danger">', '</small>'); ?>
          </div>
          <div class="form-group">
            <label for="jumlah_barang">Jumlah Barang</label>
            <input type="number" name="jumlah_barang" id="jumlah_barang" class="form-control" required value="<?= set_value('jumlah_barang'); ?>" placeholder="Jumlah Barang">
            <?= form_error('jumlah_barang', '<small class="form-text text-danger">', '</small>'); ?>
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