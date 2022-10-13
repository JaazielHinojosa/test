$().ready(() => {
    initFlow();
    initListeners();
});

function initListeners() {
    adjustSVGText();
    stepHover();
}

function initFlow() {
    let flow = "";
    flow += "solin=>start: Solicitar indicadores\n",
        flow += "e=>end: Cerrar evaluación\n",
        flow += "regin=>inputoutput: Registrar indicadores\n",
        flow += "revin=>condition: Revisar indicadores\n",
        flow += "segacc=>inputoutput: Seguimiento a acciones\n",
        flow += "revacc=>condition: Revisar acciones\n",
        flow += "solin(right)->regin\n",
        flow += "regin(right)->revin\n",
        flow += "revin(yes, right)->e\n",
        flow += "revin(no)->segacc(right)->revacc\n";
        flow += "revacc(yes, right)->e\n";
        flow += "revacc(no)->segacc";
    let flow_diagram = flowchart.parse(flow);
    flow_diagram.drawSVG("flow",{
        'line-width': 2,
        'line-length': 20,
        'scale': 1,
        'element-color': '#2F353B',
        'font-color': '#2F353B',
        'line-color': '#67809F',
        'yes-text': 'Aprobado',
        'no-text': 'Reprobado',
        'symbols' : {
            'condition' : {
                "element-color" : "#2F353B",
                "font-color" : "#2F353B"
            }
        }
    });
}

function adjustSVGText() {
    $("#reve").next().attr("x", 55);
    $("#ta").next().attr("x", 32);
    $("svg").css("padding",20);
}

function stepHover() {
    $("#realev-step").on('mouseover', () => {
        $('#reale').pulsate({
            color: "#2F353B",
            repeat: 1,
            glow: true
        });
    });

    $("#revev-step").on('mouseover', () => {
        $('#reve').pulsate({
            color: "#2F353B",
            repeat: 1,
            glow: true
        });
    });

    $("#ta-step").on('mouseover', () => {
        $('#ta').pulsate({
            color: "#2F353B",
            repeat: 1,
            glow: true
        });
    });

    $("#cerrar-step").on('mouseover', () => {
        $('#e').pulsate({
            color: "#2F353B",
            repeat: 1,
            glow: true
        });
    });
}