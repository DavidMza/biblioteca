$(function() {
    var TallerAvanzada = {};
    var locacion = "http://" + window.location.host + "/biblioteca/";
    var totalRegistros;
    var registrosPorPagina = 3;
    var buscar = false;
    var xx = 1;
    (function(app) {
        var segundos = 0.3;
        app.init = function() {
            app.listarLibrosPortada("1");
            app.dibujarBotonesPaginacion(1, registrosPorPagina);
            setTimeout(function() { //duermo unos instantes para que bindings conozca lo escrito por js
                app.bindings();
            }, (segundos * 1000));
        };
        app.bindings = function() {

            $("a.titulo").on('click', function(event) {
                $("#tituloModal").html("Libros");
                $("#modalLibroPortal").modal({show: true});
                app.traerDatos($(this).data("id"));
            });
            $("a.paginate_button").on('click', function(event) {
                //alert($(this).data("id"));
                app.listarLibrosPortada($(this).data("id"));
                app.dibujarBotonesPaginacion($(this).data("id"), registrosPorPagina);
                setTimeout(function() { //duermo unos instantes para que bindings conozca lo escrito por js
                    app.bindings();
                }, (segundos * 1000));
            });
            $("#btBuscar").on('click', function(event) {
                buscar = true;
                //alert($("#buscar").val());
                app.listarLibrosPortada(1);
                app.dibujarBotonesPaginacion(1, registrosPorPagina)
            });

            $("#tamanoPagina").on('change', function(event) {
                //alert($(this).val());
                //alert("Esto va creciendo a razon de 2^2. NO SE POR QUEEEEEEE =(");
                
                registrosPorPagina = $(this).val();
                app.listarLibrosPortada(1);
                app.dibujarBotonesPaginacion(1, registrosPorPagina);
                setTimeout(function() { //duermo unos instantes para que bindings conozca lo escrito por js
                    app.bindings();
                }, (segundos * 1000));
            });
        };
        app.listarLibrosPortada = function(pagina) {
            var url = locacion + "controladores/Ruteador.php";
            var datos = {};
            datos.pagina = pagina;
            datos.tamanoPagina = registrosPorPagina;
            datos.seccion = "portal";
            datos.formulario = "LibroPortal";
            if (buscar) {
                datos.accion = "listarLibrosPortadaBuscado";
                datos.buscar = $("#buscar").val();
            } else {
                datos.accion = "listarLibrosPortada";
                
            }
            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',
                data: datos,
                success: function(data) {
                    console.log(data);
                    app.dibujarCelda(data);
                },
                error: function(data) {
                    alert(data.responseText);
                }
            });
        };
        app.traerDatos = function(id) {
            var url = locacion + "controladores/Ruteador.php";
            var datos = {};
            datos.id = id;
            datos.accion = "lista";
            datos.formulario = "LibroPortal";
            datos.seccion = "portal";
            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',
                data: datos,
                success: function(data) {
                    app.cargarModal(data);
                },
                error: function(data) {
                    alert(data.responseText);
                }
            });
        };
        app.dibujarCelda = function(data) {
            var div = "";
            $.each(data, function(clave, libro) {
                if (clave + 1 == data.length) {
                    //Al ultimo elemento no lo muestro ya que solo contiene el total de filas de la DB
                    totalRegistros = libro[0].total;
                    $("#celdas").html(div);
                    return;
                }

                if (!((clave + 1) % 3) || clave == 0) {
                    div += '<div class = "row" >';
                }

                div += '<!-- FILA ' + (clave + 1) + ' -->';
                div += '<div class="col-md-4 portfolio-item">';
                div += '<a>';
                div += '<img class="img-responsive" src="../' + libro.ruta + '" alt="" width="150" height="300">';
                div += '</a>';
                div += '<h3>';
                div += '<a data-id="' + libro.id + '" class="titulo">' + libro.titulo + '</a>';
                div += '</h3>';
                div += '<p>' + libro.autor + '</p>';
                div += '</div>';

                if (!((clave + 1) % 3)) {
                    div += '</div>';
                }
            });
            //app.truncarTexto();
        };
        app.dibujarBotonesPaginacion = function(actual, por_pagina) {

            setTimeout(function() { //duermo 1 segundo para que los botones de paginacion carguen correctamente
                /* actual => pagina actual
                 * total => cantidad de registros
                 * por_pagina => registros a mostrar por pagina
                 * enlace => esto tiene que volar
                 */
                var total_paginas = Math.ceil(totalRegistros / por_pagina);
                //alert(total_paginas)
                var anterior = actual - 1;
                var posterior = actual + 1;
                var texto = "";
                texto += "<ul class='pagination'>";
                if (actual > 1) {
                    texto += "<li>";
                    texto += "<a class='paginate_button' data-id='" + anterior + "'>Anterior</a>";
                    texto += "</li>";
                } else {
                    texto += "<li>";
                    texto += "";
                    texto += "</li>";
                }
                for (var i = 1; i < actual; i++) {
                    texto += "<li>";
                    texto += "<a class='paginate_button' data-id='" + i + "'>" + i + "</a> ";
                    texto += "</li>";
                }
                texto += "<li class='active'>";
                texto += "<a >" + actual + "</a>";
                texto += "</li>";
                for (i = actual + 1; i <= total_paginas; i++) {
                    texto += "<li>";
                    texto += "<a class='paginate_button' data-id='" + i + "'>" + i + "</a> ";
                    texto += "</li>";
                }

                if (actual < total_paginas) {
                    texto += "<li>";
                    texto += "<a class='paginate_button' data-id='" + posterior + "'>Siguiente</a>";
                    texto += "</li>";
                } else {
                    texto += "";
                }
                texto += "</ul>"

                $("#botonesPaginaFoot").html(texto);
                $("#botonesPaginaHead").html(texto);
            }, (segundos * 1000));
        };
        app.cargarModal = function(data) {
            console.log(data);
            $("#foto").attr("src", locacion + data[0].ruta);
            $("#titulo").html(data[0].titulo);
            $("#isbn").html(data[0].isbn);
            $("#paginas").html(data[0].paginas);
            $("#idioma").html(data[0].idioma);
            $("#pubicacion").html(data[0].publicacion);
            $("#autor").html(data[0].autor);
            $("#editorial").html(data[0].editorial);
            $("#modalLibroPortal").modal({show: true});
        };

        app.truncarTexto = function() {
            $(".titulo").trunk8({
                width: 11
            });
        };

        app.imprimir = function() {    //funcion para imprimir
            var aux = $("#tablaEditorial").html(); //recupero el html del la tablaEditorial
            aux = aux.replace("<thead>", ""); //reemplazo el <thead> por cadena vacia
            aux = aux.replace("</thead>", ""); //reemplazo el </thead> por cadena vacia
            $("#html").val(aux);
            $("#imprimirEditorial").attr("action", locacion + "controladores/Imprimir.php");
            $("#imprimirEditorial").submit(); //imprimo
        };
        app.init();
    })(TallerAvanzada);
});

