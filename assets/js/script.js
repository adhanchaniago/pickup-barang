let url     = $('#data-auth').data('url');
let link    = $('#data-auth').data('link');
// event pada saat link diklik
$('.page-scroll').on('click', function(e){

    // ambil isi href
    var tujuan = $(this).attr('href');
    // tangkap elemen yg bersangkutan
    var elemenTujuan = $(tujuan);

    // pindahkan scroll
    $('html, body').animate({
        scrollTop: elemenTujuan.offset().top - 45
    }, 1250, 'easeInOutExpo');
    $('.navbar-collapse.collapse').removeClass('show');
    e.preventDefault();
});

$(function() {
    switch(link){
        case 'pickupBarang/form':
            formPickupBarang();
        break;
        case 'pickupBarang/kurir':
            kurirPickup();
        break;
        case 'pickupBarang/detailPickup':
            kurirDetailPickup();
        break;
        case 'auth/cek_status_pesanan':
            cekStatusPesanan();
        break;
    }

    function formPickupBarang() {
        let klikTambah  = 0;
        tambah();
        function disabledSubmit() {
            let jml     = $('.penerima').length;
            if (jml < 2) {
                $('[type=submit]').attr('disabled','disabled');
            }
        }
        function tambah() {
            klikTambah++;
            $('[type=submit]').removeAttr('disabled');
            let el      = $('#penerima0');
            $('.jenis_layanan').select2();
            $('.jenis_layanan').select2('destroy');

            el.removeClass('d-none');
            el.find('.form-control').removeAttr('disabled');
            el.attr('id','penerima'+klikTambah);
            let html    = el[0].outerHTML;
            $('.boxPenerima').append(html);

            el.attr('id','penerima0');
            el.find('.form-control').attr('disabled','disabled');
            el.addClass('d-none');
            $('.jenis_layanan').select2();
        }

        $('.tambahPenerima').on('click',function(e) {
            e.preventDefault();
            tambah();
        })

        $('.boxPenerima').on('click','.hapusPenerima',function(e) {
            e.preventDefault();
            let el          = $(this).parents('.penerima');
            el[0].outerHTML    = '';
            disabledSubmit();
        })

        $('[type=submit]').on('dblclick',function(e) {
            e.preventDefault();
        })

        
    }
    function kurirPickup() {
        load({id_status : $('#status').val()});
        function load(data = {},reset = 0) {
            $.ajax({
                url         : url + 'pickupBarang/kurirAjax',
                method      : 'post',
                dataType    : 'json',
                data        : data,
                success     : function(response) {
                	$("#preloader").hide();
                	$("#content").show();
                    let html    = '';
                    for (var i = 0; i < response.length; i++) {
                        html    += response[i];
                    }
                    if (reset == 0) {
                        $('#content').append(html);
                    }else{
                        $('#content').html(html);                        
                    }
                    if ($('#content').html() == '' && html == '') {
                        html    += '<div class="text-center col-12">Data Tidak Ditemukan</div>';
                        $('#content').html(html);                        
                    }
                }
            })
        }
        $('#status').on('change',function() {
            let data        = {};
            data.id_status  = $('#status').val();
            data.search     = $('#search').val();
            $("#preloader").show();
            $("#content").hide();
            load(data,1);

        })
        $('#search').on('keyup',function() {
            let data        = {};
            data.id_status  = $('#status').val();
            data.search     = $('#search').val();
            $("#preloader").show();
            $("#content").hide();
            load(data,1);
        })
    }
    function kurirDetailPickup(){
        $('#content').on('change','[type=checkbox]',function() {
            let jml = $('input:checked').length;
            let all = $('[type=checkbox]').length;
            if (jml > 0) {
                $('[name=btnPickup]').removeAttr('disabled');
            }else{
                $('[name=btnPickup]').attr('disabled','disabled');
            }
            $('#angka').html(jml+' / '+all);
        })

        $('#content').on('click','.btnDetail',function(e) {
            e.preventDefault();
            let modal   = '#modalDetail';
            $(modal).modal('show');
            let id = $(this).attr('href');
            $(modal+ ' .modal-title').html("Detail Pickup");
            $.ajax({
                url         : url + 'pickupBarang/getPickupBarangById',
                method      : 'post',
                dataType    : 'json',
                data        : {id_pickup_barang:id},
                success     : function(response) {
                    $(modal+ ' #no_resi').html(response.no_resi);
                    $(modal+ ' #nama_pengirim').html(response.nama_pengirim);
                    $(modal+ ' #no_wa_pengirim').html(response.no_wa_pengirim);
                    $(modal+ ' #alamat_pengirim').html(response.alamat_pengirim);
                    $(modal+ ' #nama_penerima').html(response.nama_penerima);
                    $(modal+ ' #no_wa_penerima').html(response.no_wa_penerima);
                    $(modal+ ' #alamat_penerima').html(response.alamat_penerima);
                    $(modal+ ' #nama_barang').html(response.nama_barang);
                    $(modal+ ' #jumlah_barang').html(response.jumlah_barang);
                    $(modal+ ' #berat_barang').html(response.berat_barang);
                    $(modal+ ' #jenis_layanan').html(response.jenis_layanan);
                }
            })
        })

        let data                = {};
        data.alamat_pengirim    = $('#data-detailPickup').data('alamat');
        data.id_status          = $('#data-detailPickup').data('status');
        load(data);

        function load(data = {},reset = 0) {
            $.ajax({
                url         : url + 'pickupBarang/detailPickupAjax',
                method      : 'POST',
                dataType    : 'json',
                data        : data,
                success     : function(response) {
                	$("#preloader").hide();
                	$("#content").show();
                    let html    = '';
                    for (var i = 0; i < response[0].length; i++) {
                        html    += response[0][i];
                    }
                    if (response[1] == 0) {
                        $('[name=btnPending]').attr('disabled','disabled');
                    }
                    let jml = $('input:checked').length;
                    if (response[2] == 0 || jml == 0) {
                        $('[name=btnPickup]').attr('disabled','disabled');
                    }
                    if (reset == 0) {
                        $('#content').append(html);
                    }else{
                        $('#content').html(html);                        
                    }
                    if ($('#content').html() == '' && html == '') {
                        html    += '<div class="text-center col-12">Data Tidak Ditemukan</div>';
                        $('#content').html(html);                        
                    }
                }
            })
        }

        $('#search').on('keyup',function() {
        	$("#preloader").show();
			$("#content").hide();
            data.search     = $('#search').val();
            load(data,1);
        })

        $('body').on('click','#btnPending',function() {
        	$('#preloaderAmbil').show();
        	$(this).prop('readonly',true);
        	$(this).addClass('disabled');
        	$(this).parents('form').submit();
        })

        $('body').on('click','#btnPickup',function() {
        	$('#preloaderSubmit').show();
        	$(this).prop('readonly',true);
        	$(this).addClass('disabled');
        	$(this).parents('form').submit();

        })
    }

    function cekStatusPesanan() {
        let warnaBar    = '';
        $('.table').on('click','.btn-detail-status',function(e) {
            e.preventDefault();
            let id              = $(this).data('id');
            let modal           = $('#progressModal');
            let progressBar     = modal.find('.progress-bar');
            modal.modal('show');
            $.ajax({
                url             : url + 'pickupBarang/getPickupBarangById',
                data            : {id_pickup_barang : id},
                method          : 'post',
                dataType        : 'json',
                success         : function(response) {
                    progressBar.removeClass(warnaBar);
                    progressBar.css({"width" : 0 + '%'});

                    if (response.id_status == 4) {
                        modal.find('.modal-title').html('Status Barang - '+response.nama_barang+', '+ response.no_resi);
                    }else{
                        modal.find('.modal-title').html('Status Barang - '+response.nama_barang);
                    }
                    let width   = 'bg-danger';
                    let warna   = 50;
                    let html    = '';

                    switch(parseInt(response.id_status)){
                        case 1:
                            width   = 12;
                            warna   = 'bg-danger';
                        break;
                        case 2:
                            width   = 37;
                            warna   = 'bg-warning';
                        break;
                        case 3:
                            width   = 63;
                            warna   = 'bg-success';
                        break;
                        case 4:
                            width   = 100;
                            warna   = 'bg-primary';
                        break;
                    }
                    if(parseInt(response.id_status) >= 1){
                        html    += `
                        <tr>
                        <th>Pending</th>
                        <td>${response.tanggal_pemesanan}</td>
                        </tr>
                        `;
                    }
                    if(parseInt(response.id_status) >= 2){
                        html    += `
                        <tr>
                        <th>Kurir Menjemput</th>
                        <td>${response.tanggal_penjemputan}</td>
                        </tr>
                        `;
                    }
                    if(parseInt(response.id_status) >= 3){
                        html    += `
                        <tr>
                        <th>Barang Masuk Logistik</th>
                        <td>${response.tanggal_masuk_logistik}</td>
                        </tr>
                        `;
                    }
                    if(parseInt(response.id_status) >= 4){
                        html    += `
                        <tr>
                        <th>Resi Terkirim</th>
                        <td>${response.tanggal_input_resi}</td>
                        </tr>
                        `;
                    }
                    warnaBar    = warna;
                    progressBar.addClass(warna);
                    progressBar.css({"width" : width + '%'});

                    modal.find('table').html(html);


                }
            })

        })
    }
})
