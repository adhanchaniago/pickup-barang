$(function() {
	let url 	= $('#data-admin').data('url');
    navbar_active();
    ubahJabatan();
    ubahUser();
    ubahLayananPaket();
    ubahPickupBarang();
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

    $('select[name=id_provinsi]').on('change',function() {
        let id_provinsi     = $(this).val();
        kabupaten(id_provinsi,'select[name=id_kabupaten]');
    });
    $('select[name=id_provinsi_asal]').on('change',function() {
        let id_provinsi     = $(this).val();
        kabupaten(id_provinsi,'select[name=id_kabupaten_asal]');
    });
    $('select[name=id_provinsi_tujuan]').on('change',function() {
        let id_provinsi     = $(this).val();
        kabupaten(id_provinsi,'select[name=id_kabupaten_tujuan]');
    });

    $('select[name=id_kabupaten]').on('change',function() {
        let id_kabupaten     = $(this).val();
        kecamatan(id_kabupaten,'select[name=id_kecamatan]');
    });
    $('select[name=id_kabupaten_asal]').on('change',function() {
        let id_kabupaten     = $(this).val();
        kecamatan(id_kabupaten,'select[name=id_kecamatan_asal]');
    });
    $('select[name=id_kabupaten_tujuan]').on('change',function() {
        let id_kabupaten     = $(this).val();
        kecamatan(id_kabupaten,'select[name=id_kecamatan_tujuan]');
    });
    

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
    function ubahPickupBarang() {
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

    function ubahLayananPaket() {
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

    function ubahJabatan() {
        $('#table_id').on('click','.btn-edit-jabatan',function(e){
            e.preventDefault();
            $('#editJabatanModal').modal('show');
            let id_jabatan   = $(this).data('id');
            $.ajax({
                url         : url + 'Jabatan/getJabatanById',
                method      : 'post',
                data        : {id_jabatan : id_jabatan},
                dataType    : 'json',
                success     : function(response) {
                    $('#editJabatanModal form').attr('action',url + 'jabatan/editJabatan/'+response.id_jabatan);
                    $('#editJabatanModalLabel').html('Ubah Jabatan - ' + response.nama_jabatan);
                    $('#edit_nama_jabatan').val(response.nama_jabatan);
                    

                }
            })
        });
    }

    function ubahUser() {
        $('#table_id').on('click','.btn-edit-user',function(e){
            e.preventDefault();
            $('#editUserModal').modal('show');
            let id_user   = $(this).data('id');
            $.ajax({
                url         : url + 'user/getUserById',
                method      : 'post',
                data        : {id_user : id_user},
                dataType    : 'json',
                success     : function(response) {
                    $('#editUserModal form').attr('action',url + 'User/editUser/'+response.id_user);
                    $('#editUserModalLabel').html('Ubah User - ' + response.username);
                    $('#edit_username').val(response.username);
                    $('#edit_nama_lengkap').val(response.nama_lengkap);
                    $('#edit_id_jabatan').val(response.id_jabatan).select();
                    

                }
            })
        });
    }
    
})


function kabupaten(id_provinsi,el,value = '') {
    if (id_provinsi) {
        $.ajax({
            url         : url + 'kabupaten/getKecamatanByProvinsi',
            data        : {id_provinsi : id_provinsi},
            method      : 'post',
            dataType    : 'json',
            success     : function(response) {
                let html    = '';
                for (var i = 0; i < response.length; i++) {
                    html    += `<option value="${response[i].id_kabupaten}">${response[i].nama_kabupaten}</option>`
                }
                $(el).html(html);
                $(el).val(value).select();
            }
        })
    }
}
function kecamatan(id_kabupaten,el,value = '') {
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
                $(el).val(value).select();
            }
        })
    }
}
