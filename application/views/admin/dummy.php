<div class="col-lg-6 my-1 dashboard" id="dataPesanan">
  <?php if ($pesanan == NULL): ?>
    <h4>Tidak ada pesanan hari ini, coba gunakan fitur filter untuk melihat data lampau</h4>
  <?php else: ?>
    <?php foreach ($pesanan as $dp): ?>
        <div class="card p-0 <?= bg_status($dp['id_status']); ?>">
        <a href="<?= base_url('pickupBarang/detailPickup/' . $dp['no_wa_pengirim']) . '/' . $dp['id_status']; ?>">
          <div class="card-body p-3 text-white">
            <h6>Dari 
              <strong><?= kapital($dp['nama_pengirim']); ?></strong> 
              ke 
              <strong><?= kapital($dp['nama_penerima']); ?></strong>
            </h6>
            <h6>
              <?= $dp['jenis_layanan']; ?>
            </h6>
            <h6><?= $dp['tanggal_pemesanan']; ?></h6>
          </div>
        </a>
      </div>
    <?php endforeach ?>
  <?php endif ?>
</div>

<!-- <div class="col-lg my-1 tidak_tampil" id="dataJmlStatus">
  <div class="card">
    <?php if ($status != ''): ?>
      <div class="card-header bg-secondary"><i class="fas fa-fw fa-calendar-alt"></i> Pesanan - <?= $dari_tanggal; ?> s/d <?= $sampai_tanggal; ?> - <?= $status['status']; ?></div>
    <?php else: ?>
      <div class="card-header bg-secondary"><i class="fas fa-fw fa-calendar-alt"></i> Pesanan Hari Ini</div>
    <?php endif ?>

    <ul class="list-group list-group-flush">
      <?php if ($jml_status != NULL): ?>
        <li class="list-group-item">Jumlah Status Pending: <span class="badge badge-primary"><?= nominal($jml_status['pending']); ?></span></li>
        <li class="list-group-item">Jumlah Status Kurir Menjemput: <span class="badge badge-primary"><?= nominal($jml_status['kurir_menjemput']); ?></span></li>
        <li class="list-group-item">Jumlah Status Barang Masuk Logistik: <span class="badge badge-primary"><?= nominal($jml_status['barang_masuk_logistik']); ?></span></li>
        <li class="list-group-item">Jumlah Status Resi Terinput: <span class="badge badge-primary"><?= nominal($jml_status['resi_terinput']); ?></span></li>
      <?php else: ?>
        <li class="list-group-item">Jumlah Status Pending: <span class="badge badge-primary float-right">0</span></li>
        <li class="list-group-item">Jumlah Status Kurir Menjemput: <span class="badge badge-primary float-right">0</span></li>
        <li class="list-group-item">Jumlah Status Barang Masuk Logistik: <span class="badge badge-primary float-right">0</span></li>
        <li class="list-group-item">Jumlah Status Resi Terinput: <span class="badge badge-primary float-right">0</span></li>
      <?php endif ?>
    </ul>
  </div>
</div> -->