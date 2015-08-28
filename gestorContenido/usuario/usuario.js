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
            tabla.crearABM();
            app.bindings();
        };

        app.bindings = function () {
            $("#guardar").on("click", function (event) {
                tabla.accion();
            });

            $("#btnReset").on("click", function (event) {
                if ($("#id").val() == 0) {
                    //alert("No hay ningun usuario seleccionado");
                    swal("Oops!", "No hay ningun usuario seleccionado", "warning");
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
                                //alert("Contraseña Reiniciada!!")
                                swal("Felicidades!", "Contraseña Reiniciada!!", "success");
                            }
                        },
                        error: function (data) {
                            //alert(data.responseText);
                            swal("Error!", data.responseText, "error");
                        }
                    });
                }
            });
        };

        app.init();

    })(TallerAvanzada);


});
