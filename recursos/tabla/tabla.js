
/* Parametros (param)
 * - contenedor (Obligatorio): es el tag donde se inyectara el codigo del ABM
 * - cabecera (Obligatorio): es un ARRAY con los nombres de las columnas que van a ir en la cabecera de la tabla, deberian empezar con Mayuscula
 * - controlador (Obligatorio): es el nombre del controlador que se debe instanciar del lado del servidor
 * - verEditar (Opcional): es un booleano que nos indica si se debe mostrar la opcion editar en la tabla, si no se espeficica su valor sera true
 * - verEliminar (Opcional): es un booleano que nos indica si se debe mostrar la opcion eliminar en la tabla, si no se espeficica su valor sera true
 * - verSeleccionar (Opcional): es un booleano que nos indica si se debe mostrar la opcion seleccionar en la tabla, si no se espeficica su valor sera false
 * - fnNuevo (Opcional): es la funcion que se ejecutara cuando se haga click en el boton de Nuevo Resgistro, si no se especifica se le asignara una funcion por defecto
 * - fnEditar (Opcional): es la funcion que se ejecutara cuando se haga click en el boton de Editar, si no se especifica se le asignara una funcion por defecto
 * - fnEliminar (Opcional): es la funcion que se ejecutara cuando se haga click en el boton de Eliminar, si no se especifica se le asignara una funcion por defecto
 * - fnSeleccionar (Opcional): es la funcion que se ejecutara cuando se haga click en el boton de Seleccionar, si no se especifica se le asignara una funcion por defecto
 * 
 * Variables
 * - listartodo: aqui se generara el input del tipo checkbox para mostrar todos los resgistros
 * - pagActual: variable utilizada por el paginador para saber en que pagina se encuentra y poder mostrar los registros
 * - datos: Arreglo de objetos que son los que mostrara la tabla.
 * - listado: Arreglo de objetos que contendra listado de todos los registros traidos al listar, Solo es modificado por la funcion listar.
 * 
 * Restricciones
 * - Se necesita Jquery (por ahora)
 * - La cabecera (en minusculas) debe coincidir con los nombres de los registros que me devuelve el servidor.
 * - El id del modal debe empezar con "modal" concatenado a lo que envie en Controlador
 * - La cabecera (en minusculas) debe coincidir con los id de los campos del modal.
 * - La base de datos debe enviar el id bajo el alias "id"
 * - El id del boton guardar del modal debe tener id igual a "guardar" ?????? NO ES NECESARIO
 * - Debe crearse un listener del boton guardar del modal que llame a la funcion "accion" de la Tabla
 * - El modal debe tener un campo hidden con id igual a "id"
 * 
 */
