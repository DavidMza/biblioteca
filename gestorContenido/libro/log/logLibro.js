$(function () {
    var TallerAvanzada = {};
    (function (app) {
        //"aca",["Fecha","Hora","Autor","Usuario","Accion"],"LogAutor",false
        var tabla = new Tabla({
            contenedor: "aca",
            cabecera: ["Fecha","Hora","Libro","Usuario","Accion"],
            controlador: "LogLibro",
            verEditar: false,
            verEliminar: false,
            verSeleccionar: false
        });
        app.init = function () {
            tabla.crearTabla();
        };

        app.init();

    })(TallerAvanzada);


});
