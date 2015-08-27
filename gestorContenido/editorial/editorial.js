$(function () {
    var TallerAvanzada = {};
    (function (app) {
        //"aca",["Nombre"],"Editorial"
        var tabla = new Tabla({
            contenedor: "aca",
            cabecera: ["Nombre"],
            controlador: "Editorial"
        });
        app.init = function () {
            if (sessionStorage.value == '2') {
                $("#log").html('<a href="log/logEditorial.html"> Ver Log de Editoriales</a>');
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
