$(function () {
    var TallerAvanzada = {};
    (function (app) {
        //"aca",["Fecha","Hora","Autor","Usuario","Accion"],"LogAutor",false
        var tabla = new Tabla({
            contenedor: "aca",
            cabecera: ["Fecha","Hora","Nombre","Usuario","Accion"],
            controlador: "Autor",
            esLog: true,
            verEditar: false,
            verEliminar: false,
            verSeleccionar: false
        });
        app.init = function () {
            tabla.crearTabla();
            //tabla.listar();
        };

        app.init();

    })(TallerAvanzada);


});
