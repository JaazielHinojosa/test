$().ready(() => {
    initListeners();
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
        colReorder: true,
        responsive: true,
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

function initListeners() {
    //stepHover();
}

function stepHover() {
    $(".mt-element-step").on('mouseover', () => {
        $(".step-title-layout").fadeIn();
    });

    $(".mt-element-step").on('mouseout', () => {
        $(".step-title-layout").fadeOut();
    });
}