function Tabla(param) {
    var refTabla = this;
    refTabla.locacion = "http://" + window.location.host + "/biblioteca/";

    //Inicializamos el contenedor donde vamos a inyectar el codigo html generado
    refTabla.contenedor = $("#" + param.contenedor)[0];
    //Inicializamos la cabecera de la tabla
    refTabla.cabecera = param.cabecera;
    //Inicializamos el controlador que va a ser instanciado en el servidor
    refTabla.controlador = param.controlador;
    //Inicializamos la tabla
    refTabla.tabla = document.createElement("table");
    //Inicializamos el body de la tabla
    refTabla.tbody = document.createElement("tbody");
    //Inicializamos el contenedor del paginador
    refTabla.paginador = document.createElement("div");

    //Inicializamos opcion verEditar, si no se especifica valor por defecto es true.
    if (typeof param.verEditar == "undefined") {
        refTabla.verEditar = true;
    } else {
        refTabla.verEditar = param.verEditar;
    }

    //Inicializamos opcion verEliminar, si no se especifica valor por defecto es true.
    if (typeof param.verEliminar == "undefined") {
        refTabla.verEliminar = true;
    } else {
        refTabla.verEliminar = param.verEliminar;
    }

    //Inicializamos opcion verSeleccionar, si no se especifica valor por defecto es true.
    if (typeof param.verSeleccionar == "undefined") {
        refTabla.verSeleccionar = false;
    } else {
        refTabla.verSeleccionar = param.verSeleccionar;
    }

    //Inicializamos la funcion a ejecutar cdo se toque NUEVO registro, si no se especifica valor por defecto se le asigna una funcion por defecto.
    if (typeof param.fnNuevo == "undefined") {
        refTabla.fnNuevo = function (event) {
            $('#id').val(0);
            $("#modal" + refTabla.controlador).modal({show: true});
        };
    } else {
        refTabla.fnNuevo = param.fnNuevo;
    }

    //Inicializamos la funcion a ejecutar cdo se toque EDITAR un registro, si no se especifica valor por defecto se le asigna una funcion por defecto.
    if (typeof param.fnEditar == "undefined") {
        refTabla.fnEditar = function (event) {
            $('#id').val(this.getAttribute("data-id"));
            for (var i = 0, max = refTabla.cabecera.length; i < max; i++) {
                $("#" + refTabla.cabecera[i].toLowerCase()).val(this.parentNode.parentNode.children[i].innerHTML);
            }
            $("#modal" + refTabla.controlador).modal({show: true});
        };
    } else {
        refTabla.fnEditar = param.fnEditar;
    }

    //Inicializamos la funcion a ejecutar cdo se toque ELIMINAR un registro, si no se especifica valor por defecto se le asigna una funcion por defecto.
    if (typeof param.fnEliminar == "undefined") {
        refTabla.fnEliminar = function (event) {
            refTabla.eliminar(this.getAttribute("data-id"), this);
        };
    } else {
        refTabla.fnEliminar = param.fnEliminar;
    }

    //Inicializamos la funcion a ejecutar cdo se toque SELECCIONAR un registro, si no se especifica valor por defecto se le asigna una funcion por defecto.
    if (typeof param.fnSeleccionar == "undefined") {
        refTabla.fnSeleccionar = function (event) {
            console.log("Funcion de Seleccion no definida");
        };
    } else {
        refTabla.fnSeleccionar = param.fnSeleccionar;
    }

    //Inicializamos la funcion a ejecutar cdo para LISTAR los registros, si no se especifica valor por defecto se le asigna una funcion por defecto.
    if (typeof param.fnListar == "undefined") {
        refTabla.fnListar = function () {
            refTabla.listar();
        };
    } else {
        refTabla.fnListar = param.fnListar;
    }

}

//Funcion para crear el ABM COMPLETO
Tabla.prototype.crearABM = function () {
    var refTabla = this;
    refTabla.crearBotonesCabecera();
    refTabla.crearCheckMostrarTodo();
    refTabla.crearTabla();
};

