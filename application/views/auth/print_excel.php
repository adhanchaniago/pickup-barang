<table class="table table-bordered">
    <thead class="text-center">
        <tr>
            <th class="table_head">No</th>
            <th class="table_head">No Resi</th>
            <th class="table_head">Layanan</th>
            <th class="table_head">Berat</th>
            <th class="table_head">Jumlah</th>
            <th style="min-width: 16rem!important">Destinasi</th>
            <th class="table_head">Nama Pengirim</th>
            <th class="table_head">No. WA Pengirim</th>
            <th class="table_head">Nama Penerima</th>
            <th class="table_head">No. WA Penerima</th>
            <th class="table_head">Harga Pengiriman</th>
            <th class="table_head">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1;foreach ($pesanan as $key): ?>
            <tr>
                <td class="table_data"><?= $no; ?></td>
                <td class="table_data"><?= $key["no_resi"]; ?></td>
                <td class="table_data"><?= $key["jenis_layanan"]; ?></td>
                <td class="table_data"><?= $key["berat_barang"]; ?> Kg</td>
                <td class="table_data"><?= $key["jumlah_barang"]; ?></td>
                <td class="table_data"><?= $key["alamat_penerima"]; ?></td>
                <td class="table_data"><?= $key["nama_pengirim"]; ?></td>
                <td class="table_data"><?= $key["no_wa_pengirim"]; ?></td>
                <td class="table_data"><?= $key["nama_penerima"]; ?></td>
                <td class="table_data"><?= $key["no_wa_penerima"]; ?></td>
                <td class="table_data">Rp. <?= number_format($key["harga_pengiriman"]); ?></td>
                <td class="table_data">
                    <?= $key["status"]; ?>
                </td>
            </tr>
        <?php $no++;endforeach ?>
        <?php if (count($pesanan) == 0): ?>
            <tr>
                <td colspan="7" class="text-center">Data Tidak Ditemukan</td>
            </tr>
        <?php endif ?>
    </tbody>
</table>