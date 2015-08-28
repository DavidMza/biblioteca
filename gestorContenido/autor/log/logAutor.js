$(function () {
    var TallerAvanzada = {};
    (function (app) {
        //"aca",["Fecha","Hora","Autor","Usuario","Accion"],"LogAutor",false
        var tabla = new Tabla({
            contenedor: "aca",
            cabecera: ["Fecha","Hora","Autor","Usuario","Accion"],
            controlador: "LogAutor",
            verEditar: false,
            verEliminar: false,
            verSeleccionar: false
        });
        app.init = function () {
            tabla.crearCabeceraTabla();
            tabla.listar();
        };

        app.init();

    })(TallerAvanzada);


});
