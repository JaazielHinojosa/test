$().ready(() => {
    initDataTable();
    initDateInputs();
    initRepeater();
});

function initDataTable() {
    var table = $('#general-table');
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
        "pageLength": 5,
        "dom": "<'row'<'col-sm-6 text-left'f><'col-sm-6 text-right'B>>\n\t\t\t<'row'<'col-sm-12'tr>>\n\t\t\t<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>",
    });
}

function initDateInputs(){
    var date_input=$('.date');
    var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
    var options={
        language: 'es',
        format: 'dd/mm/yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true
    };
    date_input.datepicker(options);
}

function initRepeater() {
    $('#anexos').repeater({
        show: function () {
            $(this).slideDown();
            var this_dropzone = $(this).find('.dropzone')[0];
            initSingleDropzone(this_dropzone);
        },
        hide: function (deleteElement) {
            $(this).slideUp(deleteElement);
        },
        isFirstItemUndeletable: true
    });
    $('#acciones-c-tomadas').repeater({
        show: function () {
          initDateInputs();
            $(this).slideDown();
        },
        hide: function (deleteElement) {
            $(this).slideUp(deleteElement);
        },
        isFirstItemUndeletable: true
    });

    initDropzones();
}

function initDropzones(){
    if($("div.dropzone-wits").length){
        Dropzone.autoDiscover = false;
        var dropzone = new Dropzone("div.dropzone-wits",{
            url: "http://localhost:8000/upload",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            acceptedFiles: "image/*,video/*",
            maxFiles: 1,
            maxFilesize: 1500000, // MB
            maxfilesexceeded: function(file) {
                this.removeAllFiles();
                this.addFile(file);
            },
            processing: function (file) {
                $(this).closest(".url").val("");
            },
            paramName: "file",
            success: function(file,response) {
              $(this).closest(".url").val(response.filename);
              alert('success');
            },
            error: function (file,err) {
                this.removeAllFiles();
            }
        });
    }
}

function initSingleDropzone(elem) {
  Dropzone.autoDiscover = false;
  var dropzone = new Dropzone($(elem)[0],{
      url: "http://localhost:8000/upload",
      headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
      acceptedFiles: "image/*,video/*",
      maxFiles: 1,
      maxFilesize: 1500000, // MB
      maxfilesexceeded: function(file) {
          this.removeAllFiles();
          this.addFile(file);
      },
      processing: function (file) {
          $(this).closest(".url").val("");
      },
      paramName: "file",
      success: function(file,response) {
        $(this).closest(".url").val(response.filename);
      },
      error: function (file,err) {
      }
  });
  $(elem).find(".dropzone-message-custom").text("Arrastra archivo aquí o click para cargar");
}
