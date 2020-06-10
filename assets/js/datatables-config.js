
$(function () {

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

});
