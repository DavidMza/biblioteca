$(function () {
    var TallerAvanzada = {};
    var locacion = "http://" + window.location.host + "/biblioteca/";
    (function (app) {

        app.init = function () {
            if (!sessionStorage.usuario && !sessionStorage.value) {
                window.location = "../login/login.html";
            }
            app.bindings();
        };

        app.bindings = function () {
            $("#btcambiar").on('click', function (event) {
                app.comprobarClaves();
            });
        };

        app.cambiar = function (passwordActual, pass) {

            var url = locacion + "controladores/Ruteador.php";
            var datos = {};
            datos.formulario = "Usuario";
            datos.accion = "cambiarPass";
            datos.seccion = "gestor";
            datos.user = sessionStorage.usuario;
            datos.claveActual = $.md5(passwordActual);
            datos.claveNueva = $.md5(pass);

            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',
                data: datos,
                success: function (data) {
                    if (data.bandera) {
                        app.limpiarModal();
                        $("#infoCambioPass").modal({show: true});
                        setTimeout(function () {
                            $("#infoCambioPass").modal("hide");
                        }, (2 * 1000));
                    } else {
                        alert(data.retorno);
                    }
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
        };

        app.limpiarModal = function (){
            $("#password").val("");
            $("#password1").val("");
            $("#password2").val("");
        };
        
        app.comprobarClaves = function () {
            var passwordActual = $("#password").val();
            var pass1 = $("#password1").val();
            var pass2 = $("#password2").val();
            if (pass1 == pass2) {
                if (pass1.length > 0 && passwordActual.length > 0) {
                    app.cambiar(passwordActual, pass1);
                } else {
                    alert("No has llenado los campos");
                }

            } else {
                alert("Las claves no coinciden");
            }
        };

        app.init();

    })(TallerAvanzada);
});
