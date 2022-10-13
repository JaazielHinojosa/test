//ready
$(function()
{

    countNotCheckedNots();
    initNotiListeners();
    setNotificationRead();

});//fin del ready

function setNotificationRead() {
    //marcamos como leida la notificacion a la que se le da click
    $('.notificacion').click(function(){
        var id = $(this).data('id');
        var url = base_url + 'notificaciones/update/'+id;
        $.get(url);

    });
}

function initNotiListeners(){
  checkNotifications();
  deleteNoti();
  //Scroll Infinito. Cargar mas notificaciones al hacer scroll
  //var notifications = $("#nots .m-list-timeline__items").html();
  $("#nots").on("scroll",function(){

      //el scroll llega al tope
      if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight-5) {
          $.ajax({
              type: "GET",
              url: base_url + 'obtenerNotificaciones/' + last_not,
              success : function(notifications) {
                  $("#nots .m-list-timeline__items").append(notifications);
                  deleteNoti();
                  countNotCheckedNots();
                  checkNotifications();
              }
          });//ajax

      }//llega al tope el scroll

   });
}

function checkNotifications(){
  $(".noti").click(function() {
    $(this).find(".m-list-timeline__badge").removeClass("-m-list-timeline__badge--state-success");
    countNotCheckedNots();
    countAllNots();
  });
}

function countNotCheckedNots(){
  var notCheckedNots = $(".-m-list-timeline__badge--state-success").length;
  if(!notCheckedNots){
    $(".m-dropdown__header-subtitle").fadeOut();
    $("#batch-nots").fadeOut();
  }
  else {
    $("#not-viewed-nots").html(notCheckedNots);
    $(".m-dropdown__header-subtitle").show();
    $("#batch-nots").fadeIn();
  }
}

function deleteNoti(){
  $(".remove-not").click(function (event){

    //eliminamos la notificacion
    event.preventDefault();
    var id  = $(this).data('id');
    var url = base_url + 'notificaciones/destroy/'+id;
    $.get(url);

    //quitamos los estilos para que los estilos del elemnto desaparezcan
    $(this).closest(".noti").attr("href","javascript:");
    $(this).closest(".m-list-timeline__item").fadeOut();
    $(this).closest(".noti").fadeOut();
    $(this).closest(".noti").addClass("removed");
  });
}

function countAllNots(){
  var removedNots = $(".noti.removed").length;
  var allNots = $(".noti").length;
  if(removedNots == allNots){
    $("#no-nots").show();
    $("#nots").hide();
  }
  else {
    $("#no-nots").hide();
    $("#nots").show();
  }
}
