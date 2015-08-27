
/* Parametros
 * - Contenedor es el div donde se dibujara el ABM
 * - Cabecera es un array con los nombres de los campos que van a ir en la cabecera de la tabla, deberian empezar con Mayuscula
 * - Controlador es el nombre del controlador que se debe instanciar del lado del servidor
 * 
 * Restricciones
 * - El nombre de las cabeceras convertidas a minusculas debe coincidir con los nombres de los registros que me devuelve la base de datos.
 * - El id del modal debe empezar con "modal" concatenado a lo que envie en Controlador
 * - El nombre de las cabeceras convertidas a minusculas debe coincidir con los id de los campos del modal.
 * - La base de datos debe enviar el id bajo el alias "id"
 * - El id del boton guardar del modal debe tener id igual a "guardar"
 * - Debe crearse un binding del boton guardar del modal que llame a la funcion "accion" de la Tabla
 * - El modal debe tener un campo hidden con id igual a "id"
 * contenedor, cabecera, controlador, opciones
 */
function Tabla(param) {
    var refTabla = this;
    refTabla.contenedor = $("#" + param.contenedor)[0];
    refTabla.cabecera = param.cabecera;
    refTabla.controlador = param.controlador;
    refTabla.tabla = document.createElement("table");
    refTabla.tbody = document.createElement("tbody");
    refTabla.paginador = document.createElement("div");

    if (typeof param.opciones == "undefined") {
        refTabla.opciones = true;
    } else {
        refTabla.opciones = param.opciones;
    }

    if (typeof param.nuevo == "undefined") {
        refTabla.nuevo = function (event) {
            $('#id').val(0);
            $("#modal" + refTabla.controlador).modal({show: true});
        };
    } else {
        refTabla.nuevo = param.nuevo;
    }

    if (typeof param.editar == "undefined") {
        refTabla.editar = function (event) {
            $('#id').val(this.getAttribute("data-id"));
            for (var i = 0, max = refTabla.cabecera.length; i < max; i++) {
                $("#" + refTabla.cabecera[i].toLowerCase()).val(this.parentNode.parentNode.children[i].innerHTML);
            }
            $("#modal" + refTabla.controlador).modal({show: true});
        };
    } else {
        refTabla.editar = param.editar;
    }

}

Tabla.prototype.locacion = "http://" + window.location.host + "/biblioteca/";

Tabla.prototype.crearTabla = function () {
    this.crearBotonesCabecera();

    //var tabla = document.createElement("table");
    this.crearCheckMostrarTodo();
    this.crearCabeceraTabla();

    this.listar();

    //this.contenedor.appendChild(this.tabla);

    //this.contenedor.appendChild(this.paginador);
};

Tabla.prototype.crearBotonesCabecera = function () {
    var refTabla = this;
    var tabla = document.createElement("table");
    var tr = document.createElement("tr");

    var td = document.createElement("td");
    var button = document.createElement("button");
    button.className = "btn btn-primary btn-lg";
    button.setAttribute("data-tooltip", "Nuevo Registro");
    $(button).on("click", refTabla.nuevo);
    var fa = document.createElement("i");
    fa.className = "fa fa-plus fa-1x";
    button.appendChild(fa);
    td.appendChild(button);
    td.setAttribute("align", "center");
    tr.appendChild(td);

    var td = document.createElement("td");
    var div = document.createElement("div");
    var input = document.createElement("input");
    input.setAttribute("type", "search");
    input.setAttribute("placeholder", "Buscar...");
    div.setAttribute("data-tooltip", "Ingrese el texto y presione ENTER");
    var button = document.createElement("button");
    button.className = "btn btn-primary btn-lg";
    $(input).keypress(function (event) {
        if (event.keyCode == 13 || event.which == 13) {
            refTabla.buscar(this.parentNode.children[0].value);
        }
    });
    /*$(button).on("click", function (event) {
     refTabla.buscar(this.parentNode.children[0].value);
     });*/
    var fa = document.createElement("i");
    fa.className = "fa fa-search fa-1x";
    button.appendChild(fa);
    div.appendChild(input);
    div.appendChild(button);
    div.className = "buscar";
    td.appendChild(div);
    td.setAttribute("align", "center");
    td.setAttribute("width", "33%");
    tr.appendChild(td);

    var td = document.createElement("td");
    var button = document.createElement("button");
    button.className = "btn btn-primary btn-lg";
    button.setAttribute("data-tooltip", "Imprimir Tabla");
    $(button).on("click", function (event) {
        refTabla.imprimir();
    });
    var fa = document.createElement("i");
    fa.className = "fa fa-print fa-1x";
    button.appendChild(fa);
    td.appendChild(button);
    td.setAttribute("align", "center");
    tr.appendChild(td);

    tabla.appendChild(tr);

    tabla.setAttribute("width", "100%");
    refTabla.contenedor.appendChild(tabla);
}


