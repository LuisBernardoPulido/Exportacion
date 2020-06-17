$( document ).ready(function() {
    //var edo_oculto = document.getElementById('id_edo').value;
    //if(edo_oculto==-1){

    cargarMunicipiosProductor();
    cargarlocalidadesProductor();
    //}

});
$( "#ganaderos-c01_curp" ).keyup(function() {
    var curp = document.getElementById('ganaderos-c01_curp').value
    var curp_temp = document.getElementById('curp_temp').value
    if (curp.toString() != curp_temp.toString()) {
    parametro = {"curp": curp};
    $.ajax({
        type: 'GET',
        url: 'index.php?r=ganaderos/validarcurp',
        data: parametro,
        success: function (respuesta) {
            if (respuesta == 1 && curp.length > 0) {
                $("#curp_rep").fadeIn("slow", function () {
                    //Swal Existente
                    swal({
                        title: 'Productor existente',
                        text: '¿Deseas editarlo?',
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#942626',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si',
                        cancelButtonText: 'Cancelar',
                        allowOutsideClick: false,
                    }).then(function ($res) {
                        //Enviar CURP y recuperar ID para enviar a UPDATE

                        var curprecibida = document.getElementById('ganaderos-c01_curp').value;
                        parametro = {"curp": curprecibida};
                        $.ajax({
                            type: 'GET',
                            url: 'index.php?r=ganaderos/revisarcurp',
                            data: parametro,
                            success: function (respuesta) {
                                if (respuesta != -1) {
                                    location.href = "index.php?r=ganaderos/update&id=" + respuesta + "";
                                }
                            }
                        });

                        //Fin Enviar CURP
                    }, function (dismiss) {
                        // dismiss can be 'cancel', 'overlay',
                        // 'close', and 'timer'
                        if (dismiss === 'cancel') {
                            document.getElementById('ganaderos-c01_curp').value = '';
                            $("#curp_rep").fadeOut("slow", function () {
                            });
                        }
                    });
                    //FIn Swal existente
                });

            }
            //else
            //    $("#curp_rep").fadeOut("slow", function () {
            //    });
        }
    });
}
});

$( "#ganaderos-c01_rfc" ).keyup(function() {
    var rfc = document.getElementById('ganaderos-c01_rfc').value
    var rfc_temp = document.getElementById('rfc_temp').value
    if (rfc.toString() != rfc_temp.toString()) {
        parametro = {"rfc": rfc};
        $.ajax({
            type: 'GET',
            url: 'index.php?r=ganaderos/validarrfc',
            data: parametro,
            success: function (respuesta) {
                if (respuesta == 1) {
                    $("#rfc_rep").fadeIn("slow", function () {
                        //Swal Existente
                        swal({
                            title: 'Productor existente',
                            text: '¿Deseas editarlo?',
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#942626',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Si',
                            cancelButtonText: 'Cancelar',
                            allowOutsideClick: false,
                        }).then(function ($res) {
                            //Enviar CURP y recuperar ID para enviar a UPDATE

                            parametro = {"rfc": rfc};
                            $.ajax({
                                type: 'GET',
                                url: 'index.php?r=ganaderos/revisarrfc',
                                data: parametro,
                                success: function (respuesta) {
                                    if (respuesta != -1) {
                                        location.href = "index.php?r=ganaderos/update&id=" + respuesta + "";
                                    }
                                }
                            });

                            //Fin Enviar CURP
                        }, function (dismiss) {
                            // dismiss can be 'cancel', 'overlay',
                            // 'close', and 'timer'
                            if (dismiss === 'cancel') {
                                document.getElementById('ganaderos-c01_rfc').value = '';
                                $("#rfc_rep").fadeOut("slow", function () {
                                });
                            }
                        });
                        //FIn Swal existente
                    });
                }
                //else
                //    $( "#rfc_rep" ).fadeOut( "slow", function() {});
            }
        });
    }
});

function cargarMunicipiosProductor() {
    var edo = document.getElementById('ganaderos-c01_estado').value;
    var edo_oculto = document.getElementById('id_edo').value;
    var first_time = document.getElementById('id_first_time').value;
    var municipioactivo = document.getElementById('ganaderos-c01_municipio').value;

    if(first_time!=0) {
        if (edo_oculto == -1) {
            $("#ganaderos-c01_municipio").select2('val', '');
            $("#ganaderos-c01_localidad").select2('val', '');
        }
    }else{
        document.getElementById('id_first_time').value=1;
    }
    parametro = {"edo":edo};
    $.ajax({
        type: 'GET',
        url: 'index.php?r=ganaderos/cargarmunicipiosproductor',
        data: parametro,
        success: function (respuesta) {
            document.getElementById('ganaderos-c01_municipio').innerHTML=respuesta;
            $('#ganaderos-c01_municipio').val(municipioactivo).trigger('change');

        }
    });
}

function cargarlocalidadesProductor() {
    var mpo = document.getElementById('ganaderos-c01_municipio').value;
    var edo = document.getElementById('ganaderos-c01_estado').value;
    var mpo_oculto = document.getElementById('id_edo').value;
    var first_time = document.getElementById('id_first_time_mun').value;
    var locactiva = document.getElementById('ganaderos-c01_localidad').value;

    if(first_time!=0) {
        if (mpo_oculto == -1) {
            $("#ganaderos-c01_localidad").select2("val", "");
        }
    }else{
        document.getElementById('id_first_time').value=1;
    }



    parametro = {"edo":edo,"mpo":mpo};
    $.ajax({
        type: 'GET',
        url: 'index.php?r=ganaderos/cargarlocalidadesproductor',
        data: parametro,
        success: function (respuesta) {
            //alert(respuesta)
            document.getElementById('ganaderos-c01_localidad').innerHTML=respuesta;
            $('#ganaderos-c01_localidad').val(locactiva).trigger('change');

        }
    });
}
/**
 * Created by Eduardo on 10/03/2017.
 */
