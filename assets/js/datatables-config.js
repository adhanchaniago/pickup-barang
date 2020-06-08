
$(document).ready(function () {
    $('#table_id').DataTable({
        "order": [],
        "pageLength" : 10,
        "lengthMenu" : [[10, 20, 50, -1], [10, 20, 50, 'All']]
    });
});