//Funcion para crear solo la CABECERA DEL ABM
Tabla.prototype.crearBotonesCabecera = function () {
    var refTabla = this;
    var tabla = document.createElement("table");
    var tr = document.createElement("tr");

    //Creo el boton de NUEVO registro
    var td = document.createElement("td");
    var button = document.createElement("button");
    button.className = "btn btn-primary btn-lg";
    //Tooltip que se mostrara al pasar el mouse por arriba
    button.setAttribute("data-tooltip", "Nuevo Registro");
    $(button).on("click", refTabla.fnNuevo);
    var fa = document.createElement("i");
    fa.className = "fa fa-plus fa-1x";
    button.appendChild(fa);
    td.appendChild(button);
    td.setAttribute("align", "center");
    tr.appendChild(td);

    //Creo input y boton para BUSCAR un registro
    var td = document.createElement("td");
    var div = document.createElement("div");
    var input = document.createElement("input");
    input.setAttribute("type", "search");
    input.setAttribute("placeholder", "Buscar...");
    //Se activara la busqueda al presionar la tecla ENTER
    $(input).keypress(function (event) {
        if (event.keyCode == 13 || event.which == 13) {
            refTabla.buscar(this.parentNode.children[0].value);
        }
    });
    //Tooltip que se mostrara al pasar el mouse por arriba
    div.setAttribute("data-tooltip", "Ingrese el texto y presione ENTER");
    var button = document.createElement("button");
    button.className = "btn btn-primary btn-lg";
    $(button).on("click", function (event) {
        refTabla.buscar(this.parentNode.children[0].value);
    });
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

    //Creo boton para IMPRIMIR la tabla
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

//Funcion para crear el checkbox que MUESTRE TODOS los registros
Tabla.prototype.crearCheckMostrarTodo = function () {
    var refTabla = this;
    var tabla = document.createElement("table");
    var tr = document.createElement("tr");
    var td = document.createElement("td");
    td.setAttribute("colspan", 3);
    var div = document.createElement("div");
    div.className = "checkbox";
    var label = document.createElement("label");
    //Tooltip que se mostrara al pasar el mouse por arriba
    label.setAttribute("data-tooltip", "Mostrar registros borrados");
    var input = document.createElement("input");
    input.setAttribute("type", "checkbox");
    $(input).on('click', function (event) {
        refTabla.fnListar();
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

//Funcion para crear la CABECERA de la TABLA, al finalizar la ejecucion se llama a la funcion fnListar
Tabla.prototype.crearTabla = function () {
    var refTabla = this;
    refTabla.tabla.className = "table table-striped";
    var thead = document.createElement("thead");
    //Recorro las cabeceras para crear la cabecera de la tabla
    for (var i = 0; i < this.cabecera.length; i++) {
        var th = document.createElement("th");
        var h3 = document.createElement("h3");
        var texto = document.createTextNode(this.cabecera[i]);
        h3.appendChild(texto);
        th.appendChild(h3);
        thead.appendChild(th);
    }
    //Si hay alguna opcion para mostrar creo la columna opciones, sino no se crea
    if (refTabla.verEditar || refTabla.verEliminar || refTabla.verSeleccionar) {
        var th = document.createElement("th");
        var h3 = document.createElement("h3");
        var texto = document.createTextNode("Opciones");
        h3.appendChild(texto);
        th.appendChild(h3);
        th.setAttribute("colspan", "3");
        th.setAttribute("align", "center");
        thead.appendChild(th);
    }
    refTabla.tabla.appendChild(thead);
    refTabla.fnListar();
};

//Funcion por defecto para fnListar
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
            //alert(data.responseText);
            //swal("Error!", data.responseText, "error");
            sessionStorage.aux = JSON.stringify(data.responseText);
            window.location = refTabla.locacion + "gestorContenido/error/error.html";
        }
    });
}

//Funcion para crear el PAGINADOR
Tabla.prototype.rellenarTbody = function () {
    var refTabla = this;
    //Llamo a la funcion mostrarRegistros
    refTabla.mostrarRegistros();
    refTabla.tabla.appendChild(refTabla.tbody);

    //Inicio Crear Paginador
    //Cantidad de Registros a mostrar
    var cantRegistros = refTabla.datos.length;
    //Si son mas de 10 registros se necesita paginar
    if (cantRegistros > 10) {
        this.paginador.innerHTML = "";
        //Si no estoy en la primera pagina se dibuja el boton para volver a la pagina ANTERIOR
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
        //calculo las paginas que se necesitan, Math.ceil redondea al entero superior
        var paginas = Math.ceil(cantRegistros / 10);
        //Dibujo cada uno de los botones de las paginas
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
        //Si no estoy en la ultima pagina dibujo el boton de siguiente pagina
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
    } else {//NO se necesita paginar
        this.paginador.innerHTML = "";
    }
    //Fin Crear Paginador
}

