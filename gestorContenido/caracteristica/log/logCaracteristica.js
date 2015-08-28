$(function () {
    var TallerAvanzada = {};

    (function (app) {
        //"aca",["Fecha","Hora","Caracteristica","Usuario","Accion"],"LogCaracteristicas",false
        var tabla = new Tabla({
            contenedor: "aca",
            cabecera: ["Fecha","Hora","Caracteristica","Usuario","Accion"],
            controlador: "LogCaracteristicas",
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
