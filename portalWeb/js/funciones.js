$(function () {
    var TallerAvanzada = {};
    var locacion = "http://" + window.location.host + "/biblioteca/";
    (function (app) {
        var datosEditoriales;
        app.init = function () {
            app.bindings();
        };

        app.bindings = function () {
            
            $("a").on('click', function (event) {
                app.limpiarModal();
                $("#tituloModal").html("Libro");
                //$("#modalLibroPortal").modal({show: true});
                //alert($(this).data("id"));
                app.traerDatos($(this).data("id"));
            });
        };
        
        app.traerDatos = function (id){
            var url = locacion+"controladores/Ruteador.php";
            var datos = {};
            datos.id = id;
            datos.accion = "lista";
            datos.formulario = "LibroPortal";
            datos.seccion = "portal";
            $.ajax({
                url: url,
                method: 'POST',
                data: datos,
                type: 'json',
                success: function (data) {
                    console.log(data);
                    
                    app.cargarModal(data);
                    
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
        };
        
        app.cargarModal = function (data){
            $("#titulo").text(data.titulo);
            $("#modalLibroPortal").modal({show: true});
        };
        
        app.imprimir = function () {    //funcion para imprimir
            var aux = $("#tablaEditorial").html();//recupero el html del la tablaEditorial
            aux = aux.replace("<thead>", "");//reemplazo el <thead> por cadena vacia
            aux = aux.replace("</thead>", "");//reemplazo el </thead> por cadena vacia
            $("#html").val(aux);
            $("#imprimirEditorial").attr("action", locacion+"controladores/Imprimir.php");
            $("#imprimirEditorial").submit();//imprimo
        };

        app.limpiarModal = function () {    //funcion para limpiar los textbox del modal
            $("#id").val(0);
            $("#index").val(-1);
            $("#nombre").val('');
        };

        app.init();

    })(TallerAvanzada);


});
