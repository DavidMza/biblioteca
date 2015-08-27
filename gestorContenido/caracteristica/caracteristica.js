$(function () {
    var TallerAvanzada = {};
    (function (app) {
        //"aca",["Denominacion"],"Caracteristica"
        var tabla = new Tabla({
            contenedor: "aca",
            cabecera: ["Denominacion"],
            controlador: "Caracteristica"
        });
        app.init = function () {
            if (sessionStorage.value == '2') {
                $("#log").html('<a href="log/logCaracteristica.html"> Ver Log de Caracteristicas</a>');
            }
            tabla.crearTabla();
            
            app.bindings();
        };

        app.bindings = function () {
            $("#guardar").on("click", function (event) {
                tabla.accion();
            });
        };

        app.init();

    })(TallerAvanzada);


});
