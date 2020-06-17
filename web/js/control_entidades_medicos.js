//$( document ).ready(function() {
    //cargarMunicipios();
    //cargarlocalidades();
    //cargarMunicipios();
//});
$( document ).ready(function() {
    //var edo_oculto = document.getElementById('id_edo').value;
    //if(edo_oculto==-1){

    cargarMunicipios();
    cargarlocalidades();
    //}

});
$( "#medicos-c05_clave" ).keyup(function() {
    var cve_med = document.getElementById('medicos-c05_clave').value
    var clave_temp = document.getElementById('clave_temp').value

    if(cve_med.toString() != clave_temp.toString()) {
        parametro = {"cve_med": cve_med};
        $.ajax({
            type: 'GET',
            url: 'index.php?r=medicos/validarclave',
            data: parametro,
            success: function (respuesta) {
                if (respuesta == 1) {
                    //$( "#clave_rep" ).fadeIn( "slow", function() {});
                    $("#clave_rep").fadeIn("slow", function () {
                        //Swal Existente
                        swal({
                            title: 'Médico existente',
                            text: '¿Deseas editarlo?',
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#942626',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Si',
                            cancelButtonText: 'Cancelar',
                            allowOutsideClick: false,
                        }).then(function ($res) {
                            parametro = {"cve_med": cve_med};
                            $.ajax({
                                type: 'GET',
                                url: 'index.php?r=medicos/revisarclave',
                                data: parametro,
                                success: function (respuesta) {
                                    if (respuesta != -1) {
                                        location.href = "index.php?r=medicos/update&id=" + respuesta + "";
                                    }
                                }
                            });

                        }, function (dismiss) {
                            if (dismiss === 'cancel') {
                                document.getElementById('medicos-c05_clave').value = '';
                                $("#clave_rep").fadeOut("slow", function () {
                                });
                            }
                        });
                    });
                }
                //else
                //    $( "#clave_rep" ).fadeOut( "slow", function() {});
            }
        });
    }
});


//CURP
$( "#medicos-c05_curp" ).keyup(function() {
    var cve_med = document.getElementById('medicos-c05_curp').value
    var clave_temp = document.getElementById('clave_temp_curps').value

    if(cve_med.toString() != clave_temp.toString()) {
        parametro = {"cve_med": cve_med};
        $.ajax({
            type: 'GET',
            url: 'index.php?r=medicos/validarcurp',
            data: parametro,
            success: function (respuesta) {
                if (respuesta == 1 && cve_med.length > 0) {
                    $("#curp_rep").fadeIn("slow", function () {
                        //Swal Existente
                        swal({
                            title: 'Médico existente',
                            text: '¿Deseas editarlo?',
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#942626',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Si',
                            cancelButtonText: 'Cancelar',
                            allowOutsideClick: false,
                        }).then(function ($res) {
                            parametro = {"cve_med": cve_med};
                            $.ajax({
                                type: 'GET',
                                url: 'index.php?r=medicos/revisarcurp',
                                data: parametro,
                                success: function (respuesta) {
                                    if (respuesta != -1) {
                                        location.href = "index.php?r=medicos/update&id=" + respuesta + "";
                                    }
                                }
                            });

                        }, function (dismiss) {
                            if (dismiss === 'cancel') {
                                document.getElementById('medicos-c05_curp').value = '';
                                $("#curp_rep").fadeOut("slow", function () {
                                });
                            }
                        });
                    });
                }
                //else
                //    $( "#clave_rep" ).fadeOut( "slow", function() {});
            }
        });
    }
});

//FIN CURP

function cargarMunicipios() {

    var edo = document.getElementById('medicos-c05_estado').value;
    var edo_oculto = document.getElementById('id_edo').value;
    var first_time = document.getElementById('id_first_time').value;
    var municipioactivo = document.getElementById('medicos-c05_municipio').value;

    if(first_time!=0) {
        if (edo_oculto == -1) {
            $("#medicos-c05_municipio").select2("val", "");
            $("#medicos-c05_localidad").select2("val", "");
        }
    }else{
        document.getElementById('id_first_time').value=1;
    }
    parametro = {"edo":edo};
    $.ajax({
        type: 'GET',
        url: 'index.php?r=medicos/cargarmunicipios',
        data: parametro,
        success: function (respuesta) {
            document.getElementById('medicos-c05_municipio').innerHTML=respuesta;
            $('#medicos-c05_municipio').val(municipioactivo).trigger('change');

        }
    });
}

function cargarlocalidades() {
    var edo = document.getElementById('medicos-c05_estado').value;
    var mpo = document.getElementById('medicos-c05_municipio').value;
    var mpo_oculto = document.getElementById('id_edo').value;
    var first_time = document.getElementById('id_first_time_mun').value;
    var locactiva = document.getElementById('medicos-c05_localidad').value;

    if(first_time!=0) {
        if (mpo_oculto == -1) {
            $("#medicos-c05_localidad").select2("val", "");
        }
    }else{
        document.getElementById('id_first_time').value=1;
    }

    parametro = {"edo":edo,"mpo":mpo};
    $.ajax({
        type: 'GET',
        url: 'index.php?r=medicos/cargarlocalidades',
        data: parametro,
        success: function (respuesta) {
            document.getElementById('medicos-c05_localidad').innerHTML=respuesta;
            $('#medicos-c05_localidad').val(locactiva).trigger('change');

        }
    });
}
/**
 * Created by Eduardo on 10/03/2017.
 */
