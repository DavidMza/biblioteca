$(function () {
    var TallerAvanzada = {};

    (function (app) {
        //"aca",["Fecha","Hora","Caracteristica","Usuario","Accion"],"LogCaracteristicas",false
        var tabla = new Tabla({
            contenedor: "aca",
            cabecera: ["Fecha","Hora","Caracteristica","Usuario","Accion"],
            controlador: "LogCaracteristicas",
            opciones: false
        });
        app.init = function () {
            tabla.crearCabeceraTabla();
            tabla.listar();
        };
        
        app.init();

    })(TallerAvanzada);


});
