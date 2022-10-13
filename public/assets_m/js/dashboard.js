$().ready(function() {
    initDashboardCalendar();
    initChart();
    initDateRangeInput();

    //evento para pedir los datos para la grafica
    $(".indicador-graph-link").click(function()
    {
        var nombreIndicador = $(this).find('.m-nav__link-text').text();

        //poner activa la opcion en el combo de indicadores
        $("#indicadores-dropdown-graphs .m-nav__item--active").removeClass("m-nav__item--active");
        $(this).closest(".m-nav__item").addClass("m-nav__item--active");

        //obtener el nombre del indicador seleccionado
        $('#nombreIndicador').html(nombreIndicador);

        //traer usuarios conectados
        $.ajax({
            type: "POST",
            url: base_url + 'graficas-index',
            data: {'fecha' : $('#date-chart').val(), 'indicadorId' : $(this).find('.indicadorId').val()},
            success:function(info){
                //asignamos la informacion para las graficas
                if(info.length > 0)
                {

                    datosGraficas = info;

                    //quitamos el hidden si es que lo tiene la grafica
                    $('#m_amcharts_2').removeClass('d-none');
                    //ocultamos el mensaje de que no hay indicadores
                    $('#sinRegistros').addClass('d-none');

                    //iniciamos la grafica
                    initChart();
                }else{
                    //agregamos hidden a las graficas
                    $('#m_amcharts_2').addClass('d-none');
                    //mostramos el mensaje de que no hay indicadores
                    $('#sinRegistros').removeClass('d-none');
                }
            }
        });//ajax

    });//fin de pedido para graficas

});//ready

function initDashboardCalendar() {
    //console.log(eventos);
  var e = moment().startOf("day")
          , t = e.format("YYYY-MM")
          , i = e.clone().subtract(1, "day").format("YYYY-MM-DD")
          , n = e.format("YYYY-MM-DD")
          , r = e.clone().add(1, "day").format("YYYY-MM-DD")
          , s = e.clone().add(1, "month").format("YYYY-MM-DD")
  $("#dashboard_cal").fullCalendar({
      monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
      monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun','Jul','Ago','Sep','Oct','Nov','Dic'],
      dayNames: ['Domingo','Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'],
      dayNamesShort: ['Dom','Lun','Mar','Mié','Jue','Vie','Sáb'],
      isRTL: mUtil.isRTL(),
      header: {
          left: "prev,next today",
          center: "title",
          right: "month,agendaWeek,agendaDay,listYear"
      },
      editable: !0,
      eventLimit: 1,
      navLinks: !0,
      displayEventTime: !1,
      events: eventos,
      eventRender: function(e, t) {
          var html = "<h4>";
          t.hasClass("fc-day-grid-event") ? (t.data("html",true),
          html += e.type.charAt(0).toUpperCase() + e.type.slice(1)+"</h4>",
          html += "<span class='m--font-bolder'>Titulo: </span>" + e.title + "<br>",
          e.horaInicio ? (html += "<span class='m--font-bolder'>Hora Inicio: </span>" + e.horaInicio + "<br>") : html+="",
          e.horaFin ? (html += "<span class='m--font-bolder'>Hora Fin: </span>" + e.horaFin + "<br>") : html+="",
          e.descripcion ? (html += "<span class='m--font-bolder'>Descripción: </span>" + e.descripcion + "<br>") : html+="",
          e.equipo ? (html += "<span class='m--font-bolder'>Equipo: </span>" + e.equipo + "<br>") : html+="",
          e.solicitante ? (html += "<span class='m--font-bolder'>Solicitante: </span>" + e.solicitante + "<br>") : html+="",
          e.alcance ? (html += "<span class='m--font-bolder'>Alcance: </span>" + e.alcance + "<br>") : html+="",
          e.autor ? (html += "<span class='m--font-bolder'>Autor: </span>" + e.autor + "<br>") : html+="",
          e.objetivo ? (html += "<span class='m--font-bolder'>Objetivo: </span>" + e.objetivo + "<br>") : html+="",
          e.costo ? (html += "<span class='m--font-bolder'>Costo: </span>$" + e.costo + "<br>") : html+="",
          e.responsable ? (html += "<span class='m--font-bolder'>Responsable: </span>" + e.responsable + "<br>") : html+="",
          e.situacion_deseada ? (html += "<span class='m--font-bolder'>Situación deseada: </span>" + e.situacion_deseada + "<br>") : html+="",
          e.asistentes ? (html += "<span class='m--font-bolder'>Asistententes: </span><br>" + formatAsistentes(e.asistentes)) : html+="",
          e.comentarios ? (html += "<span class='m--font-bolder'>Comentarios: </span>" + e.comentarios + "<br>") : html+="",
          e.lugar ? (html += "<span class='m--font-bolder'>Lugar: </span>" + e.lugar + "<br>") : html+="",
          e.tipoJunta ? (html += "<span class='m--font-bolder'>Tipo de junta: </span>" + e.tipoJunta + "<br>") : html+="",
          e.institucion ? (html += "<span class='m--font-bolder'>Institución: </span>" + e.institucion + "<br>") : html+="",
          t.data("content", html),
          t.data("placement", "top"),
          mApp.initPopover(t)) : t.hasClass("fc-time-grid-event") ? t.find(".fc-title").append('<div class="fc-description">' + e.type + "</div>") : 0 !== t.find(".fc-list-item-title").lenght && t.find(".fc-list-item-title").append('<div class="fc-description">' + e.type + "</div>")
      },
      buttonText: {
        today:    'Hoy',
        month:    'Mes',
        week:     'Semana',
        day:      'Día',
        list:     'Lista'
      }
  })
}

