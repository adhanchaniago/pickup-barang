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
            let el      = $('.penerima');

            el[0].classList.remove('d-none');
            el[0].setAttribute('id','penerima'+klikTambah);
            el.find('.form-control').removeAttr('disabled');
            let html    = el[0].outerHTML;
            $('.boxPenerima').append(html);

            el.find('.form-control').attr('disabled','disabled');
            el[0].classList.add('d-none');
            el[0].removeAttribute('id');        
        }
        function jenisLayanan(id) {
            let kec_pengirim    = $('#kecamatan_pengirim').val();
            let kec_penerima    = $(id + ' .kecamatan_penerima').val();
            let berat_barang    = $(id + ' .berat_barang').val();

            if (kec_pengirim == '' || kec_penerima == '' || berat_barang == '') {
                $(id + ' .jenis_layanan').html('<option value="" disabled selected class="d-none">Tidak Ada Layanan Apapun Untuk Pengiriman Ini</option>');
                return;
            }

            let id_jenis_paket  = 0;

            if (berat_barang > 8) {
                id_jenis_paket  =2;
            }else{
                id_jenis_paket  =1;
            }

            let data    = {
                kec_asal : kec_pengirim,
                kec_tujuan : kec_penerima,
                id_jenis_paket : id_jenis_paket
            }
            $.ajax({
                url         : url + 'jenisLayanan/getJenisLayananByKecAndBerat',
                data        : data,
                method      : 'post',
                dataType    : 'json',
                success     : function(response) {
                    let html    = '';
                    for (var i = 0; i < response.length; i++) {
                        html    += `<option value="${response[i].id_jenis_layanan}">${response[i].jenis_layanan}</option>`;
                    }
                    if (response.length == 0) {
                        html    = '<option value="" disabled selected class="d-none">Tidak Ada Layanan Apapun Untuk Pengiriman Ini</option>';
                    }
                    $(id + ' .jenis_layanan').html(html);
                }
            })
        }
        $('.tambahPenerima').on('click',function(e) {
            e.preventDefault();
            tambah();
        })
        $('.boxPenerima').on('click','.hapusPenerima',function(e) {
            e.preventDefault();
            let el      = $(this).parents('.penerima')[0];
            el.outerHTML = '';            
            disabledSubmit();
        })


        $('[name=provinsi_pengirim]').on('change',function() {
            let id_provinsi     = $(this).val();
            selectKabupaten(id_provinsi,'[name=kabupaten_pengirim]');
            setTimeout(function() {
                let id_kabupaten    = $('[name=kabupaten_pengirim]').val();
                selectKecamatan(id_kabupaten,'[name=kecamatan_pengirim]');
                jenisLayanan('');
            },1000);
        })
        $('[name=kabupaten_pengirim]').on('change',function() {
            let id_kabupaten    = $('[name=kabupaten_pengirim]').val();
            selectKecamatan(id_kabupaten,'[name=kecamatan_pengirim]');
            jenisLayanan('');
        })
        $('[name=kecamatan_pengirim]').on('change',function() {
            $('.berat_barang').val('');
            jenisLayanan('');
        })



        $('.boxPenerima').on('keyup','.berat_barang',function() {
            let id              = '#'+$(this).parents('.penerima').attr('id');
            jenisLayanan(id);
        })

        $('.boxPenerima').on('change','.provinsi_penerima',function() {
            let id              = '#'+$(this).parents('.penerima').attr('id');
            let id_provinsi     = $(this).val();
            selectKabupaten(id_provinsi,id + ' .kabupaten_penerima');
            setTimeout(function() {
                let id_kabupaten    = $(id + ' .kabupaten_penerima').val();
                selectKecamatan(id_kabupaten,id + ' .kecamatan_penerima');
                jenisLayanan(id);
            },1000);


        })

        $('.boxPenerima').on('change','.kabupaten_penerima',function() {
            let id              = '#'+$(this).parents('.penerima').attr('id');
            let id_kabupaten    = $(id + ' .kabupaten_penerima').val();
            selectKecamatan(id_kabupaten,id + ' .kecamatan_penerima');
        })
        $('.boxPenerima').on('change','.kecamatan_penerima',function() {
            let id              = '#'+$(this).parents('.penerima').attr('id');
            jenisLayanan(id);
        })
        
    }
    function kurirPickup() {
        load({status : $('#status').val()});
        function load(data = {},reset = 0) {
            $.ajax({
                url         : url + 'pickupBarang/kurirAjax',
                method      : 'post',
                dataType    : 'json',
                data        : data,
                success     : function(response) {
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
            data.status     = $('#status').val();
            data.search     = $('#search').val();
            load(data,1);
        })
        $('#search').on('keyup',function() {
            let data        = {};
            data.status     = $('#status').val();
            data.search     = $('#search').val();
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
            $.ajax({
                url         : url + 'pickupBarang/getPickupBarangById',
                method      : 'post',
                dataType    : 'json',
                data        : {id_pickup_barang:id},
                success     : function(response) {
                    $(modal+ ' .modal-title').html("Detail Pickup - " +response.no_resi);
                    $(modal+ ' #no_resi').html(response.no_resi);
                    $(modal+ ' #nama_barang').html(response.nama_barang);
                    $(modal+ ' #jumlah_barang').html(response.jumlah_barang);
                    $(modal+ ' #berat_barang').html(response.berat_barang+ ' Kg');
                    $(modal+ ' #nama_pengirim').html(response.nama_pengirim);
                    $(modal+ ' #no_wa_pengirim').html(response.no_wa_pengirim);
                    $(modal+ ' #alamat_pengirim').html(response.alamat_pengirim + ", " + response.kec_pengirim + ", " + response.kab_pengirim + ", " + response.prov_pengirim + ", " + response.negara_pengirim);
                    $(modal+ ' #nama_penerima').html(response.nama_penerima);
                    $(modal+ ' #no_wa_penerima').html(response.no_wa_penerima);
                    $(modal+ ' #alamat_penerima').html(response.alamat_penerima + ", " + response.kec_penerima + ", " + response.kab_penerima + ", " + response.prov_penerima + ", " + response.negara_penerima);
                    $(modal+ ' #jenis_layanan').html(response.jenis_layanan);
                    $(modal+ ' #harga').html(response.harga);
                    $(modal+ ' #durasi_pengiriman').html(response.durasi_pengiriman + ' Jam');
                }
            })
        })

        let data                = {};
        data.no_wa_pengirim     = $('#data-detailPickup').data('wa');
        data.status             = $('#data-detailPickup').data('status');
        load(data);

        function load(data = {},reset = 0) {
            $.ajax({
                url         : url + 'pickupBarang/detailPickupAjax',
                method      : 'post',
                dataType    : 'json',
                data        : data,
                success     : function(response) {
                    let html    = '';
                    for (var i = 0; i < response[0].length; i++) {
                        html    += response[0][i];
                    }
                    $('#total').html(response[1]);
                    if (response[2] == 0) {
                        $('[name=btnPending]').attr('disabled','disabled');
                    }
                    let jml = $('input:checked').length;
                    if (response[3] == 0 || jml == 0) {
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
            data.search     = $('#search').val();
            load(data,1);
        })
    }
})


function selectKabupaten(id_provinsi,el,value = '') {
    if (id_provinsi) {
        $.ajax({
            url         : url + 'kabupaten/getKabupatenByProvinsi',
            data        : {id_provinsi : id_provinsi},
            method      : 'post',
            dataType    : 'json',
            success     : function(response) {
                let html    = '';
                for (var i = 0; i < response.length; i++) {
                    html    += `<option value="${response[i].id_kabupaten}">${response[i].nama_kabupaten}</option>`
                }
                if (response.length == 0) {
                    html    = '<option value="" disabled selected class="d-none">Tidak Ada Kabupaten/Kota Untuk Provinsi Ini</option>'
                }
                $(el).html(html);
                if (value != '') {
                    $(el).val(value).select();
                }
            },
            error       : function(error) {
            }
        })
    }
}
function selectKecamatan(id_kabupaten,el,value = '') {
    if (id_kabupaten) {
    
        $.ajax({
            url         : url + 'kecamatan/getKecamatanByKabupaten',
            data        : {id_kabupaten : id_kabupaten},
            method      : 'post',
            dataType    : 'json',
            success     : function(response) {
                let html    = '';
                for (var i = 0; i < response.length; i++) {
                    html    += `<option value="${response[i].id_kecamatan}">${response[i].nama_kecamatan}</option>`
                }
                if (response.length == 0) {
                    html    = '<option value="" disabled selected class="d-none">Tidak Ada Kecamatan Untuk Kabupaten/Kota Ini</option>'
                }
                $(el).html(html);
                if (value != '') {
                    $(el).val(value).select();
                }
            }
        })
    }
}
