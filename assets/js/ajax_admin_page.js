$.ajax({
   let url = $('#data-admin').data('url');
   url: url,
   data: {callback:callback}
   type: 'GET',
   dataType: 'json',

   success: function(data) {
      for (var x = 0; x < data.result.length; x++) {
         $("#pesanan").append(`
            <div class="card p-0 bg-success">
               <a href="" data-toggle="modal" data-target="#detailModal`+ data.result.length[x] +`">
                  <div class="card-body p-3 text-white">
                     <h5>`+ data.result.nama_barang[x] +`</h5>
                     <h6>Dari `+ data.result.nama_pengirim[x] +` ke `+ data.result.nama_penerima[x] +`</h6>
                     <h6>`+ data.result.jenis_layanan[x] +` | Rp. `+ data.result.harga[x] +` | `+ data.result.durasi_pengiriman[x] +` Jam</h6>
                     <h6>`+ data.result.tanggal_pemesanan[x] +`</h6>
                  </div>
               </a>
           </div>
         `);
      }
   },
   error: function () { alert('error'); },
});