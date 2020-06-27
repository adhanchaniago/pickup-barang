let url 	        = $('#data-admin').data('url');
let halaman_ini     = $('#data-admin').data('link');
$(function() {
    navbar_active();
    datatable();
    switch(halaman_ini){
        case 'user':
            user();
        break;
        case 'pickupBarang':
            pickupBarang();
        break;
        case 'jenisLayanan':
            jenisLayanan();
        break;
        
    }

    function datatable(data = {}) {
        let link    = $('#table_id').data('link');
        
        if (link == undefined) {
            $('#table_id').DataTable();
        }else{
            $('#table_id').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    url     : link,
                    method  : 'post',
                    data    : data
                },
                "columnDefs" :[{
                    "targets"    : [-1],
                    "orderable" : false
                }],
                "responsive": true,
                "autoWidth": true
            });
        }
    }

    
    

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
        let modal       = '#pickupBarangModal';
        $('#table_id').on('click','.btn-edit-pickupBarang',function(e){
            e.preventDefault();
            $(modal).modal('show');
            $(modal + ' #label').html('Ubah Pickup Barang');
            let id_pickup_barang   = $(this).data('id');
            $(modal + ' #id_pickup_barang').val(id_pickup_barang);
            // $.ajax({
            //     url         : url + 'pickupBarang/getPickupBarangById',
            //     method      : 'post',
            //     data        : {id_pickup_barang : id_pickup_barang},
            //     dataType    : 'json',
            //     success     : function(response) {
                    
            //         $(modal + ' #no_resi').val(response.no_resi);
            //         $(modal + ' #id_pengirim').val(response.id_pengirim).trigger('change');
            //         $(modal + ' #id_penerima').val(response.id_penerima).trigger('change');
            //         $(modal + ' #id_layanan_paket').val(response.id_layanan_paket).trigger('change');
            //         $(modal + ' #nama_barang').val(response.nama_barang);
            //         $(modal + ' #berat_barang').val(response.berat_barang);
            //         $(modal + ' #jumlah_barang').val(response.jumlah_barang);
            //         $(modal + ' #tanggal_pemesanan').val(response.tanggal_pemesanan);
            //         $(modal + ' #tanggal_penjemputan').val(response.tanggal_penjemputan);
            //         $(modal + ' #tanggal_masuk_logistik').val(response.tanggal_masuk_logistik);
            //         $(modal + ' #id_pickup_barang').val(response.id_pickup_barang).trigger('change');
            //         $(modal + ' #status').val(response.status);
            //     }
            // })
        });

        $('.btn-tambah-pickupBarang').on('click',function(e) {
            e.preventDefault();
            $(modal).modal('show');
            $(modal+ ' #label').html('Tambah Pickup Barang');
            $(modal+ ' #reset').click();
        })
        $('#whereStatus').on('change',function() {
            let val     = $(this).val();
            $('#table_id').DataTable().destroy();
            let data        = {id_status : val};
            datatable(data);
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
            e.preventDefault();
            $(modal).modal('show');
            $(modal+ ' #label').html('Tambah Pengguna');
            $(modal+ ' #reset').click();
            let foto    = url + 'assets/img/img_profiles/default.png';
            $(modal + ' #photo').attr('href',foto);
            $(modal + ' #photo img').attr('src',foto);
        })
    }

    function jenisLayanan() {
        let modal       = '#jenisLayananModal';
        $('#table_id').on('click','.btn-edit-jenisLayanan',function(e) {
            e.preventDefault();
            let id_jenis_layanan     = $(this).data('id');
            $(modal).modal('show');

            $.ajax({
                url         : url + 'jenisLayanan/getJenisLayananById',
                method      : 'post',
                dataType    : 'json',
                data        : {id_jenis_layanan : id_jenis_layanan},
                success     : function(response) {
                    $(modal+ ' #label').html('Edit Jenis Layanan - '+response.jenis_layanan);
                    $(modal+' #id_jenis_layanan').val(response.id_jenis_layanan);
                    $(modal+' #jenis_layanan').val(response.jenis_layanan);
                }
            })
        })
        $('.btn-tambah-jenisLayanan').on('click',function(e) {
            e.preventDefault();
            $(modal).modal('show');
            $(modal+ ' #label').html('Tambah Jenis Layanan');
            $(modal+ ' #reset').click();
        })
    }


    
})