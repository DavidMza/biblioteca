$(function () {
    var TallerAvanzada = {};
    (function (app) {
        //"aca",["Fecha","Hora","Autor","Usuario","Accion"],"LogAutor",false
        var tabla = new Tabla({
            contenedor: "aca",
            cabecera: ["Fecha","Hora","Nombre","Usuario","Accion"],
            controlador: "Libro",
            esLog: true,
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
