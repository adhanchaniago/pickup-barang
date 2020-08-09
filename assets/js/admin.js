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
        case 'pickupBarang/index':
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
                // "responsive": true,
                // "autoWidth": true
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
        });
        $('body').on('click','.btn-kirim-resi',function() {
        	html 	= `
        	<div id="preloaderSendWa" style="position:fixed;top:0;left:0;right:0;bottom:0;z-index:1500;background-color:rgba(0,0,0,.8);" class="p-5 text-center text-white">
				<div id="wait" style="text-align:center;padding:20px;width:100%;font-family:sans-serif">
					<h3>Proses Pengiriman Pesan Whatsapp Sedang Berlangsung</h3>
					<h5>Mohon Tunggu..</h5>
				</div>
        	</div>
        	`;
        	$('body').append(html);
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