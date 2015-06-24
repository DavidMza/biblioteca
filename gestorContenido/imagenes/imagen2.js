$(function () {
    var TallerAvanzada = {};
    var locacion = "http://" + window.location.host + "/biblioteca/";
    (function (app) {
        app.init = function () {
            $("#modalImagen").modal({show: true});
            app.bindings();
        };

        app.bindings = function () {
            $(':file').change(function () {
                app.mostrarVistaPrevia();
            });

            $('#guardar').click(function () {
                app.guardar();
            });

        };

        app.convertB64 = function (file) {
            var canvas = document.createElement('canvas'),
                    ctx = canvas.getContext('2d');
            canvas.width = 64;
            canvas.height = 64;
            ctx.drawImage(file, 0, 0, 64, 64);
            var b64 = canvas.toDataURL().split('base64,')[1];
            console.log(b64);
        };

        app.guardar = function () {
            var url = locacion + "controladores/Ruteador.php";
            var message = "";
            var datos = {};
            //var formData = new FormData($(".form-horizontal")[0]);
            var formData = $("#archivo")[0].files[0];
            app.convertB64($("#archivo")[0].files[0]);
            datos.imagen = formData;
            datos.accion = "agregar";
            datos.formulario = "Foto";
            datos.seccion = "gestor";
            datos.usuario = sessionStorage.usuario;
            console.log(datos);

            $.ajax({
                url: url,
                method: 'POST',
                dataType: 'json',
                //necesario para subir archivos via ajax
                //cache: false,
                //contentType: false,
                //processData: false,
                data: datos,
                success: function (data) {
                    console.log(data);
                },
                error: function () {
                    alert("fallo loco");
                }
            });
        };

        app.mostrarVistaPrevia = function () {

            var Archivos, Lector;

            Archivos = $('#archivo')[0].files;
            console.log(Archivos);
            if (Archivos.length > 0) {
                Lector = new FileReader();
                Lector.onloadend = function (e) {
                    var origen, tipo;

                    //Envia la imagen a la pantalla
                    origen = e.target; //objeto FileReader
                    //Prepara la información sobre la imagen
                    tipo = app.obtenerTipoMIME(origen.result.substring(0, 30));

                    $('#infoNombre').text(Archivos[0].name + ' (Tipo: ' + tipo + ')');
                    $('#infoTamaño').text('Tamaño: ' + e.total + ' bytes');
                    //Si el tipo de archivo es válido lo muestra, 
                    //sino muestra un mensaje 
                    if (tipo !== 'image/jpeg' && tipo !== 'image/png' && tipo !== 'image/gif') {
                        //$('#vistaPrevia').attr('src', window.imagenVacia);
                        alert('El formato de imagen no es válido: debe seleccionar una imagen JPG, PNG o GIF.');
                    } else {
                        $('#vistaPrevia').attr('src', origen.result);
                        app.obtenerMedidas();
                    }

                };
                Lector.onerror = function (e) {
                    console.log(e);
                };
                Lector.readAsDataURL(Archivos[0]);

            } else {
                var objeto = $('#archivo');
                objeto.replaceWith(objeto.val('').clone());
                $('#vistaPrevia').attr('src', window.imagenVacia);
                $('#infoNombre').text('[Seleccione una imagen]');
                $('#infoTamaño').text('');
            }
        };

        //Lee el tipo MIME de la cabecera de la imagen
        app.obtenerTipoMIME = function (cabecera) {
            return cabecera.replace(/data:([^;]+).*/, '\$1');
        };

        //Obtiene las medidas de la imagen y las agrega a la 
        //etiqueta infoTamaño
        app.obtenerMedidas = function () {
            $('<img/>').bind('load', function (e) {

                var tamano = /*$('#infoTamaño').text() + */'; Medidas: ' + this.width + 'x' + this.height;
                //$('#infoTamaño').text(tamaño);

            }).attr('src', $('#vistaPrevia').attr('src'));
        };

        app.init();

    })(TallerAvanzada);
});
/*
 jQuery(document).ready(function () {
 
 //Cargamos la imagen "vacía" que actuará como Placeholder
 jQuery('#vistaPrevia').attr('src', window.imagenVacia);
 
 //El input del archivo lo vigilamos con un "delegado"
 jQuery('#botonera').on('change', '#archivo', function (e) {
 window.mostrarVistaPrevia();
 });
 
 //El botón Cancelar lo vigilamos normalmente
 jQuery('#cancelar').on('click', function (e) {
 var objeto = jQuery('#archivo');
 objeto.replaceWith(objeto.val('').clone());
 
 jQuery('#vistaPrevia').attr('src', window.imagenVacia);
 jQuery('#infoNombre').text('[Seleccione una imagen]');
 jQuery('#infoTamaño').text('');
 });
 
 });
 */