//Funcion que se encarga de RELLENAR el BODY de la tabla con los registros
Tabla.prototype.mostrarRegistros = function () {
    var refTabla = this;
    refTabla.tbody.innerHTML = "";
    refTabla.tbody = document.createElement("tbody");
    //Cantidad de Registros
    var cantRegistros = refTabla.datos.length;
    var limite = 0;
    var inicio = 0;
    //Si son mas de 10 registros se necesita paginar
    if (cantRegistros > 10) {
        //limite superior de los registros que se van a mostrar
        limite = 10 * refTabla.pagActual;
        //limite inferior de los registros que se van a mostrar
        inicio = limite - 10;
        //Si el limite es mayor a la cantidad de registros, el limite superior sera la cantidad de registros
        if (limite > cantRegistros) {
            limite = cantRegistros;
        }
    } else {//No se necesita paginar
        //limite inferior de los registros que se van a mostrar
        inicio = 0;
        //limite superior de los registros que se van a mostrar
        limite = cantRegistros;
    }
    //Creo las filas de la tabla de acuerdo a los limites calculados
    for (var i = inicio; i < limite; i++) {
        var tr = document.createElement("tr");
        //creo los campos de los registros que coinciden con los nombres de las cabeceras en minusculas
        for (var j = 0; j < this.cabecera.length; j++) {
            var td = document.createElement("td");
            var texto = document.createTextNode(refTabla.datos[i][this.cabecera[j].toLowerCase()]);
            td.appendChild(texto);
            tr.appendChild(td);
        }

        //Si se desea mostrar la opcion seleccionar registro
        if (refTabla.verSeleccionar) {
            var td = document.createElement("td");
            var seleccionar = document.createElement("a");
            seleccionar.setAttribute("data-id", refTabla.datos[i].id);
            seleccionar.setAttribute("data-tooltip", "Seleccionar");
            $(seleccionar).on("click", refTabla.fnSeleccionar);
            var fa = document.createElement("i");
            fa.className = "fa fa-hand-o-left fa-2x";
            seleccionar.appendChild(fa);
            td.appendChild(seleccionar);
            tr.appendChild(td);
        }

        //Si se desea mostrar la opcion editar registro
        if (refTabla.verEditar) {
            var td = document.createElement("td");
            var editar = document.createElement("a");
            editar.setAttribute("data-id", refTabla.datos[i].id);
            editar.setAttribute("data-tooltip", "Editar");
            $(editar).on("click", refTabla.fnEditar);
            var fa = document.createElement("i");
            fa.className = "fa fa-pencil fa-2x";
            editar.appendChild(fa);
            td.appendChild(editar);
            tr.appendChild(td);
        }

        //Si se desea mostrar la opcion eliminar registro
        if (refTabla.verEliminar) {
            var td = document.createElement("td");
            var eliminar = document.createElement("a");
            eliminar.setAttribute("data-id", refTabla.datos[i].id);
            eliminar.setAttribute("data-tooltip", "Eliminar");
            $(eliminar).on("click", refTabla.fnEliminar);
            var fa = document.createElement("i");
            fa.className = "fa fa-trash-o fa-2x";
            eliminar.appendChild(fa);
            td.appendChild(eliminar);
            tr.appendChild(td);
        }

        refTabla.tbody.appendChild(tr);
    }
    refTabla.contenedor.appendChild(refTabla.tabla);

    refTabla.contenedor.appendChild(refTabla.paginador);
};

//Funcion por defecto para fnEliminar
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
            //alert(data.responseText);
            //swal("Error!", data.responseText, "error");
            sessionStorage.aux = JSON.stringify(data.responseText);
            window.location = refTabla.locacion + "gestorContenido/error/error.html";
        }
    });
};

//Funcion para detectar si se esta creando un NUEVO registro o se esta EDITANDO uno existente
Tabla.prototype.accion = function () {
    var refTabla = this;
    if ($("#id").val() == 0) {
        refTabla.guardar();
    } else {
        refTabla.modificar();
    }
};

//Funcion por defecto para fnNuevo
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
            //alert(data.responseText);
            //swal("Error!", data.responseText, "error");
            sessionStorage.aux = JSON.stringify(data.responseText);
            window.location = refTabla.locacion + "gestorContenido/error/error.html";
        }
    });
};

//Funcion por defecto para fnModificar
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
            //alert(data.responseText);
            //swal("Error!", data.responseText, "error");
            sessionStorage.aux = JSON.stringify(data.responseText);
            window.location = refTabla.locacion + "gestorContenido/error/error.html";
        }
    });
};

//Funcion por defecto para fnImprimir
Tabla.prototype.imprimir = function () {    //funcion para imprimir
    var refTabla = this;
    var aux = '<table border="1">' + refTabla.tabla.innerHTML + '</table>';//recupero el html del la tablaAutor
    aux = aux.replace("<thead>", "");//reemplazo el <thead> por cadena vacia
    aux = aux.replace("</thead>", "");//reemplazo el </thead> por cadena vacia
    console.log(aux);
    $("#tituloImprimir").val(refTabla.controlador);
    $("#htmlImprimir").val(aux);
    $("#formImprimir").attr("action", refTabla.locacion + "controladores/Imprimir.php");
    $("#formImprimir").submit();//imprimo
    /*
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
     
     $(formulario).submit();*/
};

//Funcion por defecto para fnBuscar
Tabla.prototype.buscar = function (criterio) {
    var refTabla = this;
    //alert("buscando " + criterio.length);
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
