$(function () {
    var TallerAvanzada = {};
    (function (app) {
        //"aca",["Nombre"],"Autor"
        var tabla = new Tabla({
            contenedor: "aca",
            cabecera: ["Nombre"],
            controlador: "Autor"
        });
        app.init = function () {
            if (sessionStorage.value == '2') {
                $("#log").html('<a href="log/logAutor.html"> Ver Log de Autores</a>');
            }
            tabla.crearABM();
            
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
