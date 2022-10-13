$().ready(() => {
    initDataTable();
});

function initDataTable() {
    var table = $('#general-table');
    var otable = table.DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
        },
        buttons: [
            { extend: 'pdf', className: 'btn blue btn-outline', text: "<i class=\"glyphicon glyphicon-file\"></i> PDF", exportOptions: { columns: [ 0, 1, 2 , 3, 4 ] } },
            { extend: 'csv', className: 'btn blue btn-outline', text: "<i class=\"glyphicon glyphicon-save\"></i> CSV", exportOptions: { columns: [ 0, 1, 2 , 3, 4 ] } },
            { extend: 'colvis', className: 'btn blue btn-outline', text: "<i class=\"glyphicon glyphicon-th-list\"></i> Columnas"}
        ],
        drawCallback: function(a) {
            var e = this.api()
              , t = e.rows({
                page: "current"
            }).nodes()
              , n = null;
            e.column(11, {
                page: "current"
            }).data().each(function(a, e) {
                n !== a && ($(t).eq(e).before('<tr class="group"><td colspan="12">' + a + '<a href="/evaluaciones-indicadores" class="ml-1 pull-right btn m-btn--pill m-btn--air btn-outline-accent btn-sm m-btn m-btn--outline-2x ">Guardar</a>' + "</td></tr>"),
                n = a);
            })
        },
        colReorder: true,
        responsive: true,
        columnDefs: [{
            targets: [11],
            visible: !1
        }],
        "order": [
            [0, 'asc']
        ],
        "lengthMenu": [
            [5, 10, 15, 20, -1],
            [5, 10, 15, 20, "Mostrar todo"]
        ],
        "pageLength": 5,
        "dom": "<'row'<'col-sm-6 text-left'f><'col-sm-6 text-right'B>>\n\t\t\t<'row'<'col-sm-12'tr>>\n\t\t\t<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
    });
    otable.on("change", ".m-group-checkable", function() {
         var e = $(this).closest("table").find("td:first-child .m-checkable")
           , a = $(this).is(":checked");
         $(e).each(function() {
             a ? ($(this).prop("checked", !0),
             $(this).closest("tr").addClass("active")) : ($(this).prop("checked", !1),
             $(this).closest("tr").removeClass("active"))
         })
     }),
     otable.on("change", "tbody tr .m-checkbox", function() {
         $(this).parents("tr").toggleClass("active")
     })
}
