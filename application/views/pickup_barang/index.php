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
          <button type="button" data-toggle="modal" data-target="#addPickupBarangModal" class="btn btn-primary"><i class="fas fa-fw fa-plus"></i> Tambah Pickup Barang</button>
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
                  <th>No. WA Pengirim</th>
                  <th>Alamat Pengirim</th>
                  <th>Nama Barang</th>
                  <th>Berat Barang</th>
                  <th>Jumlah Barang</th>
                  <th>Nama Penerima</th>
                  <th>No. WA Penerima</th>
                  <th>Alamat Penerima</th>
                  <th>Tanggal Pemesanan</th>
                  <th>Tanggal Kurir Menjemput</th>
                  <th>Tanggal Masuk Logistik</th>
                  <th>Layanan Paket</th>
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

 <!-- Edit PickupBarang Modal -->
<div class="modal fade" id="editPickupBarangModal" tabindex="-1" role="dialog" aria-labelledby="editPickupBarangModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post" action="<?= base_url('pickupBarang/editPickupBarang'); ?>">
      <input type="hidden" name="id_pickup_barang" id="edit_id_pickup_barang">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editPickupBarangModalLabel"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="edit_status">Status</label>
            <select name="status" id="edit_status" class="form-control">
              <?php foreach ($status as $key => $value): ?>
                <option value="<?= $key; ?>"><?= $value; ?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary"><i class="fas fa-fw fa-save"></i> Simpan</button>
          </div>
          <div class="row">
            <div class="col-lg">
              <div class="form-group">
                <label for="edit_nama_pengirim"><i class="fas fa-fw fa-user"></i> Nama Pengirim</label>
                <input type="text" name="nama_pengirim" id="edit_nama_pengirim" class="form-control" required>
              </div>
            </div>
            <div class="col-lg">
              <div class="form-group">
                <label for="edit_no_whatsapp_pengirim"><i class="fab fa-fw fa-whatsapp"></i> No. Whatsapp Pengirim</label>
                <input type="number" name="no_whatsapp_pengirim" id="edit_no_whatsapp_pengirim" class="form-control" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="edit_alamat_pengirim"><i class="fas fa-fw fa-map-marked-alt"></i> Alamat Pengirim</label>
            <textarea name="alamat_pengirim" id="edit_alamat_pengirim" class="form-control" required></textarea>
          </div>
          <div class="form-group">
            <label for="edit_nama_barang"><i class="fas fa-fw fa-box"></i> Nama Barang</label>
            <input type="text" name="nama_barang" id="edit_nama_barang" class="form-control" required>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="edit_berat_barang"><i class="fas fa-fw fa-weight"></i> Berat Barang (Kg)</label>
                <input type="number" step="0.001" name="berat_barang" id="edit_berat_barang" class="form-control" required>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="edit_jumlah_barang"><i class="fas fa-fw fa-boxes"></i> Jumlah Barang</label>
                <input type="number" name="jumlah_barang" id="edit_jumlah_barang" class="form-control" required min="1">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg">
              <div class="form-group">
                <label for="edit_nama_penerima"><i class="fas fa-fw fa-user-tie"></i> Nama Penerima</label>
                <input type="text" name="nama_penerima" id="edit_nama_penerima" class="form-control" required>
              </div>
            </div>
            <div class="col-lg">
              <div class="form-group">
                <label for="edit_no_whatsapp_penerima"><i class="fab fa-fw fa-whatsapp"></i> No. Whatsapp Penerima</label>
                <input type="number" name="no_whatsapp_penerima" id="edit_no_whatsapp_penerima" class="form-control" placeholder="(Optional)">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="edit_alamat_penerima"><i class="fas fa-fw fa-map-marked-alt"></i> Alamat Penerima</label>
            <textarea name="alamat_penerima" id="edit_alamat_penerima" class="form-control" required></textarea>
          </div>
          <div class="form-group">
            <label for="edit_id_layanan_paket"><i class="fas fa-fw fa-shipping-fast"></i> Layanan Paket</label>
            <select name="id_layanan_paket" id="edit_id_layanan_paket" class="form-control">
              <?php foreach ($layanan_paket as $dlp): ?>
                <?php if ($dlp['harga_layanan_paket'] !== '0'): ?>
                  <option value="<?= $dlp['id_layanan_paket']; ?>"><?= $dlp['layanan_paket']; ?> | <?= number_format($dlp['harga_layanan_paket']); ?></option>
                <?php endif ?>
              <?php endforeach ?>
            </select>
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

