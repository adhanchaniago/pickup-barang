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
    jenisLayanan();
    jenisPaket();
    pengirim();
    penerima();
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

    function pickupBarang() {
        let modal       = '#pickupBarangModal';
        $('#table_id').on('click','.btn-edit-pickupBarang',function(e){
            e.preventDefault();
            $(modal).modal('show');

            let id_pickup_barang   = $(this).data('id');
            $.ajax({
                url         : url + 'pickupBarang/getPickupBarangById',
                method      : 'post',
                data        : {id_pickup_barang : id_pickup_barang},
                dataType    : 'json',
                success     : function(response) {
                    $(modal + ' #label').html('Ubah Pickup Barang - ' + response.no_resi);
                    $(modal + ' #no_resi').val(response.no_resi);
                    $(modal + ' #id_pengirim').val(response.id_pengirim).trigger('change');
                    $(modal + ' #id_penerima').val(response.id_penerima).trigger('change');
                    $(modal + ' #id_layanan_paket').val(response.id_layanan_paket).trigger('change');
                    $(modal + ' #nama_barang').val(response.nama_barang);
                    $(modal + ' #berat_barang').val(response.berat_barang);
                    $(modal + ' #jumlah_barang').val(response.jumlah_barang);
                    $(modal + ' #tanggal_pemesanan').val(response.tanggal_pemesanan);
                    $(modal + ' #tanggal_penjemputan').val(response.tanggal_penjemputan);
                    $(modal + ' #tanggal_masuk_logistik').val(response.tanggal_masuk_logistik);
                    $(modal + ' #id_pickup_barang').val(response.id_pickup_barang).trigger('change');
                    $(modal + ' #status').val(response.status);
                }
            })
        });
        $('.btn-tambah-pickupBarang').on('click',function(e) {
            e.preventDefault();
            $(modal).modal('show');
            $(modal+ ' #label').html('Tambah Pickup Barang');
            $(modal+ ' #reset').click();
        })
    }

    function layanan() {
        let modal   = '#layananPaketModal';
        $('#table_id').on('click','.btn-edit-layananPaket',function(e){
            e.preventDefault();
            $(modal).modal('show');
            $(modal + ' #label').html('Ubah Layanan Paket');
            let id_layanan_paket   = $(this).data('id');
            $.ajax({
                url         : url + 'layananPaket/getLayananPaketById',
                method      : 'post',
                data        : {id_layanan_paket : id_layanan_paket},
                dataType    : 'json',
                success     : function(response) {
                    $(modal + ' #id_layanan_paket').val(response.id_layanan_paket);
                    $(modal + ' #harga').val(response.harga);
                    $(modal + ' #durasi_pengiriman').val(response.durasi_pengiriman);
                    $(modal + ' #id_jenis_paket').val(response.id_jenis_paket).trigger('change');
                    $(modal + ' #id_jenis_layanan').val(response.id_jenis_layanan).trigger('change');
                    $(modal + ' #id_provinsi_asal').val(response.prov_asal).trigger('change');
                    $(modal + ' #id_provinsi_tujuan').val(response.prov_tujuan).trigger('change');
                    let intKab  = setInterval(function() {
                        let kab_asal    = $(modal + ' #id_kabupaten_asal')[0];
                        let kab_tujuan  = $(modal + ' #id_kabupaten_tujuan')[0];
                        if (kab_asal.length > 2 && kab_tujuan.length > 2) {
                            clearInterval(intKab);
                            $(modal + ' #id_kabupaten_asal').val(response.kab_asal).trigger('change');
                            $(modal + ' #id_kabupaten_tujuan').val(response.kab_tujuan).trigger('change');
                            let intKec  = setInterval(function() {
                                let kec_asal    = $(modal + ' #id_kecamatan_asal')[0];
                                let kec_tujuan  = $(modal + ' #id_kecamatan_tujuan')[0];
                                if (kec_asal.length > 2 && kec_tujuan.length > 2) {
                                    $(modal + ' #id_kecamatan_asal').val(response.kec_asal).trigger('change');
                                    $(modal + ' #id_kecamatan_tujuan').val(response.kec_tujuan).trigger('change');
                                    clearInterval(intKec);
                                }
                            },1000);
                        }
                    },500);
                }
            })
        });

        $(modal).on('change','#id_provinsi_asal',function() {
            let id_provinsi     = $(this).val();
            selectKabupaten(id_provinsi,modal + ' #id_kabupaten_asal');
            setTimeout(function() {
                let id_kabupaten     = $(modal + ' #id_kabupaten_asal').val();
                selectKecamatan(id_kabupaten,modal + ' #id_kecamatan_asal');
            },1000);
        });

        $(modal).on('change','#id_provinsi_tujuan',function() {
            let id_provinsi     = $(this).val();
            selectKabupaten(id_provinsi,modal + ' #id_kabupaten_tujuan');
            setTimeout(function() {
                let id_kabupaten     = $('#id_kabupaten_tujuan').val();
                selectKecamatan(id_kabupaten,modal + ' #id_kecamatan_tujuan');
            },1000);
        });

        $(modal).on('change','#id_kabupaten_asal',function() {
            let id_kabupaten     = $(this).val();
            selectKecamatan(id_kabupaten,modal + ' #id_kecamatan_asal');
        });

        $(modal).on('change','#id_kabupaten_tujuan',function() {
            let id_kabupaten     = $(this).val();
            selectKecamatan(id_kabupaten,modal + ' #id_kecamatan_tujuan');
        });

        $('.btn-tambah-layananPaket').on('click',function(e) {
            e.preventDefault();
            $(modal).modal('show');
            $(modal+ ' #reset').click();
            $(modal + ' #label').html('Tambah Layanan Paket');
            $(modal + ' select').val('').trigger('change');
            $(modal + ' #id_kabupaten_asal').html('');
            $(modal + ' #id_kabupaten_tujuan').html('');
            $(modal + ' #id_kecamatan_asal').html('');
            $(modal + ' #id_kecamatan_tujuan').html('');
        })
    }


    function jabatan() {
        let modal       = '#jabatanModal';
        $('#table_id').on('click','.btn-edit-jabatan',function(e){
            e.preventDefault();
            $(modal).modal('show');

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
            e.preventDefault();
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

    function jenisPaket() {
        let modal       = '#jenisPaketModal';
        $('#table_id').on('click','.btn-edit-jenisPaket',function(e) {
            e.preventDefault();
            let id_jenis_paket     = $(this).data('id');
            $(modal).modal('show');

            $.ajax({
                url         : url + 'jenisPaket/getJenisPaketById',
                method      : 'post',
                dataType    : 'json',
                data        : {id_jenis_paket : id_jenis_paket},
                success     : function(response) {
                    $(modal+ ' #label').html('Edit Jenis Paket - '+response.jenis_paket);
                    $(modal+' #id_jenis_paket').val(response.id_jenis_paket);
                    $(modal+' #jenis_paket').val(response.jenis_paket);
                }
            })
        })
        $('.btn-tambah-jenisPaket').on('click',function(e) {
            e.preventDefault();
            $(modal).modal('show');
            $(modal+ ' #label').html('Tambah Jenis Paket');
            $(modal+ ' #reset').click();
        })
    }

    function provinsi() {
        let modal       = '#provinsiModal';
        $('#table_id').on('click','.btn-edit-provinsi',function(e) {
            e.preventDefault();
            let id_provinsi     = $(this).data('id');
            $(modal).modal('show');

            $.ajax({
                url         : url + 'provinsi/getProvinsiById',
                method      : 'post',
                dataType    : 'json',
                data        : {id_provinsi : id_provinsi},
                success     : function(response) {
                    $(modal+ ' #label').html('Edit Provinsi - '+response.nama_provinsi);
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
            $.ajax({
                url         : url + 'kabupaten/getKabupatenById',
                method      : 'post',
                dataType    : 'json',
                data        : {id_kabupaten : id_kabupaten},
                success     : function(response) {
                    $(modal+ ' #label').html('Edit Kabupaten - '+response.nama_kabupaten);
                    $(modal+' #id_provinsi').val(response.id_provinsi).select().trigger('change');
                    $(modal+' #id_kabupaten').val(response.id_kabupaten).trigger('change');
                    $(modal+' #nama_kabupaten').val(response.nama_kabupaten);
                }
            })
        })
        $('.btn-tambah-kabupaten').on('click',function(e) {
            e.preventDefault();
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
            $.ajax({
                url         : url + 'kecamatan/getKecamatanById',
                method      : 'post',
                dataType    : 'json',
                data        : {id_kecamatan : id_kecamatan},
                success     : function(response) {
                    $(modal+ ' #label').html('Edit Kecamatan - '+response.nama_kecamatan);
                    selectKabupaten(response.id_provinsi,modal+' #id_kabupaten',response.id_kabupaten);
                    $(modal+' #id_provinsi').val(response.id_provinsi).select().trigger('change');
                    $(modal+' #id_kecamatan').val(response.id_kecamatan).trigger('change');
                    $(modal+' #nama_kecamatan').val(response.nama_kecamatan);
                }
            })
        })
        $(modal+' #id_provinsi').on('change',function() {
            let id_provinsi     = $(this).val();
            selectKabupaten(id_provinsi,modal+' #id_kabupaten');
        })

        $('.btn-tambah-kecamatan').on('click',function(e) {
            e.preventDefault();
            $(modal).modal('show');
            $(modal+ ' #label').html('Tambah Kecamatan');
            $(modal+ ' #reset').click();
        })
    }

    function penerima() {
        let modal       = '#penerimaModal';
        $('#table_id').on('click','.btn-edit-penerima',function(e){
            e.preventDefault();
            $(modal).modal('show');

            let id_penerima   = $(this).data('id');
            $.ajax({
                url         : url + 'penerima/getPenerimaById',
                method      : 'post',
                data        : {id_penerima : id_penerima},
                dataType    : 'json',
                success     : function(response) {
                    $(modal + ' #label').html('Ubah Penerima - ' + response.nama_penerima);
                    $(modal + ' #nama_penerima').val(response.nama_penerima);
                    $(modal + ' #no_wa_penerima').val(response.no_wa_penerima);
                    $(modal + ' #alamat_penerima').val(response.alamat_penerima);
                    $(modal + ' #id_penerima').val(response.id_penerima);
                    $(modal + ' #id_provinsi').val(response.prov).trigger('change');
                    let intKab  = setInterval(function() {
                        let kab    = $(modal + ' #id_kabupaten')[0];
                        if (kab.length > 2) {
                            clearInterval(intKab);
                            $(modal + ' #id_kabupaten').val(response.kab).trigger('change');
                            let intKec  = setInterval(function() {
                                let kec    = $(modal + ' #id_kecamatan')[0];
                                if (kec.length > 2) {
                                    $(modal + ' #id_kecamatan').val(response.kec).trigger('change');
                                    clearInterval(intKec);
                                }
                            },1000);
                        }
                    },500);
                }
            });
        });
        
        $(modal + ' #id_provinsi').on('change',function() {
            let id_provinsi     = $(this).val();
            selectKabupaten(id_provinsi,modal + ' #id_kabupaten');
            setTimeout(function() {
                let id_kabupaten     = $(modal + ' #id_kabupaten').val();
                selectKecamatan(id_kabupaten,modal + ' #id_kecamatan');
            },1000);
        });
        
        $(modal + ' #id_kabupaten').on('change',function() {
            let id_kabupaten     = $(this).val();
            selectKecamatan(id_kabupaten,modal + ' #id_kecamatan');
        });

        $('.btn-tambah-penerima').on('click',function(e) {
            e.preventDefault();
            $(modal).modal('show');
            $(modal+ ' #label').html('Tambah Penerima');
            $(modal+ ' #reset').click();
        })
    }


    function pengirim() {
        let modal       = '#pengirimModal';
        $('#table_id').on('click','.btn-edit-pengirim',function(e){
            e.preventDefault();
            $(modal).modal('show');

            let id_pengirim   = $(this).data('id');
            $.ajax({
                url         : url + 'pengirim/getPengirimById',
                method      : 'post',
                data        : {id_pengirim : id_pengirim},
                dataType    : 'json',
                success     : function(response) {
                    $(modal + ' #label').html('Ubah Pengirim - ' + response.nama_pengirim);
                    $(modal + ' #nama_pengirim').val(response.nama_pengirim);
                    $(modal + ' #no_wa_pengirim').val(response.no_wa_pengirim);
                    $(modal + ' #alamat_pengirim').val(response.alamat_pengirim);
                    $(modal + ' #id_pengirim').val(response.id_pengirim);
                    $(modal + ' #id_provinsi').val(response.prov).trigger('change');
                    let intKab  = setInterval(function() {
                        let kab    = $(modal + ' #id_kabupaten')[0];
                        if (kab.length > 2) {
                            clearInterval(intKab);
                            $(modal + ' #id_kabupaten').val(response.kab).trigger('change');
                            let intKec  = setInterval(function() {
                                let kec    = $(modal + ' #id_kecamatan')[0];
                                if (kec.length > 2) {
                                    $(modal + ' #id_kecamatan').val(response.kec).trigger('change');
                                    clearInterval(intKec);
                                }
                            },1000);
                        }
                    },500);
                }
            });
        });
        
        $(modal + ' #id_provinsi').on('change',function() {
            let id_provinsi     = $(this).val();
            selectKabupaten(id_provinsi,modal + ' #id_kabupaten');
            setTimeout(function() {
                let id_kabupaten     = $(modal + ' #id_kabupaten').val();
                selectKecamatan(id_kabupaten,modal + ' #id_kecamatan');
            },1000);
        });
        
        $(modal + ' #id_kabupaten').on('change',function() {
            let id_kabupaten     = $(this).val();
            selectKecamatan(id_kabupaten,modal + ' #id_kecamatan');
        });

        $('.btn-tambah-pengirim').on('click',function(e) {
            e.preventDefault();
            $(modal).modal('show');
            $(modal+ ' #label').html('Tambah Pengirim');
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
            url         : url + 'kecamatan/getKecamatanByKabupaten',
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