Tabla.prototype.crearCheckMostrarTodo = function () {
    var refTabla = this;
    var tabla = document.createElement("table");
    var tr = document.createElement("tr");
    var td = document.createElement("td");
    td.setAttribute("colspan", 3);
    var div = document.createElement("div");
    div.className = "checkbox";
    var label = document.createElement("label");
    label.setAttribute("data-tooltip", "Mostrar registros borrados");
    var input = document.createElement("input");
    input.setAttribute("type", "checkbox");
    //input.setAttribute("id","listarTodo");
    $(input).on('click', function (event) {
        refTabla.listar();
    });
    refTabla.listartodo = input;
    var texto = document.createTextNode("Mostrar Todos");
    label.appendChild(input);
    label.appendChild(texto);
    div.appendChild(label);
    td.appendChild(div);
    tr.appendChild(td);

    tabla.appendChild(tr);
    refTabla.contenedor.appendChild(tabla);
};

Tabla.prototype.crearCabeceraTabla = function () {
    var refTabla = this;
    refTabla.tabla.className = "table table-striped";
    var thead = document.createElement("thead");
    for (var i = 0; i < this.cabecera.length; i++) {
        var th = document.createElement("th");
        var h3 = document.createElement("h3");
        var texto = document.createTextNode(this.cabecera[i]);
        h3.appendChild(texto);
        th.appendChild(h3);
        thead.appendChild(th);
    }
    if (refTabla.opciones) {
        var th = document.createElement("th");
        var h3 = document.createElement("h3");
        var texto = document.createTextNode("Opciones");
        h3.appendChild(texto);
        th.appendChild(h3);
        th.setAttribute("colspan", "2");
        th.setAttribute("align", "center");
        thead.appendChild(th);
    }
    refTabla.tabla.appendChild(thead);
};

Tabla.prototype.listar = function () {
    var refTabla = this;
    var url = this.locacion + "controladores/Ruteador.php";
    var datos = {};
    if ($(refTabla.listartodo).prop('checked')) {
        datos.accion = "listarTodo";
    } else {
        datos.accion = "listar";
    }
    datos.formulario = this.controlador;
    datos.seccion = "gestor";
    $.ajax({
        url: url,
        method: 'POST',
        dataType: 'json',
        data: datos,
        success: function (data) {
            refTabla.pagActual = 1;
            refTabla.datos = data;
            refTabla.listado = data;
            refTabla.rellenarTbody();
        },
        error: function (data) {
            alert(data.responseText);
        }
    });
}


Tabla.prototype.rellenarTbody = function () {
    var refTabla = this;
    //console.log(refTabla.datos);

    refTabla.mostrarRegistros();
    refTabla.tabla.appendChild(refTabla.tbody);

    var cantRegistros = refTabla.datos.length;
    if (cantRegistros > 10) {
        this.paginador.innerHTML = "";
        if (refTabla.pagActual > 1) {
            var a = document.createElement("a");
            a.className = "myButton";
            var texto = document.createTextNode("Anterior");
            a.appendChild(texto);
            a.setAttribute("data-pag", refTabla.pagActual - 1);
            $(a).on('click', function (event) {
                refTabla.pagActual = this.getAttribute("data-pag");
                refTabla.rellenarTbody();
            });
            this.paginador.appendChild(a);
        }
        var paginas = Math.ceil(cantRegistros / 10);
        for (var i = 0, max = paginas; i < max; i++) {
            var a = document.createElement("a");
            a.className = "myButton";
            var texto = document.createTextNode(i + 1);
            a.appendChild(texto);
            if (this.pagActual == (i + 1)) {
                a.setAttribute("style", "font-size: 20px; text-decoration: none");
            }
            a.setAttribute("data-pag", i + 1);
            $(a).on('click', function (event) {
                refTabla.pagActual = this.getAttribute("data-pag");
                refTabla.rellenarTbody();
            });
            this.paginador.appendChild(a);
        }
        if (refTabla.pagActual < paginas) {
            var a = document.createElement("a");
            a.className = "myButton";
            var texto = document.createTextNode("Siguiente");
            a.appendChild(texto);
            a.setAttribute("data-pag", (Number(refTabla.pagActual) + Number(1)));
            $(a).on('click', function (event) {
                refTabla.pagActual = this.getAttribute("data-pag");
                refTabla.rellenarTbody();
            });
            this.paginador.appendChild(a);
        }
        this.paginador.setAttribute("align", "center");
    } else {
        this.paginador.innerHTML = "";
    }
}

