$(function () {
    var TallerAvanzada = {};
    var locacion = "http://" + window.location.host + "/biblioteca/";
    (function (app) {
        var fileExtension;
        app.init = function () {
            //$("mensaje").html("").hide();
            app.bindings();
            
        };

        app.bindings = function () {
            $("#agregarImagen").on('click', function (event) {
                $("#id").val(0);
                $("#tituloModal").html("Agregar Nueva Imagen");
                $("#modalImagen").modal({show: true});
            });
            
            //función que observa los cambios del campo file y obtiene información
            $(':file').change(function ()
            {
                //obtenemos un array con los datos del archivo
                var file = $("#imagen")[0].files[0];
                //obtenemos el nombre del archivo
                var fileName = file.name;
                //obtenemos la extensión del archivo
                fileExtension = fileName.substring(fileName.lastIndexOf('.') + 1);
                //obtenemos el tamaño del archivo
                var fileSize = file.size;
                //obtenemos el tipo de archivo image/png ejemplo
                var fileType = file.type;
                //mensaje con la información del archivo
                //alert("Archivo para subir: " + fileName + ", peso total: " + fileSize + " bytes.");
                console.log(file.image);
                $("#mostrarImagen").html("<img src='files/"+file+"' />");
                
            });

            //al enviar el formulario
            $('#guardar').click(function () {
                app.guardar();
            });
            
            app.guardar = function (){
                var url = locacion + "controladores/Ruteador.php";
                var message = "";
                var datos = {};
                //var formData = new FormData($(".form-horizontal")[0]);
                var formData = $("#archivo")[0].files[0];
                datos.imagen = formData;
                datos.accion = "agregar";
                datos.formulario = "Foto";
                datos.seccion = "gestor";
                datos.usuario = sessionStorage.usuario;
                //console.log(datos.imagen);
                
                $.ajax({
                    url: url,
                    method: 'POST',
                    dataType: 'json',
                    //necesario para subir archivos via ajax
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: datos,
                    success: function (data) {
                        console.log(data);
                    },
                    error: function () {
                        message = "<span class='error'>Ha ocurrido un error.</span>";
                        app.showMessage(message);
                    }
                });
            };

            app.showMessage = function (mensaje) {
                $("mensaje").html("").show();
                $("mensaje").html(mensaje);
            };

            app.isImage = function (extension) {
                switch (extension.toLowerCase())
                {
                    case 'jpg':
                    case 'gif':
                    case 'png':
                    case 'jpeg':
                        return true;
                        break;
                    default:
                        return false;
                        break;
                }
            };
        };
        
        app.init();

    })(TallerAvanzada);
});



