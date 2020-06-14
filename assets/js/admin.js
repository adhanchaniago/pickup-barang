let url 	= $('#data-admin').data('url');

$(function() {
    navbar_active();
    jabatan();
    user();
    layanan();
    pickupBarang();
    provinsi();
    kabupaten();
    kecamatan();
    datatable();


    function datatable() {
        let link    = $('#table_id').data('link');
        $('#table_id').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                url     : link,
                method  : 'post'
            },
            "columnDefs" :[
            {
                "targets"    : [-1],
                "orderable" : false
            }
            ]
        });
    }

    // $('select[name=id_provinsi]').on('change',function() {
    //     let id_provinsi     = $(this).val();
    //     selectKabupaten(id_provinsi,'select[name=id_kabupaten]');
    // });
    // $('select[name=id_provinsi_asal]').on('change',function() {
    //     let id_provinsi     = $(this).val();
    //     selectKabupaten(id_provinsi,'select[name=id_kabupaten_asal]');
    // });
    // $('select[name=id_provinsi_tujuan]').on('change',function() {
    //     let id_provinsi     = $(this).val();
    //     selectKabupaten(id_provinsi,'select[name=id_kabupaten_tujuan]');
    // });

    // $('select[name=id_kabupaten]').on('change',function() {
    //     let id_kabupaten     = $(this).val();
    //     selectKecamatan(id_kabupaten,'select[name=id_kecamatan]');
    // });
    // $('select[name=id_kabupaten_asal]').on('change',function() {
    //     let id_kabupaten     = $(this).val();
    //     selectKecamatan(id_kabupaten,'select[name=id_kecamatan_asal]');
    // });
    // $('select[name=id_kabupaten_tujuan]').on('change',function() {
    //     let id_kabupaten     = $(this).val();
    //     selectKecamatan(id_kabupaten,'select[name=id_kecamatan_tujuan]');
    // });
    

    function navbar_active() {
        let linkNav     = $('#data-admin').data('link');
        $('.nav-link').removeClass('active');
        $.each($('.nav-link'),function(i,j) {
            let href    = j.attributes.href.value;
            let link    = url + linkNav;

            if (href == link) {
                j.classList.add('active');  
                if (j.parentElement.parentElement.classList.contains('nav-treeview')) {
                    j.parentElement.parentElement.parentElement.classList.add('menu-open');
                    j.parentElement.parentElement.previousSibling.previousSibling.classList.add('active');
                }
            }

        });
    }
    function pickupBarang() {
        $('#table_id').on('click','.btn-edit-pickupBarang',function(e){
            e.preventDefault();
            $('#editPickupBarangModal').modal('show');
            let id_pickup_barang   = $(this).data('id');
            $.ajax({
                url         : url + 'pickupBarang/getPickupBarangById',
                method      : 'post',
                data        : {id_pickup_barang : id_pickup_barang},
                dataType    : 'json',
                success     : function(response) {
                    $('#editPickupBarangModal form').attr('action',url + 'pickupBarang/editPickupBarang/'+response.id_pickup_barang);
                    $('#editPickupBarangModalLabel').html('Ubah Pickup Barang - ' + response.nama_pengirim);
                    $('#edit_status').val(response.status).select();
                    $('#edit_nama_pengirim').val(response.nama_pengirim);
                    $('#edit_no_whatsapp_pengirim').val(response.no_whatsapp_pengirim);
                    $('#edit_alamat_pengirim').val(response.alamat_pengirim);
                    $('#edit_nama_barang').val(response.nama_barang);
                    $('#edit_berat_barang').val(response.berat_barang);
                    $('#edit_jumlah_barang').val(response.jumlah_barang);
                    $('#edit_nama_penerima').val(response.nama_penerima);
                    $('#edit_no_whatsapp_penerima').val(response.no_whatsapp_penerima);
                    $('#edit_alamat_penerima').val(response.alamat_penerima);
                    $('#edit_id_layanan_paket').val(response.id_layanan_paket).select();

                }
            })
        });
    }

    function layanan() {
        $('#table_id').on('click','.btn-edit-layananPaket',function(e){
            e.preventDefault();
            $('#editLayananPaketModal').modal('show');
            let id_layanan_paket   = $(this).data('id');
            $.ajax({
                url         : url + 'layananPaket/getLayananPaketById',
                method      : 'post',
                data        : {id_layanan_paket : id_layanan_paket},
                dataType    : 'json',
                success     : function(response) {
                    $('#editLayananPaketModal form').attr('action',url + 'layananPaket/editLayananPaket/'+response.id_layanan_paket);
                    $('#editLayananPaketModalLabel').html('Ubah Layanan Paket - ' + response.layanan_paket);
                    $('#edit_layanan_paket').val(response.layanan_paket);
                    $('#edit_harga_layanan_paket').val(response.harga_layanan_paket);
                    $('#edit_durasi_pengiriman').val(response.durasi_pengiriman);
                    

                }
            })
        });
    }

    function jabatan() {
        let modal       = '#jabatanModal';
        $('#table_id').on('click','.btn-edit-jabatan',function(e){
            e.preventDefault();
            $(modal).modal('show');
            $(modal+ ' #label').html('Edit Jabatan');
            let id_jabatan   = $(this).data('id');
            $.ajax({
                url         : url + 'Jabatan/getJabatanById',
                method      : 'post',
                data        : {id_jabatan : id_jabatan},
                dataType    : 'json',
                success     : function(response) {
                    $(modal + ' #label').html('Ubah Jabatan - ' + response.nama_jabatan);
                    $(modal + ' #nama_jabatan').val(response.nama_jabatan);
                    $(modal + ' #id_jabatan').val(response.id_jabatan);
                }
            })
        });
        $('.btn-tambah-jabatan').on('click',function(e) {
            $(modal).modal('show');
            $(modal+ ' #label').html('Tambah Jabatan');
            $(modal+ ' #reset').click();
        })
    }

    function user() {
        let modal       = '#userModal';
        $('#table_id').on('click','.btn-edit-user',function(e){
            e.preventDefault();
            $(modal).modal('show');
            let id_user   = $(this).data('id');
            $.ajax({
                url         : url + 'user/getUserById',
                method      : 'post',
                data        : {id_user : id_user},
                dataType    : 'json',
                success     : function(response) {
                    $(modal + ' #label').html('Ubah Pengguna - ' + response.username);
                    $(modal + ' #username').val(response.username);
                    $(modal + ' #nama_lengkap').val(response.nama_lengkap);
                    $(modal + ' #id_jabatan').val(response.id_jabatan).select();
                    $(modal + ' #id_user').val(response.id_user);

                    let foto    = url + 'assets/img/img_profiles/' + response.img_profile;
                    $(modal + ' #photo').attr('href',foto);
                    $(modal + ' #photo img').attr('src',foto);
                }
            })
        });
        $('.btn-tambah-user').on('click',function(e) {
            $(modal).modal('show');
            $(modal+ ' #label').html('Tambah Pengguna');
            $(modal+ ' #reset').click();
            let foto    = url + 'assets/img/img_profiles/default.png';
            $(modal + ' #photo').attr('href',foto);
            $(modal + ' #photo img').attr('src',foto);
        })
    }

    function provinsi() {
        let modal       = '#provinsiModal';
        $('#table_id').on('click','.btn-edit-provinsi',function(e) {
            e.preventDefault();
            let id_provinsi     = $(this).data('id');
            $(modal).modal('show');
            $(modal+ ' #label').html('Edit Provinsi');

            $.ajax({
                url         : url + 'provinsi/getProvinsiById',
                method      : 'post',
                dataType    : 'json',
                data        : {id_provinsi : id_provinsi},
                success     : function(response) {
                    $(modal+' #id_provinsi').val(response.id_provinsi);
                    $(modal+' #nama_provinsi').val(response.nama_provinsi);
                    $(modal+' #negara').val(response.negara);
                }
            })
        })
        $('.btn-tambah-provinsi').on('click',function(e) {
            $(modal).modal('show');
            $(modal+ ' #label').html('Tambah Provinsi');
            $(modal+ ' #reset').click();
        })
    }
    function kabupaten() {
        let modal       = '#kabupatenModal';
        $('#table_id').on('click','.btn-edit-kabupaten',function(e) {
            e.preventDefault();
            let id_kabupaten     = $(this).data('id');

            $(modal).modal('show');
            $(modal+ ' #label').html('Edit Kabupaten');
            $.ajax({
                url         : url + 'kabupaten/getKabupatenById',
                method      : 'post',
                dataType    : 'json',
                data        : {id_kabupaten : id_kabupaten},
                success     : function(response) {
                    $(modal+' #id_provinsi').val(response.id_provinsi).select();
                    $(modal+' #id_kabupaten').val(response.id_kabupaten);
                    $(modal+' #nama_kabupaten').val(response.nama_kabupaten);
                }
            })
        })
        $('.btn-tambah-kabupaten').on('click',function(e) {
            $(modal).modal('show');
            $(modal+ ' #label').html('Tambah Kabupaten');
            $(modal+ ' #reset').click();
        })
    }
    function kecamatan() {
        let modal       = '#kecamatanModal';
        $('#table_id').on('click','.btn-edit-kecamatan',function(e) {
            e.preventDefault();
            let id_kecamatan     = $(this).data('id');

            $(modal).modal('show');
            $(modal+ ' #label').html('Edit Kecamatan');
            $.ajax({
                url         : url + 'kecamatan/getKecamatanById',
                method      : 'post',
                dataType    : 'json',
                data        : {id_kecamatan : id_kecamatan},
                success     : function(response) {
                    selectKabupaten(response.id_provinsi,modal+' #id_kabupaten',response.id_kabupaten);
                    $(modal+' #id_provinsi').val(response.id_provinsi).select();
                    $(modal+' #id_kecamatan').val(response.id_kecamatan);
                    $(modal+' #nama_kecamatan').val(response.nama_kecamatan);
                }
            })
        })
        $(modal+' #id_provinsi').on('change',function() {
            let id_provinsi     = $(this).val();
            selectKabupaten(id_provinsi,modal+' #id_kabupaten');
        })

        $('.btn-tambah-kecamatan').on('click',function(e) {
            $(modal).modal('show');
            $(modal+ ' #label').html('Tambah Kecamatan');
            $(modal+ ' #reset').click();
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
                $(el).html(html);
                if (value != '') {
                    $(el).val(value).select();
                }
            }
        })
    }
}
function selectKecamatan(id_kabupaten,el,value = '') {
    if (id_kabupaten) {
        $.ajax({
            url         : url + 'kabupaten/getKecamatanByKabupaten',
            data        : {id_kabupaten : id_kabupaten},
            method      : 'post',
            dataType    : 'json',
            success     : function(response) {
                let html    = '';
                for (var i = 0; i < response.length; i++) {
                    html    += `<option value="${response[i].id_kecamatan}">${response[i].nama_kecamatan}</option>`
                }
                $(el).html(html);
                if (value != '') {
                    $(el).val(value).select();
                }
            }
        })
    }
}
