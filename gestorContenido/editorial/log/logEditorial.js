$(function () {
    var TallerAvanzada = {};

    (function (app) {
        //"aca",["Fecha","Hora","Editorial","Usuario","Accion"],"LogEditoriales",false
        var tabla = new Tabla({
            contenedor: "aca",
            cabecera: ["Fecha","Hora","Editorial","Usuario","Accion"],
            controlador: "LogEditoriales",
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
