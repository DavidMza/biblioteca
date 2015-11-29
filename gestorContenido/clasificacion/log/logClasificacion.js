$(function () {
    var TallerAvanzada = {};

    (function (app) {
        //"aca",["Fecha","Hora","Clasificacion","Usuario","Accion"],"LogClasificacion",false
        var tabla = new Tabla({
            contenedor: "aca",
            cabecera: ["Fecha","Hora","Nombre","Usuario","Accion"],
            controlador: "Clasificacion",
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
