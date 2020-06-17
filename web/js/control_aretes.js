
$(document).ready(function(){
    $('#aretes-r02_numero').mask('0000000000');
    $('#aretes-r02_edad').mask('00000');
});

$( "#aretes-r02_numero" ).keyup(function() {
    var arete = document.getElementById('aretes-r02_numero').value
    var arete_temp = document.getElementById('arete_temp').value
    if(arete.toString() != arete_temp.toString()) {
        parametro = {"arete": arete};
        $.ajax({
            type: 'GET',
            url: 'index.php?r=aretes/validararete',
            data: parametro,
            success: function (respuesta) {
                if (respuesta == 1) {
                    $("#val_arete").fadeIn("slow", function () {
                        //Swal Existente
                        swal({
                            title: 'Arete existente',
                            text: '¿Desea editar la información?',
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#942626',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Si',
                            cancelButtonText: 'Cancelar',
                            allowOutsideClick: false,
                        }).then(function ($res) {
                            //Enviar CURP y recuperar ID para enviar a UPDATE
                            parametro = {"arete": arete};
                            $.ajax({
                                type: 'GET',
                                url: 'index.php?r=aretes/revisararete',
                                data: parametro,
                                success: function (respuesta) {
                                    if (respuesta != -1) {
                                        location.href = "index.php?r=aretes/update&id=" + respuesta + "";
                                    }
                                }
                            });

                        }, function (dismiss) {
                            // dismiss can be 'cancel', 'overlay',
                            if (dismiss === 'cancel') {
                                document.getElementById('aretes-r02_numero').value = '';
                            }
                        });
                        //FIn Swal
                    });
                    //$( "#val_clave" ).fadeIn( "slow", function() {});
                } else
                    $("#val_arete").fadeOut("slow", function () {
                    });
            }
        });
    }
});