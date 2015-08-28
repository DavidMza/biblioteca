$(function () {
    var TallerAvanzada = {};
    var locacion = "http://" + window.location.host + "/biblioteca/";
    (function (app) {

        app.init = function () {
            app.bindings();
        };

        app.bindings = function () {
            $("#login-button").click(function (event) {
                event.preventDefault();
                app.login();
                /*setTimeout(function () {
                    window.location = "../index/index.html";
                }, 1500);*/

            });
        };

        app.login = function () {
            var url = locacion + "controladores/Ruteador.php";
            var datos = {};
            datos.formulario = "Login";
            datos.accion = "login";
            datos.seccion = "gestor";
            datos.usuario = $("#usuario").val();
            datos.clave = $.md5($("#pass").val());
            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',
                data: datos,
                success: function (data) {
                    sessionStorage.usuario = data.nombre;
                    sessionStorage.value = data.value;
                    sessionStorage.pass = data.pass;
                    $('form').fadeOut(500);
                    $('.wrapper').addClass('form-success');
                    setTimeout(function () {
                        window.location = "../index/index.html";
                    }, 1500);
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
        };

        app.init();

    })(TallerAvanzada);


});
