let url     = $('#data-auth').data('url');
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
    pickupbarang();
    function pickupbarang() {
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
            let el      = $('.penerima')[0];

            el.classList.remove('d-none');
            el.setAttribute('id','penerima'+klikTambah);
            let html    = $('.penerima')[0].outerHTML;
            $('.boxPenerima').append(html);

            el.classList.add('d-none');
            el.removeAttribute('id');        
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
            },1000);
        })
        $('[name=kabupaten_pengirim]').on('change',function() {
            let id_kabupaten    = $('[name=kabupaten_pengirim]').val();
            selectKecamatan(id_kabupaten,'[name=kecamatan_pengirim]');
        })

        $('.boxPenerima').on('change','.provinsi_penerima',function() {
            let id              = '#'+$(this).parents('.penerima').attr('id');
            let id_provinsi     = $(this).val();
            selectKabupaten(id_provinsi,id + ' .kabupaten_penerima');
            setTimeout(function() {
                let id_kabupaten    = $(id + ' .kabupaten_penerima').val();
                selectKecamatan(id_kabupaten,id + ' .kecamatan_penerima');
            },1000);
        })
        $('.boxPenerima').on('change','.kabupaten_penerima',function() {
            let id              = '#'+$(this).parents('.penerima').attr('id');
            let id_kabupaten    = $(id + ' .kabupaten_penerima').val();
            selectKecamatan(id_kabupaten,id + ' .kecamatan_penerima');
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
