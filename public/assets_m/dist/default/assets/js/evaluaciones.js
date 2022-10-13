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
    flow += "reale=>start: Realizar evaluación\n",
        flow += "e=>end: Cerrar evaluación\n",
        flow += "reve=>condition: Revisar evaluación\n",
        flow += "ta=>inputoutput: Tomar acciones\n",
        flow += "reale(right)->reve\n",
        flow += "reve(yes, right)->e\n",
        flow += "reve(no)->ta(right)->e";
    let flow_diagram = flowchart.parse(flow);
    flow_diagram.drawSVG("flow",{
        'line-width': 2,
        'line-length': 70,
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