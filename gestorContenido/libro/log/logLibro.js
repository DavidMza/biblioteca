$(function () {
    var TallerAvanzada = {};
    (function (app) {
        //"aca",["Fecha","Hora","Autor","Usuario","Accion"],"LogAutor",false
        var tabla = new Tabla({
            contenedor: "aca",
            cabecera: ["Fecha","Hora","Libro","Usuario","Accion"],
            controlador: "LogLibro",
            opciones: false
        });
        app.init = function () {
            tabla.crearCabeceraTabla();
            tabla.listar();
        };

        app.init();

    })(TallerAvanzada);


});