Tabla.prototype.mostrarRegistros = function () {
    var refTabla = this;
    refTabla.tbody.innerHTML = "";
    refTabla.tbody = document.createElement("tbody");
    var cantRegistros = refTabla.datos.length;
    var limite = 0;
    var inicio = 0;
    if (cantRegistros > 10) {
        //alert("necesito paginar");
        limite = 10 * refTabla.pagActual;
        inicio = limite - 10;
        if (limite > cantRegistros) {
            limite = cantRegistros;
        }
    } else {
        //alert(" No necesito paginar");
        inicio = 0;
        limite = cantRegistros;
    }
    for (var i = inicio; i < limite; i++) {
        var tr = document.createElement("tr");
        for (var j = 0; j < this.cabecera.length; j++) {
            var td = document.createElement("td");
            var texto = document.createTextNode(refTabla.datos[i][this.cabecera[j].toLowerCase()]);
            td.appendChild(texto);
            tr.appendChild(td);
        }
        if (refTabla.opciones) {
            var td = document.createElement("td");
            var editar = document.createElement("a");
            editar.setAttribute("data-id", refTabla.datos[i].id);
            editar.setAttribute("data-tooltip", "Editar");
            $(editar).on("click", refTabla.editar);
            var fa = document.createElement("i");
            fa.className = "fa fa-pencil fa-2x";
            editar.appendChild(fa);
            td.appendChild(editar);
            tr.appendChild(td);

            var td = document.createElement("td");
            var eliminar = document.createElement("a");
            eliminar.setAttribute("data-id", refTabla.datos[i].id);
            eliminar.setAttribute("data-tooltip", "Eliminar");
            $(eliminar).on("click", function (event) {
                //console.log(this.getAttribute("data-id"));
                refTabla.eliminar(this.getAttribute("data-id"), this);
            });
            var fa = document.createElement("i");
            fa.className = "fa fa-trash-o fa-2x";
            eliminar.appendChild(fa);
            td.appendChild(eliminar);
            tr.appendChild(td);
        }
        refTabla.tbody.appendChild(tr);
    }
    ;
    refTabla.contenedor.appendChild(refTabla.tabla);

    refTabla.contenedor.appendChild(refTabla.paginador);
};

Tabla.prototype.eliminar = function (id, tag) {    //funcion para eliminar
    var refTabla = this;
    //console.log(tag)
    var url = refTabla.locacion + "controladores/Ruteador.php";
    var datos = {};
    datos.id = id;
    datos.accion = "eliminar";
    datos.formulario = refTabla.controlador;
    datos.seccion = "gestor";
    datos.user = sessionStorage.usuario;
    $.ajax({
        url: url,
        method: 'POST',
        data: datos,
        success: function (data) {
            //alert("eliminado");
            //tag.parentNode.parentNode.remove();
            for (var i = 0, max = refTabla.datos.length; i < max; i++) {
                if (refTabla.datos[i]["id"] == id) {
                    refTabla.datos.splice(i, 1);
                    break;
                }
            }
            refTabla.rellenarTbody();
        },
        error: function (data) {
            alert(data.responseText);
        }
    });
};

Tabla.prototype.accion = function () {
    var refTabla = this;
    if ($("#id").val() == 0) {
        refTabla.guardar();
    } else {
        refTabla.modificar();
    }
};

