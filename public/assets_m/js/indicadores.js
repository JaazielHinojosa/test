//ready
$(function(){

    //ocultamos la seccion de las graficas
    $('#myChart').hide();

    $('#buscarIndicador').click(function(){
        //$('#fecha_inicio').val() $('#fecha_fin').val()

        //fechas
        var fechas = {'inicio' : $('#fecha_inicio').val(), 'final' : $('#fecha_fin').val()};

        if(fechas['inicio'] != '' && fechas['final'] != '')
        {
            var myChart = $("#graficaIndicador").offset().top;
            $("html,body").animate({scrollTop: myChart});

            //obtener la informacion en base a las fechas
            $.ajax({
                type: "POST",
                url: base_url + 'graficas-index',
                data: {'fecha' : fechas, 'indicadorId' : indicadorId},
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
            });
        }
    })

});//fin ready

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
            dashLengthField: "dashLengthColumn"
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