function formatAsistentes(asistentes){
    var html = "<ul>";
    $.each(asistentes, function (index, asistente) {
        html+="<li>"+asistente+"</li>"
    });
    html += "</ul>";
    return html;
}

function initChart(){
  AmCharts.makeChart("m_amcharts_2", {
      rtl: mUtil.isRTL(),
      type: "serial",
      addClassNames: !0,
      theme: "light",
      autoMargins: !1,
      marginLeft: 30,
      marginRight: 8,
      marginTop: 10,
      marginBottom: 26,
      balloon: {
          adjustBorderColor: !1,
          horizontalPadding: 10,
          verticalPadding: 8,
          color: "#ffffff"
      },
      dataProvider:
      datosGraficas
      /*[{
          month: "Enero",
          reachedGoal: Math.floor((Math.random() * 100)),
          minGoal: Math.floor((Math.random() * 100)),
          maxGoal: Math.floor((Math.random() * 100))
      }*/,
      valueAxes: [{
          axisAlpha: 0,
          position: "left"
      }],
      startDuration: 1,
      graphs: [{
          alphaField: "alpha",
          balloonText: "<span style='font-size:12px;'>[[title]] en [[category]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
          fillAlphas: 1,
          title: "Meta alcanzada",
          type: "column",
          valueField: "reachedGoal",
          dashLengthField: "dashLengthColumn",
          "showAllValueLabels":true   /// add this line
      }, {
          id: "graph2",
          balloonText: "<span style='font-size:12px;'>[[title]] en [[category]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
          bullet: "round",
          lineThickness: 3,
          bulletSize: 7,
          bulletBorderAlpha: 1,
          bulletColor: "#FFFFFF",
          useLineColorForBulletBorder: !0,
          bulletBorderThickness: 3,
          fillAlphas: 0,
          lineAlpha: 1,
          title: "Meta mínima",
          valueField: "minGoal",
          dashLengthField: "dashLengthLine"
      }, {
          id: "graph3",
          balloonText: "<span style='font-size:12px;'>[[title]] en [[category]]:<br><span style='font-size:20px;'>[[value]]</span> [[additional]]</span>",
          bullet: "round",
          lineThickness: 3,
          bulletSize: 7,
          bulletBorderAlpha: 1,
          bulletColor: "#FFFFFF",
          useLineColorForBulletBorder: !0,
          bulletBorderThickness: 3,
          fillAlphas: 0,
          lineAlpha: 1,
          title: "Meta máxima",
          valueField: "maxGoal",
          dashLengthField: "dashLengthLine"
      }],
      categoryField: "month",
      categoryAxis: {
          gridPosition: "start",
          axisAlpha: 0,
          tickLength: 0
      },
      "marginLeft": 60,
      "export": {
                "enabled": true,
                "menu": [ {
                    "class": "export-main",
                    "menu": [ "CSV", "PDF"]
                } ]
            }
  });
}

function initDateRangeInput(){
  var a = moment().subtract(30, "days"), t = moment();
  $("#m_daterangepicker_6 .form-control").val(a.format("DD/MM/YYYY") + " / " + t.format("DD/MM/YYYY"))
  $("#m_daterangepicker_6").daterangepicker({
      locale: {
          "applyLabel": "Aplicar",
          "cancelLabel": "Cancelar",
          "customRangeLabel": "Rango de fechas",
          "daysOfWeek": [
              "Do",
              "Lu",
              "Ma",
              "Mi",
              "Ju",
              "Vi",
              "Sa"
          ],
          "monthNames": [
              "Ene",
              "Feb",
              "Mar",
              "Abr",
              "May",
              "Jun",
              "Jul",
              "Ago",
              "Sep",
              "Oct",
              "Nov",
              "Dic"
          ]
      },
      buttonClasses: "m-btn btn",
      applyClass: "btn-info",
      cancelClass: "btn-secondary",
      startDate: a,
      endDate: t,
      opens: 'left',
      ranges: {
          "Últimos 7 Días": [moment().subtract(6, "days"), moment()],
          "Últimos 30 Días": [moment().subtract(29, "days"), moment()],
          "Este mes": [moment().startOf("month"), moment().endOf("month")],
          "Mes pasado": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")]
      }
  }, function(a, t, n) {
      $("#m_daterangepicker_6 .form-control").val(a.format("DD/MM/YYYY") + " / " + t.format("DD/MM/YYYY"))
  });
  $("#m_daterangepicker_6").on('apply.daterangepicker', () => { initChart(); });
}
