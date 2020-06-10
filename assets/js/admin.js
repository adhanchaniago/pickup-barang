$(function() {
	let url 	= $('#data-admin').data('url');
    navbar_active();
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
    
})
