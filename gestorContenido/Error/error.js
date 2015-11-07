$(function () {
    var TallerAvanzada = {};
    (function (app) {
        var error;
        app.init = function () {
            if (sessionStorage.aux != null){
                error = JSON.parse(sessionStorage.aux);
                sessionStorage.removeItem("aux");
                console.log(error);
                $("#aca").html(error);
            }else{
                $("#aca").html('<h1>No hay Error</h1>');
            }
        };

        app.init();

    })(TallerAvanzada);


});
