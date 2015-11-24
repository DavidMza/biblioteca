$(function () {
    var TallerAvanzada = {};

    (function (app) {
        //"aca",["Fecha","Hora","Editorial","Usuario","Accion"],"LogEditoriales",false
        var tabla = new Tabla({
            contenedor: "aca",
            cabecera: ["Fecha","Hora","Nombre","Usuario","Accion"],
            controlador: "Editorial",
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
