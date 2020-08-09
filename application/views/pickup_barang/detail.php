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
    	<table cellpadding="3"> 
    		<tr>
    			<td>Nama Pengirim</td>
    			<td class="text-bold"> : <?= kapital($pengirim->nama_pengirim); ?></td>
    		</tr>
    		<tr>
    			<td>Alamat Pengirim</td>
    			<td class="text-bold"> : <?= $pengirim->alamat_pengirim; ?></td>
    		</tr>
    		<tr>
    			<td>No Whatsapp</td>
    			<td class="text-bold"> : <?= $pengirim->no_wa_pengirim; ?></td>
    		</tr>
    	</table>

      <div class="row my-2">
        <div class="col-md col-12">
          <div class="form-group">
            <label for="">Status</label>
            <select id="whereStatus" class="form-control">
              <option value="">-- Pilih --</option>
              <?php foreach ($status as $key): ?>
                <option value="<?= $key["id_status"]; ?>"><?= $key["status"]; ?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>
        <div class="col-md-8 col-12 pt-md-2 text-md-right text-center mb-md-0 mb-2">
          <a href="#" class="m-1 btn btn-success mt-md-4" data-toggle="modal" data-target="#importResiModal"><i class="fas fa-fw fa-file-import"></i>  Import Resi</a>
          <a href="<?= base_url('pickupBarang/kurir') ?>" class="m-1 btn btn-danger mt-md-4"><i class="fas fa-fw fa-box"></i>  Kurir Pickup Barang</a>
          <a href="<?= base_url('pickupBarang/form') ?>" class="m-1 btn btn-primary mt-md-4"><i class="fas fa-fw fa-plus"></i> Tambah</a>
        </div>
        <div class="col-12">
          <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered" id="table_id" data-link="<?= base_url('pickupBarang/datatable2?id_pengirim='.$id_pengirim.'&tanggal_pemesanan='.$tanggal_pemesanan) ?>">
              <thead>
                <tr>
                  <th>No</th>
                  <th>No. Resi</th>
                  <th>Nama Penerima</th>
                  <th>No Wa Penerima</th>
                  <th>Alamat Penerima</th>
                  <th>Nama Barang</th>
                  <th>Jumlah Barang</th>
                  <th>Berat Barang</th>
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
            <label for="no_resi">No. Resi</label>
            <input type="number" name="no_resi" id="no_resi" class="form-control" required value="<?= set_value('no_resi'); ?>" placeholder="Nomor Resi">
            <?= form_error('no_resi', '<small class="form-text text-danger">', '</small>'); ?>
          </div>
          <div class="form-group">
            <label for="berat_barang">Berat</label>
            <input type="number" name="berat_barang" id="berat_barang" class="form-control" required value="<?= set_value('berat_barang'); ?>" placeholder="Berat Barang">
            <?= form_error('berat_barang', '<small class="form-text text-danger">', '</small>'); ?>
          </div>
          <div class="form-group">
            <label for="harga_pengiriman">Harga</label>
            <input type="number" name="harga_pengiriman" id="harga_pengiriman" class="form-control" required value="<?= set_value('harga_pengiriman'); ?>" placeholder="Harga Pengiriman">
            <?= form_error('harga_pengiriman', '<small class="form-text text-danger">', '</small>'); ?>
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

<!-- Modal -->
<form action="<?= base_url('pickupBarang/importExcel') ?>" method="post" enctype="multipart/form-data">
  <div class="modal fade" id="importResiModal" tabindex="-1" role="dialog" aria-labelledby="importResiModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="importResiModalLabel">Import Resi</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="">Import FILE CSV/EXCEL</label>
            <input type="file" class="form-control" name="excel">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-fw fa-times"></i> Close</button>
          <button type="submit" name="submit" class="btn btn-primary"><i class="fas fa-fw fa-paper-plane"></i> Simpan</button>
        </div>
      </div>
    </div>
  </div>
</form>