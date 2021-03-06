$(document).ready(function() {

    if ($('#role-datatable').length) {
        $('#role-datatable').DataTable({
            "language": {
                "url": "/public/js/datatables/json/es.json"
            },
            "columnDefs": [{
                "orderable": false,
                "targets": 4
            }],
            "orderable": false,
            "order": [
                [0, 'asc'],
                [1, 'asc'],
                [2, 'asc'],
                [3, 'asc']
            ],
            "responsive": true
        });
    }


    if ($(".delete-role").length) {

        $(".delete-role").on('click', function(event) {
            var role = $(this).data('role');
            var roleId = $(this).data('id');
            $("#modal-delete").modal();
            $("#modal-delete > p#user_delete").text('');
            $("#role_delete").text(role);
            $("#modal-delete").find('form').attr('action', window.location.href + '/' + roleId);
            event.preventDefault();
            /* Act on the event */
        });

    }

});
