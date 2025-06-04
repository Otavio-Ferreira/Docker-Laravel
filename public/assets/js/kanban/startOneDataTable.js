$(document).ready(function () {
    var table = $('#dataTable').DataTable({
        info: false,
        ordering: false,
        paging: true,
        searching: true,
        autoWidth: false,
        scrollCollapse: false,
        border: false,
        lengthChange: false,
        pagingType: 'simple_numbers',
        language: {
            zeroRecords: " ",
            emptyTable: " ",
            paginate: {
                first: "Primeiro",
                last: "Último",
                next: "Próximo",
                previous: "Anterior"
            }
        }
    });

    $('#customFilter').on('keyup', function () {
        table.search(this.value).draw();
    });

    $('.customFilter').on('keyup', function () {
        table.search(this.value).draw();
    });
});