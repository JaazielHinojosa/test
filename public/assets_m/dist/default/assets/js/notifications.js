$().ready(() => {
  countNotCheckedNots();
  initNotiListeners();
  deleteNoti();
  dropdownFix();
});

function initNotiListeners(){
  checkNotifications();
  var notifications = $("#nots .scroller").html();
  //Scroll Infinito. Cargar mas notificaciones al hacer scroll
  $("#nots").bind('slimscroll', function(e, pos){
    if(pos == "bottom"){
      $("#nots .scroller").append(notifications);
      deleteNoti();
      countNotCheckedNots();
      checkNotifications();
      var previous_pos = $('#nots .scroller').scrollTop();
      $('#nots .scroller').slimScroll({ scrollTo : (previous_pos-30) + 'px' }); // scrolls vertically
    };
   });
}

function checkNotifications(){
  $(".noti").click(function() {
    $(this).addClass("checked-noti");
    countNotCheckedNots();
  });
}

function countNotCheckedNots(){
  var notCheckedNots = $(".noti").not(".checked-noti").length;
  if(!notCheckedNots) $("#not-viewed-nots").fadeOut();
  $("#not-viewed-nots").html(notCheckedNots);
}

function deleteNoti(){
  $(".remove-not").click(function (){
    $(this).closest(".noti").attr("href","javascript:");
    $(this).closest(".noti").parent().fadeOut();
  });
}

//Evita que el dropdown de notificaciones se cierre al hacer click sobre él
function dropdownFix(){
  $(document).on('click', '.dropdown .dropdown-menu', function (e) {
    e.stopPropagation();
  });
}
