$().ready(() => {
  $("#invoice").one('click', () => {
    initDataTable();
  })
});

function initDataTable() {
    var table = $('#invoices-table');
    table.DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
        buttons: [
            { extend: 'pdf', className: 'btn blue btn-outline', text: "<i class=\"glyphicon glyphicon-file\"></i> PDF", exportOptions: { columns: [ 0, 1, 2 , 3, 4 ] } },
            { extend: 'csv', className: 'btn blue btn-outline', text: "<i class=\"glyphicon glyphicon-save\"></i> CSV", exportOptions: { columns: [ 0, 1, 2 , 3, 4 ] } },
            { extend: 'colvis', className: 'btn blue btn-outline', text: "<i class=\"glyphicon glyphicon-th-list\"></i> Columnas"}
        ],
        colReorder: true,
        responsive: true,
        "order": [
            [0, 'asc']
        ],
        "lengthMenu": [
            [5, 10, 15, 20, -1],
            [5, 10, 15, 20, "Mostrar todo"]
        ],
        "pageLength": 15,
        "dom": "<'row'<'col-sm-6 text-left'f><'col-sm-6 text-right'B>>\n\t\t\t<'row'<'col-sm-12'tr>>\n\t\t\t<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
    });
}
