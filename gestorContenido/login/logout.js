$(function () {
    var TallerAvanzada = {};
    var locacion = "http://" + window.location.host + "/biblioteca/";
    (function (app) {

        app.init = function () {
            if (!sessionStorage.usuario && !sessionStorage.value) {
                window.location = "../login/login.html";
            }
            if (sessionStorage.value == '2') {
                $("#liUsuario").html('<a href="../usuario/usuario.html" id="liuser"><i class="fa fa-user fa-3x"></i> Usuarios</a>');
            }
            if (sessionStorage.pass == '1') {
                alert("Bienvenido, Antes de continuar debe definir una Nueva Contraseña");
                sessionStorage.pass = '0';
                window.location = "../password/pass.html";
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
                    window.location = "../login/login.html";
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
        };

        app.init();

    })(TallerAvanzada);
});
