$(function () {
    var TallerAvanzada = {};
    (function (app) {
        //"aca",["Titulo","Autor","Editorial","Disponible","Destacado"],"Libro"
        var tabla = new Tabla({
            contenedor: "aca",
            cabecera: ["Titulo", "Autor", "Editorial", "Disponible", "Destacado"],
            controlador: "Libro",
            fnNuevo: function () {
                sessionStorage.removeItem("aux");
                window.location = "../libro/formLibro.html";
            },
            fnEditar: function () {
                var id = this.getAttribute("data-id");
                console.log(id);
                for (var i = 0, max = tabla.datos.length; i < max; i++) {
                    if (tabla.datos[i].id == id) {
                        console.log(tabla.listado[i]);
                        var data = tabla.listado[i];
                        sessionStorage.aux = JSON.stringify(data);
                        window.location = "../libro/formLibro.html";
                        break;
                    }
                }
            }
        });
        app.init = function () {
            if (sessionStorage.value == '2') {
                $("#log").html('<a href="log/logLibro.html"> Ver Log de Libros</a>');
            }
            tabla.crearABM();

            app.bindings();
        };

        app.bindings = function () {
            $("#guardar").on("click", function (event) {
                tabla.accion();
            });
        };

        app.init();

    })(TallerAvanzada);


});
