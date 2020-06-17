$( document ).ready(function() {
    //var edo_oculto = document.getElementById('id_edo').value;
    //if(edo_oculto==-1){

        cargarMunicipiosUpp();
        cargarlocalidadesUpp();
    //}

});

function cargarMunicipiosUpp() {

    var edo = document.getElementById('upp-r01_estado').value;
    //Limpieza de campos al onchange y evitar bloqueo de pantalla
    var municipioactivo = document.getElementById('upp-r01_municipio').value;

    var edo_oculto = document.getElementById('id_edo').value;

    var first_time = document.getElementById('id_first_time').value;

    //alert(edo_oculto+" "+first_time)

    if(first_time!=0) {
        if (edo_oculto == -1) {
            $("#upp-r01_municipio").select2('val', '');
            $("#upp-r01_localidad").select2('val', '');
            //$("#ganaderos-c01_localidad").select2("val", "");
        }
    }else{
        document.getElementById('id_first_time').value=1;
    }


    parametro = {"edo":edo};
    $.ajax({
        type: 'GET',
        url: 'index.php?r=unidades/cargarmunicipios',
        data: parametro,
        success: function (respuesta) {
            document.getElementById('upp-r01_municipio').innerHTML=respuesta;
            $('#upp-r01_municipio').val(municipioactivo).trigger('change');
        }
    });
}

function cargarlocalidadesUpp() {
    var mpo = document.getElementById('upp-r01_municipio').value;
    var edo = document.getElementById('upp-r01_estado').value;
    //Limpieza de campos al onchange y evitar bloqueo de pantalla
    var locactiva = document.getElementById('upp-r01_localidad').value;
    var edo_oculto = document.getElementById('id_edo').value;
    var first_time = document.getElementById('id_first_time_mun').value;
    //alert(edo_oculto+" "+first_time)

    if(first_time!=0) {
        if (edo_oculto == -1) {
            $("#upp-r01_localidad").select2('val', '');
            //$("#ganaderos-c01_localidad").select2("val", "");
        }
    }else{
        document.getElementById('id_first_time_mun').value=1;
    }
    //

    parametro = {"edo":edo,"mpo":mpo};
    $.ajax({
        type: 'GET',
        url: 'index.php?r=unidades/cargarlocalidades',
        data: parametro,
        success: function (respuesta) {
            document.getElementById('upp-r01_localidad').innerHTML = respuesta;
            $('#upp-r01_localidad').val(locactiva).trigger('change');
            if (mpo.length>0) {
                var clave = document.getElementById('upp-r01_clave').value
                par_zona = {"mpo": mpo, "clave": clave};
                $.ajax({
                    type: 'GET',
                    url: 'index.php?r=unidades/cargarzona',
                    data: par_zona,
                    success: function (res2) {
                        document.getElementById('upp-r01_zona').value = res2;
                        $('#upp-r01_zona').val(res2).trigger('change');
                    }
                });
            }

        }
    });
}

/**
 * Created by Eduardo on 10/03/2017.
 */