Tabla.prototype.guardar = function () {
    var refTabla = this;
    var url = refTabla.locacion + "controladores/Ruteador.php";
    var datos = {};
    for (var i = 0, max = refTabla.cabecera.length; i < max; i++) {
        datos[refTabla.cabecera[i].toLowerCase()] = $("#" + refTabla.cabecera[i].toLowerCase()).val();
    }
    datos.accion = "agregar";
    datos.formulario = refTabla.controlador;
    datos.seccion = "gestor";
    datos.user = sessionStorage.usuario;
    //console.log(datos);
    $.ajax({
        url: url,
        method: 'POST',
        dataType: 'json',
        data: datos,
        success: function (data) {
            console.log(data);
            var aux = {};
            aux.id = data;
            for (var i = 0, max = refTabla.cabecera.length; i < max; i++) {
                aux[refTabla.cabecera[i].toLowerCase()] = datos[refTabla.cabecera[i].toLowerCase()];
            }
            refTabla.datos.push(aux);
            $("#modal" + refTabla.controlador).modal('hide');
            refTabla.rellenarTbody();
        },
        error: function (data) {
            alert(data.responseText);
        }
    });
};

Tabla.prototype.modificar = function () {
    var refTabla = this;
    var url = refTabla.locacion + "controladores/Ruteador.php";
    var datos = {};
    datos.id = $("#id").val();
    for (var i = 0, max = refTabla.cabecera.length; i < max; i++) {
        datos[refTabla.cabecera[i].toLowerCase()] = $("#" + refTabla.cabecera[i].toLowerCase()).val();
    }
    datos.accion = "modificar";
    datos.formulario = refTabla.controlador;
    datos.seccion = "gestor";
    datos.user = sessionStorage.usuario;
    $.ajax({
        url: url,
        method: 'POST',
        data: datos,
        success: function (data) {
            for (var i = 0, max = refTabla.datos.length; i < max; i++) {
                if (refTabla.datos[i].id == datos.id) {
                    for (var j = 0, max2 = refTabla.cabecera.length; j < max2; j++) {
                        refTabla.datos[i][refTabla.cabecera[j].toLowerCase()] = datos[refTabla.cabecera[j].toLowerCase()]
                    }
                    break;
                }
            }
            refTabla.rellenarTbody();
            $("#modal" + refTabla.controlador).modal('hide');
        },
        error: function (data) {
            alert(data.responseText);
        }
    });
};

Tabla.prototype.imprimir = function () {    //funcion para imprimir
    var refTabla = this;
    var aux = '<table border="1">' + refTabla.tabla.innerHTML + '</table>';//recupero el html del la tablaAutor
    aux = aux.replace("<thead>", "");//reemplazo el <thead> por cadena vacia
    aux = aux.replace("</thead>", "");//reemplazo el </thead> por cadena vacia
    console.log(aux);
    var formulario = document.createElement("form");
    formulario.setAttribute("target", "_blank");
    formulario.setAttribute("method", "POST");

    var input = document.createElement("input");
    input.setAttribute("type", "hidden");
    input.setAttribute("name", "Formulario");
    input.setAttribute("value", refTabla.controlador);
    formulario.appendChild(input);

    input = document.createElement("input");
    input.setAttribute("type", "hidden");
    input.setAttribute("name", "html");
    input.setAttribute("value", aux);
    formulario.appendChild(input);

    formulario.setAttribute("action", refTabla.locacion + "controladores/Imprimir.php");

    refTabla.contenedor.appendChild(formulario);

    $(formulario).submit();
};

Tabla.prototype.buscar = function (criterio) {
    var refTabla = this;
    alert("buscando " + criterio.length);
    criterio = criterio.trim();
    refTabla.datos = [];
    if (criterio.length > 0) {
        for (var i = 0, max = refTabla.listado.length; i < max; i++) {
            for (var j = 0, max2 = refTabla.cabecera.length; j < max2; j++) {
                if (refTabla.listado[i][refTabla.cabecera[j].toLowerCase()].indexOf(criterio) > -1) {
                    refTabla.datos.push(refTabla.listado[i]);
                    break;
                }
            }
        }
    } else {
        refTabla.datos = refTabla.listado;
    }
    refTabla.rellenarTbody();
}
;