<!-- Add Pickup Barang Modal -->
<div class="modal fade" id="addPickupBarangModal" tabindex="-1" role="dialog" aria-labelledby="addPickupBarangModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addPickupBarangModalLabel">Tambah Pickup Barang</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg">
              <div class="form-group">
                <label for="nama_pengirim"><i class="fas fa-fw fa-user"></i> Nama Pengirim</label>
                <input value="<?= set_value('nama_pengirim'); ?>" type="text" name="nama_pengirim" id="nama_pengirim" class="form-control" required>
              </div>
            </div>
            <div class="col-lg">
              <div class="form-group">
                <label for="no_whatsapp_pengirim"><i class="fab fa-fw fa-whatsapp"></i> No. Whatsapp Pengirim</label>
                <input value="<?= set_value('no_whatsapp_pengirim'); ?>" type="number" name="no_whatsapp_pengirim" id="no_whatsapp_pengirim" class="form-control" required>
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="alamat_pengirim"><i class="fas fa-fw fa-map-marked-alt"></i> Alamat Pengirim</label>
            <textarea name="alamat_pengirim" id="alamat_pengirim" class="form-control" required><?= set_value('alamat_pengirim'); ?></textarea>
          </div>
          <div class="form-group">
            <label for="nama_barang"><i class="fas fa-fw fa-box"></i> Nama Barang</label>
            <input value="<?= set_value('nama_barang'); ?>" type="text" name="nama_barang" id="nama_barang" class="form-control" required>
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="berat_barang"><i class="fas fa-fw fa-weight"></i> Berat Barang (Kg)</label>
                <input value="<?= set_value('berat_barang'); ?>" type="number" step="0.001" name="berat_barang" id="berat_barang" class="form-control" required>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label for="jumlah_barang"><i class="fas fa-fw fa-boxes"></i> Jumlah Barang</label>
                <input value="<?= set_value('jumlah_barang'); ?>" type="number" name="jumlah_barang" id="jumlah_barang" class="form-control" required min="1">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg">
              <div class="form-group">
                <label for="nama_penerima"><i class="fas fa-fw fa-user-tie"></i> Nama Penerima</label>
                <input value="<?= set_value('nama_penerima'); ?>" type="text" name="nama_penerima" id="nama_penerima" class="form-control" required>
              </div>
            </div>
            <div class="col-lg">
              <div class="form-group">
                <label for="no_whatsapp_penerima"><i class="fab fa-fw fa-whatsapp"></i> No. Whatsapp Penerima</label>
                <input value="<?= set_value('no_whatsapp_penerima'); ?>" type="number" name="no_whatsapp_penerima" id="no_whatsapp_penerima" class="form-control" placeholder="(Optional)">
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="alamat_penerima"><i class="fas fa-fw fa-map-marked-alt"></i> Alamat Penerima</label>
            <textarea name="alamat_penerima" id="alamat_penerima" class="form-control" required><?= set_value('alamat_penerima'); ?></textarea>
          </div>
          <div class="form-group">
            <label for="id_layanan_paket"><i class="fas fa-fw fa-shipping-fast"></i> Layanan Paket</label>
            <select name="id_layanan_paket" id="id_layanan_paket" class="form-control">
              <?php foreach ($layanan_paket as $dlp): ?>
                <?php if ($dlp['harga_layanan_paket'] !== '0'): ?>
                  <option value="<?= $dlp['id_layanan_paket']; ?>"><?= $dlp['layanan_paket']; ?> | <?= number_format($dlp['harga_layanan_paket']); ?></option>
                <?php endif ?>
              <?php endforeach ?>
            </select>
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