$().ready(() => {
  $("#invi-code-check").click(() => {
    $("#invi-code").toggle();
  });
  validateLogin();
  validateRegister();
  dismissAlerts();
});

function validateLogin() {
    var login_form = $("#login_form");
    login_form.validate({
        rules: {
            email: {
                required: !0
            },
            password: {
                required: !0
            }
        }
    });

    $("#btn-submit").click(function(i) {
      i.preventDefault();
      if(login_form.valid()) login_form.submit();
    });
}

function validateRegister() {
    var register_form = $("#register_form");
    register_form.validate({
        rules: {
            nombre: {
                required: !0
            },
            nombre_usuario: {
                required: !0
            },
            correo_electronico: {
                required: !0
            },
            contrasenia: {
                required: !0,
                minlength: 6
            },
            agree: {
                required: !0
            }
        }
    });

    $("#m_login_signup_submit").click(function(i) {
        i.preventDefault();
        if(register_form.valid()) register_form.submit();
    });
}

function dismissAlerts() {
    $(".m-link").click(function () {
        $(".alert").alert('close');
    })
}
