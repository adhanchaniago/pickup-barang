<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header my-0 pb-0 pt-1">
    <div class="container-fluid my-0 py-0">
      <div class="row my-0 py-0">
        <div class="col-sm my-0 py-0">
          <h2 class="text-dark my-0 py-0">Dasbor</h2>
        </div><!-- /.col -->
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
      <div class="row dashboard mb-2">
        <div class="col-lg-6">
          <?php foreach ($pesanan as $dp): ?>
            <?php if ($dp['status'] == '1'): ?>
              <div class="card p-0 bg-danger">
            <?php elseif ($dp['status'] == '2'): ?>
              <div class="card p-0 bg-warning">
            <?php else: ?>
              <div class="card p-0 bg-success">
            <?php endif ?>
              <a href="" data-toggle="modal" data-target="#detailModal<?= $dp['id_pickup_barang']; ?>">
                <div class="card-body p-2 text-white">
                  <h5><?= ucwords(strtolower($dp['nama_barang'])); ?></h5>
                  <h6>Dari <?= ucwords(strtolower($dp['nama_pengirim'])); ?> ke <?= ucwords(strtolower($dp['nama_penerima'])); ?></h6>
                  <h6><?= $dp['jenis_layanan']; ?> | Rp. <?= number_format($dp['harga']); ?> | <?= $dp['durasi_pengiriman']; ?> Jam</h6>
                  <h6><?= $dp['tanggal_pemesanan']; ?></h6>
                </div>
              </a>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="detailModal<?= $dp['id_pickup_barang']; ?>" tabindex="-1" role="dialog" aria-labelledby="detailModalLabel<?= $dp['id_pickup_barang']; ?>" aria-hidden="true">
              <div class="modal-dialog modal-xl">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel<?= $dp['id_pickup_barang']; ?>">Detail - No. Resi<?= $dp['no_resi']; ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <ul class="list-group">
                      <?php if ($dp['status'] == '1'): ?>
                        <li class="list-group-item bg-danger">Status: Pending</li>
                      <?php elseif ($dp['status'] == '2'): ?>
                        <li class="list-group-item bg-warning">Status: Kurir Sedang Menjemput</li>
                      <?php else: ?>
                        <li class="list-group-item bg-success">Status: Barang Sudah Masuk Logistik</li>
                      <?php endif ?>
                      <div class="row my-1">
                        <div class="col-lg my-1">
                          <li class="list-group-item"><h6 class="py-0 my-0">Pengirim</h6></li>
                          <li class="list-group-item">Nama Pengirim: <?= ucwords(strtolower($dp['nama_pengirim'])); ?></li>
                          <li class="list-group-item">No WA Pengirim: <?= $dp['no_wa_pengirim']; ?></li>
                          <li class="list-group-item">Alamat Pengirim: <?= $dp['alamat_pengirim']; ?></li>
                        </div>
                        <div class="col-lg my-1">
                          <li class="list-group-item"><h6 class="py-0 my-0">Penerima</h6></li>
                          <li class="list-group-item">Nama Penerima: <?= ucwords(strtolower($dp['nama_penerima'])); ?></li>
                          <li class="list-group-item">No WA Penerima: <?= $dp['no_wa_penerima']; ?></li>
                          <li class="list-group-item">Alamat Penerima: <?= $dp['alamat_penerima']; ?></li>
                        </div>
                      </div>
                      <div class="row my-1">
                        <div class="col-lg my-1">
                          <li class="list-group-item"><h6 class="py-0 my-0">Barang</h6></li>
                          <li class="list-group-item">Nama Barang: <?= ucwords(strtolower($dp['nama_barang'])); ?></li>
                          <li class="list-group-item">Berat Barang: <?= $dp['berat_barang']; ?> Kg</li>
                          <li class="list-group-item">Jumlah Barang: <?= $dp['jumlah_barang']; ?></li>
                        </div>
                        <div class="col-lg my-1">
                          <li class="list-group-item"><h6 class="py-0 my-0">Layanan</h6></li>
                          <li class="list-group-item">Jenis Layanan: <?= $dp['jenis_layanan']; ?></li>
                          <li class="list-group-item">Harga Layanan: Rp. <?= number_format($dp['harga']); ?></li>
                          <li class="list-group-item">Durasi Pengiriman: <?= $dp['durasi_pengiriman']; ?> Jam</li>
                        </div>
                      </div>
                      <div class="row my-1">
                        <div class="col-lg my-1">
                          <li class="list-group-item"><h6 class="py-0 my-0">Tanggal</h6></li>
                          <li class="list-group-item">Tanggal Pemesanan: <?= $dp['tanggal_pemesanan']; ?></li>
                          <?php if ($dp['tanggal_penjemputan'] == ''): ?>
                            <li class="list-group-item">Tanggal Penjemputan: Belum Di Jemput Kurir</li>
                          <?php else: ?>
                            <li class="list-group-item">Tanggal Penjemputan: <?= $dp['tanggal_penjemputan']; ?></li>
                          <?php endif ?>
                          <?php if ($dp['tanggal_masuk_logistik'] == ''): ?>
                            <li class="list-group-item">Tanggal Masuk Logistik: Belum Masuk Logistik</li>
                          <?php else: ?>
                            <li class="list-group-item">Tanggal Masuk Logistik: <?= $dp['tanggal_masuk_logistik']; ?></li>
                          <?php endif ?>
                        </div>
                      </div>
                    </ul>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach ?>
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>
