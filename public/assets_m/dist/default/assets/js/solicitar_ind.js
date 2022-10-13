$().ready(() => {
    initListeners();
});

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