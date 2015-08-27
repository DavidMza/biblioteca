$(function () {
    var TallerAvanzada = {};

    (function (app) {
        //"aca",["Fecha","Hora","Clasificacion","Usuario","Accion"],"LogClasificacion",false
        var tabla = new Tabla({
            contenedor: "aca",
            cabecera: ["Fecha","Hora","Clasificacion","Usuario","Accion"],
            controlador: "LogClasificacion",
            opciones: false
        });
        app.init = function () {
            tabla.crearCabeceraTabla();
            tabla.listar();
        };

        app.init();

    })(TallerAvanzada);


});
