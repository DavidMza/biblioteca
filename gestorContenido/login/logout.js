$(function () {
    var TallerAvanzada = {};
    var locacion = "http://" + window.location.host + "/biblioteca/";
    (function (app) {

        app.init = function () {
            if (!sessionStorage.usuario && !sessionStorage.value) {
                window.location = locacion + "gestorContenido/login/login.html";
            }
            if (sessionStorage.value == '2') {
                $("#liUsuario").html('<a href="' + locacion + 'gestorContenido/usuario/usuario.html"><i class="fa fa-user fa-3x"></i> Usuarios</a>');
            }
            if (sessionStorage.pass == '1') {
                //alert("Bienvenido, Antes de continuar debe definir una Nueva Contraseña");
                //swal("Bienvenido!", "Antes de continuar deberia cambiar su contraseña", "warning");
                swal({
                    title: "Bienvenido!",
                    text: "Antes de continuar deberia cambiar su contraseña",
                    type: "info",
                    showCancelButton: false,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                },
                        function () {
                            setTimeout(function () {
                                sessionStorage.pass = '0';
                                window.location = locacion + "gestorContenido/password/pass.html";
                            }, 2000);
                        });
                //sessionStorage.pass = '0';
                //window.location = locacion + "gestorContenido/password/pass.html";
            }
            app.bindings();
            $("#nombre_usuario").html('<i class="fa fa-user"></i>' + sessionStorage.usuario + '');
        };

        app.bindings = function () {
            $("#logout-button").click(function (event) {
                app.logout();
            });

        };

        app.logout = function () {
            var url = locacion + "controladores/Ruteador.php";
            var datos = {};
            datos.formulario = "Login";
            datos.accion = "logout";
            datos.seccion = "gestor";
            datos.usuario = sessionStorage.usuario;
            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',
                data: datos,
                success: function (data) {
                    sessionStorage.clear();
                    window.location = locacion + "gestorContenido/login/login.html";
                },
                error: function (data) {
                    //alert(data.responseText);
                    swal("Error!", data.responseText, "error");
                }
            });
        };

        app.init();

    })(TallerAvanzada);
});
