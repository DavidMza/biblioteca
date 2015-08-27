$(function () {
    var TallerAvanzada = {};
    var locacion = "http://" + window.location.host + "/biblioteca/";
    (function (app) {
        //"aca", ["Nombre", "Usuario"], "Usuario"
        var tabla = new Tabla({
            contenedor: "aca",
            cabecera: ["Nombre", "Usuario"],
            controlador: "Usuario"
        });
        app.init = function () {
            $("#liUsuario")[0].children[0].className = "active-menu";
            tabla.crearTabla();
            app.bindings();
        };

        app.bindings = function () {
            $("#guardar").on("click", function (event) {
                tabla.accion();
            });

            $("#btnReset").on("click", function (event) {
                if ($("#id").val() == 0) {
                    alert("No hay ningun usuario seleccionado");
                } else {
                    var url = locacion + "controladores/Ruteador.php";
                    var datos = {};
                    datos.formulario = "Usuario";
                    datos.accion = "reiniciarPass";
                    datos.seccion = "gestor";
                    datos.id = $("#id").val();
                    $.ajax({
                        url: url,
                        method: 'POST',
                        dataType: 'json',
                        data: datos,
                        success: function (data) {
                            if (data == 1) {
                                alert("Contraseña Reiniciada!!")
                            }
                        },
                        error: function (data) {
                            alert(data.responseText);
                        }
                    });
                }
            });
        };

        app.init();

    })(TallerAvanzada);


});
