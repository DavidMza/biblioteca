$(function () {
    var TallerAvanzada = {};
    var locacion = "http://" + window.location.host + "/biblioteca/";
    (function (app) {
        app.init = function () {
            app.bindings();
        };

        app.bindings = function () {

            $("a.titulo").on('click', function (event) {
                app.limpiarModal();
                $("#tituloModal").html("Libros");
                //$("#modalLibroPortal").modal({show: true});
                //alert($(this).data("id"));
                app.traerDatos($(this).data("id"));
            });
        };

        app.listarTodo = function () {
            app.listarClasificaciones();
            app.listarCaracteristicas();
        };
        
        app.listarClasificaciones = function(){
            
        };

        app.init();

    })(TallerAvanzada);


});

