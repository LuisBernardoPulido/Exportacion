$(document).ready(function(){
    $('#upp-r01_clave').mask('00-000-0000-AAA');
    $('#upp-r01_cp').mask('00000');
    //$('#upp-r01_latitud').mask('0000000000');
    //$('#upp-r01_longitud').mask('0000000000');
    //$('#upp-r01_altitud').mask('0000000000');
});

$( "#upp-r01_clave" ).keyup(function() {
    var cve = document.getElementById('upp-r01_clave').value
    var cve_temp = document.getElementById('cve_temp').value
    if(cve.toString() != cve_temp.toString()) {
        parametro = {"cve": cve};
        $.ajax({
            type: 'GET',
            url: 'index.php?r=upp/validarclave',
            data: parametro,
            success: function (respuesta) {
                if (respuesta == 1) {
                    $("#val_clave").fadeIn("slow", function () {
                        //Swal Existente
                        swal({
                            title: 'UPP existente',
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
                            parametro = {"clave": cve};
                            $.ajax({
                                type: 'GET',
                                url: 'index.php?r=upp/revisarclave',
                                data: parametro,
                                success: function (respuesta) {
                                    if (respuesta != -1) {
                                        location.href = "index.php?r=unidades/update&id=" + respuesta + "";
                                    }
                                }
                            });

                        }, function (dismiss) {
                            // dismiss can be 'cancel', 'overlay',
                            if (dismiss === 'cancel') {
                                document.getElementById('upp-r01_clave').value = '';
                                $("#curp_rep").fadeOut("slow", function () {
                                });
                            }
                        });
                        //FIn Swal
                    });
                    //$( "#val_clave" ).fadeIn( "slow", function() {});
                } else
                    $("#val_clave").fadeOut("slow", function () {
                    });
            }
        });
    }
});


function existente(){
    var sel = document.getElementById('propietariounidad-c01_id').value;
    if(sel){
        var id= document.getElementById('id_edo').value;

        parametro = {"id": id};
        $.ajax({
            type: 'GET',
            url: 'index.php?r=unidades/checkrelaciones',
            data: parametro,
            dataType: "json",
            success: function (res) {
                //alert(res)
                if(res==1){
                    swal({
                        title: 'Relaciones Existentes',
                        text: '¿Deseas agregar un nuevo productor?',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#942626',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si',
                        cancelButtonText: 'Cancelar',
                        allowOutsideClick: false,
                        allowEnterKey: false,
                    }).then(function (res) {
                        $( "#modalButton" ).trigger( "click" );
                    }, function (dismiss) {
                        $("#propietariounidad-c01_id").select2("val", "");
                    });
                }
            }
        });
    }


}