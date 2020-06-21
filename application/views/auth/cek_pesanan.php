<section class="bg-light p-3 rounded bg-white shadow-sm container my-2">

	<div class="table-responsive">
		<a href="<?= base_url('auth') ?>" class="close"><i class="fas fa-fw fa-times"></i></a>
		<h5>Pengirim</h5>
		<table class="table text-left">
            <tr>
              <td class="font-weight-bold">Nama Pengirim</td>
              <td class="px-1"> : </td>
              <td><?= $pengirim['nama_pengirim']; ?></td>
            </tr>
            <tr>
              <td class="font-weight-bold">No. WhatsApp Pengirim</td>
              <td class="px-1"> : </td>
              <td><?= $pengirim['no_wa_pengirim']; ?></td>
            </tr>
            <tr>
              <td class="font-weight-bold">Alamat Pengirim</td>
              <td class="px-1"> : </td>
              <td><?= $pengirim['alamat_pengirim']; ?></td>
            </tr>
        </table>
    </div>
    <div class="dropdown-divider"></div>

    <h5>Penerima</h5>
    <div class="table-responsive">
    	<table class="table">
    		<thead>
    			<tr>
	    			<th>No</th>
	    			<th>No Resi</th>
	    			<th>Nama Penerima</th>
	    			<th>No Wa</th>
	    			<th>Alamat</th>
	    			<th>Status</th>
    			</tr>
    		</thead>
    		<tbody>
    			<?php $no=1;foreach ($penerima as $key): ?>
    			<tr>
	    			<td><?= $no; ?></td>
	    			<td><?= $key["no_resi"]; ?></td>
	    			<td><?= $key["nama_penerima"]; ?></td>
	    			<td><?= $key["no_wa_penerima"]; ?></td>
	    			<td><?= $key["alamat_penerima"]; ?></td>
	    			<td>
	    				<div class="text-center">
	    				<a href="#" class="btn btn-sm <?= bg_status($key["id_status"]); ?> <?= text_status($key["id_status"]); ?>">
	    					<i class="fas fa-fw <?= icon_status($key["id_status"]); ?>"></i>
		    			</a>
		    			</div>
		    		</td>
    			</tr>
    			<?php $no++;endforeach ?>
    		</tbody>
    	</table>
    </div>


<!-- 	<div class="row my-2">
		<div class="col">
			<div class="text-white text-center rounded p-1 bg-danger"><i class="fas fa-2x fa-stopwatch"></i></div>
		</div>
		<div class="col">
			<div class="text-white text-center rounded p-1 bg-warning"><i class="fas fa-2x fa-shipping-fast"></i></div>
		</div>
		<div class="col">
			<div class="text-white text-center rounded p-1 bg-success"><i class="fas fa-2x fa-pallet"></i></div>
		</div>
		<div class="col">
			<div class="text-white text-center rounded p-1 bg-primary"><i class="fas fa-2x fa-paper-plane"></i></div>
		</div>
	</div>
	<div class="row text-center my-2">
		<?php if ($cek_status_pesanan['id_status'] == '1'): ?>
			<div class="col">
				<div class="progress">
              	  <div class="progress-bar bg-danger" role="progressbar" style="width: 25%" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
			</div>
		<?php elseif ($cek_status_pesanan['id_status'] == '2'): ?>
			<div class="col">
				<div class="progress">
              	  <div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
			</div>
		<?php elseif ($cek_status_pesanan['id_status'] == '3'): ?>
			<div class="col">
				<div class="progress">
              	  <div class="progress-bar bg-success" role="progressbar" style="width: 75%" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
			</div>
		<?php else: ?>
			<div class="col">
				<div class="progress">
              	  <div class="progress-bar bg-primary" role="progressbar" style="width: 100%" aria-valuenow="12" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
			</div>
		<?php endif ?>
	</div>
	<div class="table-responsive my-2">
		<table class="table table-bordered table-hover table-striped text-center">
			<thead>
				<tr>
					<?php if ($cek_status_pesanan['id_status'] == '1'): ?>
					<th>Pending</th>
					<?php elseif ($cek_status_pesanan['id_status'] == '2'): ?>
					<th>Pending</th>
					<th>Kurir Menjemput</th>
					<?php elseif ($cek_status_pesanan['id_status'] == '3'): ?>
					<th>Pending</th>
					<th>Kurir Menjemput</th>
					<th>Barang Sampai Logistik</th>
					<?php else: ?>
					<th>Pending</th>
					<th>Kurir Menjemput</th>
					<th>Barang Sampai Logistik</th>
					<th>No. Resi Terkirim</th>
					<?php endif ?>
				</tr>
			</thead>
			<tbody>
				<tr>
					<?php if ($cek_status_pesanan['id_status'] == '1'): ?>
						<td><?= $cek_status_pesanan['tanggal_pemesanan']; ?></td>
					<?php elseif ($cek_status_pesanan['id_status'] == '2'): ?>
						<td><?= $cek_status_pesanan['tanggal_pemesanan']; ?></td>
						<td><?= $cek_status_pesanan['tanggal_penjemputan']; ?></td>
					<?php elseif ($cek_status_pesanan['id_status'] == '3'): ?>
						<td><?= $cek_status_pesanan['tanggal_pemesanan']; ?></td>
						<td><?= $cek_status_pesanan['tanggal_penjemputan']; ?></td>
						<td><?= $cek_status_pesanan['tanggal_masuk_logistik']; ?></td>
					<?php else: ?>
						<td><?= $cek_status_pesanan['tanggal_pemesanan']; ?></td>
						<td><?= $cek_status_pesanan['tanggal_penjemputan']; ?></td>
						<td><?= $cek_status_pesanan['tanggal_masuk_logistik']; ?></td>
						<td><?= $cek_status_pesanan['tanggal_input_resi']; ?></td>
					<?php endif ?>
				</tr>
			</tbody>
		</table>
	</div>
	<br>
	<div class="table-responsive">
		<table class="table text-left">
            <tr>
              <td class="font-weight-bold">No. Resi</td>
              <td class="px-1"> : </td>
              <td><?= $cek_status_pesanan['no_resi']; ?></td>
            </tr>
            <tr>
              <td class="font-weight-bold">Nama Penerima</td>
              <td class="px-1"> : </td>
              <td><?= $cek_status_pesanan['nama_penerima']; ?></td>
            </tr>
            <tr>
              <td class="font-weight-bold">No. WhatsApp Penerima</td>
              <td class="px-1"> : </td>
              <td><?= $cek_status_pesanan['no_wa_penerima']; ?></td>
            </tr>
            <tr>
              <td class="font-weight-bold">Alamat Penerima</td>
              <td class="px-1"> : </td>
              <td><?= $cek_status_pesanan['alamat_penerima']; ?></td>
            </tr>
            <tr>
              <td class="font-weight-bold">Layanan Paket</td>
              <td class="px-1"> : </td>
              <td><?= $cek_status_pesanan['jenis_layanan']; ?></td>
            </tr>
        </table>
	</div> -->

</section>